<header>
    <nav>
        <div class="logo">
            <a href="{{ route('games') }}">
                <h1>GameB<i class="fas fa-cube"></i>x</h1>
                <i class="fas fa-cube"></i>
            </a>
        </div>
        <ul class="nav-links">

            <div class="nav-menu">

                <div class="nav-menu-dropdown">
                    <div class="games-tab">
                        <a href="{{ route('games') }}" id="games">Jeux</a>
                    </div> 
                    <div class="news-tab">
                        <a href="{{ route('news') }}" id="news">Actualité</a>
                    </div> 
                    <div class="categories-tab">
                        <button id="categories">Catégories</button>
                        <div>
                            <ul>
                                @foreach($categories->sortBy('name') as $categorie)
                                <li><a href="{{ route('gamescategories', [$categorie->slug]) }}">{{ $categorie->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>                    
                    <div class="platforms-tab">
                        <button id="platforms">Plateformes</button>
                        <div>
                            <ul>
                                @foreach($platforms->sortBy('platforms_name') as $platform)
                                <li><a href="{{route('gamesplatforms',[$platform->slug]) }}">{{ $platform->platforms_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- <li>
                    <a href="{{ route('about') }}" id="about">À propos</a>
                </li> --}}
                
            </div>

            <div class="nav-login">
                <!-- Authentication Links -->
                @guest
                    <div>
                        <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i>{{ __('Connexion') }}</a>
                    </div>
                    @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}"><i class="fas fa-clipboard-check"></i>{{ __('Inscription') }}</a>
                        </li>
                    @endif
                @else
                    <div>
                        <a href="{{ route('profile', [Auth::user()->id]) }}" id="profile"><img src="{{ url('') }}/{{ Auth::user()->avatar }}" alt="" class="nav-profile-img">{{ Auth::user()->name }}</a>
                    </div>
                    <div>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            {{ __('Déconnexion') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                @endguest
            </div>
        </ul>
        <div class="burger">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </nav>
</header>
