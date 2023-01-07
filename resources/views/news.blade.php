@extends('partials._main')

@section('pageTitle', 'Actualité')

@section('content')

    <div class="page-banner">
        <p>Actualité</p>
    </div>

    <div class="page-title">
        <h2><span>À l'affiche</span></h2>
    </div>

    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-intervale="2000">

        <ol class="carousel-indicators">
            @foreach($newsHighlighted as $new)
                <li data-target="#myCarousel" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
            @endforeach
        </ol>

        <div class="carousel-inner">

            @foreach($newsHighlighted as $new)
            <div class="carousel-item item {{ $loop->first ? ' active' : '' }}">
                <img class="d-block w-100" src="{{ url('') }}/{{ $new->image}}" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $new->news_title }}</h5>
                    <p>{{ $new->desc_intro_highlight }}</p>
                </div>
            </div>
            @endforeach

        </div>

        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        
    </div>

    <div class="page-title">
        <h2><span>Derniers articles</span></h2>
    </div>

    <div class="news">

        @foreach($lastNews as $new)
            <div class="news-card">
                <div class="news-card-header">
                    <a href="{{ route('newsdetails', [$new->slug]) }}">
                        <img src="{{ url('') }}/{{ $new->image }}" alt="">
                    </a>
                </div>
                <div class="news-card-body">
                    <div class="news-card-meta">
                        <span>Par {{ $new->author }}, {{ Carbon\Carbon::parse($new->created_at)->diffForHumans() }}</span>
                    </div>
                    <div class="news-card-tag">
                        @foreach($new->games as $game)
                            <a href="{{ route('gamesdetails', [$game->slug]) }}" class="game-tag">
                                <span>{{ $game->games_title }}</span>
                            </a>
                        @endforeach
                        @foreach($new->categories as $category)
                            <a href="" class="game-tag">
                                <span>{{ $category->name }}</span>
                            </a>
                        @endforeach                  
                    </div>
                    <div class="news-card-intro">
                        <p>
                            {{ \Illuminate\Support\Str::limit($new->desc_intro, $limit = 50, $end = ' ...') }}
                        </p>
                    </div>
                    <div class="news-card-desc">
                        <p>
                            {{ \Illuminate\Support\Str::limit($new->desc_body, $limit = 160, $end = ' ...') }}
                        </p>
                    </div>
                    <div class="btn1">
                        <a href="{{ route('newsdetails', [$new->slug]) }}">
                            <span>Lire plus</span>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection