@extends('partials._main')

@section('pageTitle', $game->games_title)

@section('content')

    <div class="page-banner">
        <p>{{ $game->games_title }}</p>
    </div>

    <div class="back-to">
        <div class="btn1">
            <a href="{{ route('games') }}">
                <span>Retour aux jeux</span>
            </a>
        </div>
    </div>
    
    <div class="page-details">

        <div class="page-details-content">

            <p class="page-details-meta">
                Date de sortie : <strong>{{ \Carbon\Carbon::parse($game->release_date)->format('d-m-Y') }}</strong>
            </p>            
            <p class="page-details-meta meta-responsive">
                Catégorie(s) : 
                @foreach($game->categories as $category)
                    <a href="{{ route('gamescategories', [$category->slug]) }}" class="game-tag">
                        <span>{{ $category->name }}</span>
                    </a>
                @endforeach
            </p>
            <p class="page-details-meta">
                Plateforme(s) : 
                @foreach($game->platforms as $platform)
                    <a href="{{ route('gamesplatforms', [$platform->slug]) }}" class="game-tag-platform">
                        <span>{!! $platform->logo !!}</span>
                    </a>
                @endforeach
            </p>

            <p class="page-details-intro">
                {{ $game->desc_intro }}
            </p>

            <img src="{{ url('') }}/{{ $game->poster}}" alt="">

            <p class="page-details-body">
                {{ $game->desc_body }}
            </p>
        
        </div>
        
        <div class="page-details-sidebar">

            <h4>Actualité de {{ $game->games_title }}</h4>
            <hr>

            @forelse($gameNews as $news)
                    <a href="{{ route('newsdetails', [$news->slug]) }}">
                        <div class="inline-card">
                            <div class="img">
                                <img src="{{ url('') }}/{{ $news->image }}" alt="">
                            </div>
                            <div class="body">
                                <h6>{{ $news->news_title }}</h6>
                                <p>{{ \Illuminate\Support\Str::limit($news->desc_intro, $limit = 80, $end = ' ...') }}</p>
                            </div>
                        </div>
                    </a>
            @empty
                <p>Aucun article pour le moment.</p>
            @endforelse

        </div>

    </div>

@endsection