<div class="card-games">

    @foreach($games as $game)
        <div class="card-game">
            <a href="{{ route('gamesdetails', [$game->slug]) }}">
                <div class="card-game-img" >
                    <img src="{{ url('') }}/{{ $game->poster}}" alt="...">
                </div>
            </a>
            <div class="card-game-text">
                <h2>{{ Illuminate\Support\Str::limit($game->games_title, $limit = 20, $end = ' ...') }}</h2>
                <div class="game-cat">
                    @foreach($game->categories->slice(0, 2)->sortBy('name') as $categorie)
                        <a href="{{ route('gamescategories', [$categorie->slug]) }}" class="game-tag">
                            <span>{{ $categorie->name }}</span>
                        </a>
                    @endforeach
                </div>
                <div class="game-cat">
                    @foreach($game->platforms->sortBy('platforms_name') as $platform)
                        <a href="{{ route('gamesplatforms', [$platform->slug]) }}" class="game-tag-platform">
                            <span>{!! $platform->logo !!}</span>
                        </a>
                    @endforeach
                </div>
                <a href="{{ route('gamesdetails', [$game->slug]) }}" class="game-more">
                    Voir la fiche
                </a>
                <a href="" class="game-fav" data-toggle="modal" data-target="#addFavoriteGameModal" data-id="{{ $game->id }}" data-title="{{ Illuminate\Support\Str::limit($game->games_title, $limit = 20, $end = ' ...') }}">
                    @if(Auth::user()->games()->where('games_id', $game->id)->exists())
                        <i class="fa fa-star fa-star-fav"></i>
                    @else
                        <i class="far fa-star"></i>
                    @endif
                </a>
            </div>
        </div>
    @endforeach

</div>

<div class="items-paginate">
    {!! $games->links() !!}
</div>

<!-- Modal add favorite -->
<div class="modal fade" id="addFavoriteGameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFavoriteGameTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="" method="post" action="{{ route('add_favorite_game') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <input type="hidden" name="id" id="addFavoriteGameId">

                    <p>Êtes-vous sûr de vouloir ajouter ce jeu à vos favoris ?</p>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-secondary">Confirmer</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>