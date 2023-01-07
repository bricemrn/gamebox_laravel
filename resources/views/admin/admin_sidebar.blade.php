<div class="admin-sidebar">
    <div class="sidebar-intro">
        <img class="sidebar-img" src="{{ url('') }}/assets/images/admin/gandalf2.jpg" alt="">
        <h6>{{ Auth::user()->name }}</h6>
        <li>
            <a class="admin-logout" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Se déconnecter') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </div>
    <div class="sidebar-menu">
        <ul>
            <a href="{{ route('admin_dashboard') }}" id="admin_dashboard">
                <i class="fas fa-chart-line fa-chart-line-admin"></i>Tableau de bord
            </a>
            <a href="{{ route('admin_games') }}" id="admin_games">
                <i class="fas fa-gamepad fa-gamepad-admin"></i>Jeux
            </a>             
            <a href="{{ route('admin_categories') }}" id="admin_categories">
                <i class="fas fa-gamepad fa-gamepad-admin"></i>Catégories
            </a> 
            <a href="{{ route('admin_platforms') }}" id="admin_platforms">
                <i class="fas fa-gamepad fa-gamepad-admin"></i>Plateformes
            </a>             
            <a href="{{ route('admin_news') }}" id="admin_news">
                <i class="far fa-newspaper fa-newspaper-admin"></i>Actualités
            </a> 
            <a href="{{ route('admin_news_highlights') }}" id="admin_news_highlights">
                <i class="far fa-newspaper fa-newspaper-admin"></i> Actualités hightlights
            </a>              
            <a href="{{ route('admin_users') }}" id="admin_users">
                <i class="fas fa-users fa-users-admin"></i></i>Utilisateurs
            </a>          
            <a href="{{ route('home')}}"  id="home">
                <i class="fas fa-cube fa-cube-admin"></i>Retour accueil
            </a>
            <br>      
        </ul>
    </div>
</div>

@push('script')
    <script>
        // HIGHLIGHT NAV ITEM OF THE CURRENT PAGE
        window.onload = function () {
            var pathCurrentPage = location.pathname;

            if (pathCurrentPage == "/") {
                $("#home").addClass("current-admin-page");
            }
            if (pathCurrentPage == "/admin") {
                $("#admin_dashboard").addClass("current-admin-page");
            }
            if (pathCurrentPage == "/admin/jeux") {
                $("#admin_games").addClass("current-admin-page");
            }        
            if (pathCurrentPage == "/admin/categories") {
                $("#admin_categories").addClass("current-admin-page");
            }
            if (pathCurrentPage == "/admin/plateformes") {
                $("#admin_platforms").addClass("current-admin-page");
            }        
            if (pathCurrentPage == "/admin/actualite") {
                $("#admin_news").addClass("current-admin-page");
            }
            if (pathCurrentPage == "/admin/actualite/highlight") {
                $("#admin_news_highlights").addClass("current-admin-page");
            }
            if (pathCurrentPage == "/admin/utilisateurs") {
                $("#admin_users").addClass("current-admin-page");
            }        
        };
    </script>
@endpush