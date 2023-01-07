@extends('partials._admin_main')

@section('pageTitle', 'Gestion plateformes')

@section('content')

    @include('admin.admin_sidebar')

    <div class="admin-view">

        <p>Liste des plateformes</p>

        <div class="option-btn">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary option-btn" data-toggle="modal" data-target="#addModal">Ajouter une plateforme</button>

        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
        @endif

        <table class="table table-striped" id="adminUserDataTable">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Logo</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($platforms as $platform)
                <tr>
                    <th>{{ $platform->platforms_name }}</th>
                    <th>{{ $platform->logo }}</th>
                    <th>{{ $platform->slug }}</th>
                    <th>
                        <a href="" class="update-modal" data-toggle="modal" data-target="#updateModal" data-id="{{ $platform->id }}" data-name="{{ $platform->platforms_name }}" data-logo="{{ $platform->logo }}"  data-slug="{{ $platform->slug }}">
                            <i class="fas fa-edit fa-edit-admin"></i>
                        </a>
                        <a href="" class="delete-modal" data-toggle="modal"  data-target="#deleteModal" data-id="{{ $platform->id }}">
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Ajouter une plateforme</h5>
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

                        <form class="option-game-form" method="post" action="{{ route('add_platform') }}" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="option-form-input">
                                <label for="name">Nom</label>
                                <input type="text" name="name" id="name">
                                <small class="admin-validate-small" id="smallName"></small>
                            </div>                            
                            
                            <div class="option-form-input">
                                <label for="logo">Logo</label>
                                <input type="text" name="logo" id="logo">
                                <small class="admin-validate-small" id="smallLogo"></small>
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Modifier une plateforme</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    <form class="option-form" method="post" action="{{ route('update_platform') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="hidden" name="id" id="updatePlatformId">

                        <div class="option-form-input">
                            <label for="name">Nom</label>
                            <input type="text" name="name" id="updatePlatformName">
                        </div>

                        <div class="option-form-input">
                            <label for="logo">Logo</label>
                            <input type="text" name="logo" id="updatePlatformLogo">
                        </div>

                        <div class="option-form-input">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" id="updatePlatformSlug">
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Supprimer une plateforme</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="" method="get" action="{{ route('delete_platform') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                            <input type="hidden" name="id" id="deletePlatformId">

                            <p>Êtes-vous sûr de vouloir supprimer cette plateforme ?</p>

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

@push('script')
    <script>
        $('document').ready(function(){

            $('.update-modal').click(function () {
                
                var platformId = $(this).attr('data-id');
                var platformName = $(this).attr('data-name');
                var platformLogo = $(this).attr('data-logo');
                var platformSlug = $(this).attr('data-slug');
                
                document.getElementById('updatePlatformId').value = platformId;
                document.getElementById('updatePlatformName').value = platformName;
                document.getElementById('updatePlatformLogo').value = platformLogo;
                document.getElementById('updatePlatformSlug').value = platformSlug;
                
            })

            $('.delete-modal').click(function () {
                
                var platformId = $(this).attr('data-id');
                
                document.getElementById('deletePlatformId').value = platformId;
                
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

            // VALIDATE ADD PLATFORM
            var form = document.querySelector(".option-game-form");
            var name = document.querySelector("#name");
            var logo = document.querySelector("#logo");
            var slug = document.querySelector("#slug");
            var smallName = $("#smallName");
            var smallLogo = $("#smallLogo");
            var smallSlug = $("#smallSlug");
            var messageName = "Attention ! Vous n'avez pas renseigné le nom de la catégorie";
            var messageLogo = "Attention ! Vous n'avez pas renseigné le logo";
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

                if(logo.value === ""){
                    e.preventDefault();
                    smallLogo.show();
                    smallLogo.html(messageLogo);
                    logo.className = "error-input";
                } else {
                    smallLogo.hide();
                    logo.className = "";
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