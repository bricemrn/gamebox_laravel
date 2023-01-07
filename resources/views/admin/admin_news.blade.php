@extends('partials._admin_main')

@section('pageTitle', 'Gestion actualités')

@section('content')

    @include('admin.admin_sidebar')

    <div class="admin-view">

        <p>Liste des actualités</p>

        <div class="option-btn">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary option-btn" data-toggle="modal" data-target="#addModal">Créer un article</button>

        </div>

        <table class="table table-striped" id="adminNewsDataTable">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Jeu</th>
                    <th>Catégorie</th>
                    <th>Titre</th>
                    <th>Intro highlight</th>
                    <th>Intro</th>
                    <th>Desc</th>
                    <th>Auteur</th>
                    <th>Slug</th>
                    <th>Date (création)</th>
                    <th>Date (modification)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($news as $new)
                <tr>
                    <th>
                        <img class="card-game-admin" src="{{ url('') }}/{{ $new->image}}" alt="...">
                    </th>
                    @foreach($new->games as $game)
                        <th>
                            {{ $game->games_title }}
                        </th>
                    @endforeach
                    @foreach($new->categories as $category)
                        <th>
                            {{ $category->name }}
                        </th>
                    @endforeach
                    <th>
                        {{ $new->news_title }}
                    </th>
                    <th>
                        {{ \Illuminate\Support\Str::limit($new->desc_intro_highlight, $limit = 20, $end = ' ...') }}
                    </th>
                    <th>
                        <a href="" class="reading-modal" data-toggle="modal" data-target="#readingModal" data-intro="{{ $new->desc_intro }}">
                            <i class="far fa-eye fa-eye-admin"></i>
                        </a>
                    </th>
                    <th>
                        <a href="" class="reading-modal" data-toggle="modal" data-target="#readingModal" data-desc="{{ $new->desc_body }}">
                            <i class="far fa-eye fa-eye-admin"></i>
                        </a>
                    </th>
                    <th>
                        {{ $new->author }}
                    </th>
                    <th>
                        {{ $new->slug }}
                    </th>
                    <th>
                        {{ $new->created_at }}
                    </th>
                    <th>
                        {{ $new->updated_at }}
                    </th>
                    <th>
                    <a href="" class="update-modal" data-toggle="modal" data-target="#updateModal" data-id="{{ $new->id }}" data-title="{{ $new->news_title }}" data-game="{{ $game->id }}" data-category="{{ $category->id }}" data-image="{{ $new->image }}" data-intro-highlight="{{ $new->desc_intro_highlight }}" data-intro="{{ $new->desc_intro }}" data-desc="{{ $new->desc_body }}" data-slug="{{ $new->slug }}">
                            <i class="fas fa-edit fa-edit-admin"></i>
                        </a>
                        <a href="" class="delete-modal" data-toggle="modal"  data-target="#deleteModal" data-id="{{ $new->id }}">
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Créer un article</h5>
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

                        <form class="add-form" method="post" action="{{ route('add_news') }}" enctype="multipart/form-data">

                            {{ csrf_field() }}
                            
                            <div class="option-form-input">
                                <label class="label">Image</label>
                                <div>
                                    <label for="imageAdd"><i class="fas fa-cloud-upload-alt"></i></label>
                                    <span id="file-chosen-add">sélectionner un fichier (.jpeg, .jpg, .png, .webp)</span>
                                    <input type="file" name="imageAdd" id="imageAdd" hidden>
                                </div>
                            </div>

                            <div class="option-form-input">
                                <label for="game">Jeu</label>
                                <select name="game">
                                    <option selected disabled>-</option>
                                    @foreach($games as $game)
                                        <option value="{{ $game->id }}">{{ $game->games_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="option-form-input">
                                <label for="category">Catégorie</label>
                                <select name="category">
                                    <option selected disabled>-</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="option-form-input">
                                <label for="title">Titre</label>
                                <input type="text" name="title">
                            </div>

                            <div class="option-form-input">
                                <label for="desc_intro_highlight">Introduction highlight</label>
                                <input type="text" name="desc_intro_highlight">
                            </div>

                            <div class="option-form-input">
                                <label for="desc_intro">Introduction</label>
                                <textarea type="text" name="desc_intro"></textarea>
                            </div>
                            
                            <div class="option-form-input">
                                <label for="desc_body">Description</label>
                                <textarea type="text" name="desc_body"></textarea>
                            </div>

                            <div class="option-form-input">
                                <label for="author">Auteur</label>
                                <input type="text" name="author" value="{{ Auth::user()->name }}" readonly="readonly">
                            </div>

                            <div class="option-form-input">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug">
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Modifier un article</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <form class="update-form" method="post" action="{{ route('update_news') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                            <input type="hidden" name="updateId" id="updateId">

                            <div class="option-form-input">
                                <label class="label">Image</label>
                                <div>
                                    <label for="imageUpdate"><i class="fas fa-cloud-upload-alt"></i></label>
                                    <span id="file-chosen-update">sélectionner un fichier (.jpeg, .jpg, .png, .webp)</span>
                                    <input type="file" name="imageUpdate" id="imageUpdate" hidden>
                                </div>
                            </div>

                            <div class="option-form-input">
                                <label for="title">Titre</label>
                                <input type="text" name="title" id="updateTitle">
                            </div>

                            <div class="option-form-input">
                                <label for="game">Jeu</label>
                                <select name="game" id="updateGame">
                                    <option selected disabled>-</option>
                                    @foreach($games as $game)
                                        <option value="{{ $game->id }}">{{ $game->games_title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="option-form-input">
                                <label for="category">Catégorie</label>
                                <select name="category" id="updateCategory">
                                    <option selected disabled>-</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>    

                            <div class="option-form-input">
                                <label for="desc_intro_highlight">Introduction highlight</label>
                                <textarea type="text" name="desc_intro_highlight" id="updateIntroHighlight"></textarea>
                            </div>

                            <div class="option-form-input">
                                <label for="desc_intro">Introduction</label>
                                <textarea type="text" name="desc_intro" id="updateIntro"></textarea>
                            </div>
                            
                            <div class="option-form-input">
                                <label for="desc_body">Description</label>
                                <textarea type="text" name="desc_body" id="updateDesc"></textarea>
                            </div>

                            <div class="option-form-input">
                                <label for="author">Auteur</label>
                                <input type="text" name="author" value="{{ Auth::user()->name }}" readonly="readonly">
                            </div>

                            <div class="option-form-input">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="updateSlug">
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

        <!-- Modal reading -->
        <div class="modal fade" id="readingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="readingModalTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="readingNewsIntroDesc">

                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal delete -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Supprimer cet article ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="option-game-form" method="get" action="{{ route('delete_news') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                            <input type="hidden" name="deleteId" id="deleteId">

                            <p>Êtes-vous sûr de vouloir supprimer cet article ?</p>

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
            
            // UPDATE NEWS
            $('.update-modal').click(function () {
                
                var id = $(this).attr('data-id');
                var game = $(this).attr('data-game');
                var category = $(this).attr('data-category');
                var title = $(this).attr('data-title');
                var introHighlight = $(this).attr('data-intro-highlight');
                var intro = $(this).attr('data-intro');
                var desc = $(this).attr('data-desc');
                var slug = $(this).attr('data-slug');
                
                document.getElementById('updateId').value = id;
                document.getElementById('updateGame').value = game;
                document.getElementById('updateCategory').value = category;
                document.getElementById('updateTitle').value = title;
                document.getElementById('updateIntroHighlight').value = introHighlight;
                document.getElementById('updateIntro').value = intro;
                document.getElementById('updateDesc').value = desc;
                document.getElementById('updateSlug').value = slug;
                
            })
            
            // READING INTRO/DESC
            $('.reading-modal').click(function () {
                
                var gameIntro = $(this).attr('data-intro');
                var gameDesc = $(this).attr('data-desc');
                
                if(gameIntro){
                    document.getElementById('readingNewsIntroDesc').innerHTML = gameIntro;
                    document.getElementById('readingModalTitle').innerHTML = "Introduction";
                } else {
                    document.getElementById('readingNewsIntroDesc').innerHTML = gameDesc;
                    document.getElementById('readingModalTitle').innerHTML = "Description";
                }
                
            })
            
            // DELETE NEWS
            $('.delete-modal').click(function () {
                
                var id = $(this).attr('data-id');
                
                document.getElementById('deleteId').value = id;
                
            })
            
            // DATATABLES
            $('#adminNewsDataTable').DataTable({
                "lengthMenu": [7, 15, 25, 50, 100],
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

            // CHOOSE FILE CUSTOM BUTTON
            const imageAdd = document.getElementById('imageAdd');
            const fileChosenAdd = document.getElementById('file-chosen-add');

            imageAdd.addEventListener('change', function(){
                fileChosenAdd.textContent = this.files[0].name
            })

            const imageUpdate = document.getElementById('imageUpdate');
            const fileChosenUpdate = document.getElementById('file-chosen-update');

            imageUpdate.addEventListener('change', function(){
                fileChosenUpdate.textContent = this.files[0].name
            })

        })
    </script>
@endpush