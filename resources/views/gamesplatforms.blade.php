@extends('partials._main')

@section('pageTitle', 'Plateformes')

@section('content')

    <div class="page-banner">
        <p>Plateforme : {{ $platform->platforms_name }}</p>
    </div>

    <div class="page-title">
        <h2><span>Parcourir</span></h2>
    </div>

    <div class="games">

        <div class="games-sidebar-media">
    
            <h4>Filtres</h4>
            <hr>
    
        </div>

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
                            @foreach($game->categories->slice(0,3)->sortBy('name') as $categorie)
                                <a href="{{ route('gamescategories', [$categorie->slug]) }}" class="game-tag">
                                    <span>{{ $categorie->name }}</span>
                                </a>
                            @endforeach
                        </div>
                        <div class="game-cat">
                            @foreach($game->platforms as $platform)
                                <a href="{{ route('gamesplatforms', [$platform->slug]) }}" class="game-tag-platform">
                                    <span>{!! $platform->logo !!}</span>
                                </a>
                            @endforeach
                        </div>
                        <a href="{{ route('gamesdetails', [$game->slug]) }}" class="game-more">
                            Voir la fiche
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="games-sidebar">
    
            <h4>Filtres</h4>
            <hr>
    
        </div>

    </div>

@endsection
