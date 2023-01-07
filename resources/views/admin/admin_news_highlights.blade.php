@extends('partials._admin_main')

@section('pageTitle', 'Gestion actualités highlights')

@section('content')

    @include('admin.admin_sidebar')

    <div class="admin-view">

        <p>Gestion des actualités highlights</p>

        <form action="{{ route('add_news_highlights') }}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="option-btn">

                <button type="submit" class="btn btn-secondary option-btn">Mise à jour</button>

            </div>

            <table class="table table-striped" id="adminNewsDataTable">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Jeu</th>
                        <th>Catégorie</th>
                        <th>Titre</th>
                        <th>Intro highlight</th>
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
                            <select name="highlighted[{{ $new->id }}]">
                                @if($new->highlighted == 0)
                                    <option value="0">Not highlighted</option>
                                    <option value="1">Highlighted</option>
                                @elseif($new->highlighted == 1)
                                    <option value="1">Highlighted</option>
                                    <option value="0">Not highlighted</option>
                                @else
                                @endif
                            </select>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>

    </div>

@endsection

@push('script')
    <script>

        $('document').ready(function(){

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

        })

    </script>
@endpush