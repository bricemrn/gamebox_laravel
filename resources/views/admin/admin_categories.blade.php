@extends('partials._admin_main')

@section('pageTitle', 'Gestion catégories')

@section('content')

    @include('admin.admin_sidebar')

    <div class="admin-view">

        <p>Liste des catégories</p>

        <div class="option-btn">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary option-btn" data-toggle="modal" data-target="#addModal">Ajouter une catégorie</button>

        </div>

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        <table class="table table-striped" id="adminUserDataTable">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($categories as $categorie)
                <tr>
                    <th>{{ $categorie->name }}</th>
                    <th>{{ $categorie->slug }}</th>
                    <th>
                        <a href="" class="update-modal" data-toggle="modal" data-target="#updateModal" data-id="{{ $categorie->id }}" data-name="{{ $categorie->name }}" data-slug="{{ $categorie->slug }}">
                            <i class="fas fa-edit fa-edit-admin"></i>
                        </a>
                        <a href="" class="delete-modal" data-toggle="modal"  data-target="#deleteModal" data-id="{{ $categorie->id }}">
                            <i class="fas fa-trash fa-trash-admin"></i>
                        </a>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Modal add -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ajouter une catégorie</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif

                        <form class="option-game-form" method="post" action="{{ route('add_category') }}" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="option-form-input">
                                <label for="name">Nom</label>
                                <input type="text" name="name" id="name">
                                <small class="admin-validate-small"  id="smallName"></small>
                            </div>

                            <div class="option-form-input">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug">
                                <small class="admin-validate-small" id="smallSlug"></small>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-secondary">Enregistrer</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal update -->
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modifier une catégorie</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    <form class="option-form" method="post" action="{{ route('update_category') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="hidden" name="id" id="updateCategoryId">

                        <div class="option-form-input">
                            <label for="name">Nom</label>
                            <input type="text" name="name" id="updateCategoryName">
                        </div>

                        <div class="option-form-input">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" id="updateCategorySlug">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-secondary">Enregistrer</button>
                        </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal delete -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Supprimer une catégorie</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="" method="get" action="{{ route('delete_category') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                            <input type="hidden" name="id" id="deleteCategoryId">

                            <p>Êtes-vous sûr de vouloir supprimer cette catégorie ?</p>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-secondary">Confirmer</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script> --}}
@push('script')
    <script>
        $('document').ready(function(){

            $('.update-modal').click(function () {
                
                var categoryId = $(this).attr('data-id');
                var categoryName = $(this).attr('data-name');
                var categorySlug = $(this).attr('data-slug');
                
                document.getElementById('updateCategoryId').value = categoryId;
                document.getElementById('updateCategoryName').value = categoryName;
                document.getElementById('updateCategorySlug').value = categorySlug;
                
            })

            $('.delete-modal').click(function () {
                
                var categoryId = $(this).attr('data-id');
                
                document.getElementById('deleteCategoryId').value = categoryId;
                
            })

            $('#adminUserDataTable').DataTable({
                "lengthMenu": [10, 15, 25, 50, 100],
                "language": {
                    "lengthMenu": "Affiche _MENU_ résultat(s)",
                    "search": "Recherche :",
                    "infoFiltered": "(Filtré sur _MAX_ résultat(s))",
                    "info": "Résultat(s) _START_ à _END_ sur _TOTAL_",
                    "infoEmpty": "Affiche 0 to 0 of 0 résultat(s)",
                    "zeroRecords": "Aucun résultat",
                    "paginate": {
                        "first":      "Premier",
                        "last":       "Dernier",
                        "next":       "Suivant",
                        "previous":   "Précédent"
                    },
                }
            })

            // VALIDATE ADD CATEGORY
            var form = document.querySelector(".option-game-form");
            var name = document.querySelector("#name");
            var slug = document.querySelector("#slug");
            var smallName = $("#smallName");
            var smallSlug = $("#smallSlug");
            var messageName = "Attention ! Vous n'avez pas renseigné le nom de la catégorie";
            var messageSlug = "Attention ! Vous n'avez pas renseigné le slug";

            smallName.hide();
            smallSlug.hide();

            form.addEventListener("submit", (e) => {

                if(name.value === ""){
                    e.preventDefault();
                    smallName.show();
                    smallName.html(messageName);
                    name.className = "error-input";
                } else {
                    smallName.hide();
                    name.className = "";
                }
                
                if (slug.value === ""){
                    e.preventDefault();
                    smallSlug.show();
                    smallSlug.html(messageSlug);
                    slug.className = "error-input";
                } else {
                    smallSlug.hide();
                    slug.className = "";
                }
            })

        })
    </script>
@endpush