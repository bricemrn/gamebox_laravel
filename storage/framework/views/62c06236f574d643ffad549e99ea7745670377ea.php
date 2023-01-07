<div class="admin-sidebar">
    <div class="sidebar-intro">
        <img class="sidebar-img" src="../assets/images/admin/gandalf2.jpg" alt="">
        <h6><?php echo e(Auth::user()->name); ?></h6>
        <li>
            <a href="<?php echo e(route('logout')); ?>"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                <?php echo e(__('Se déconnecter')); ?>

            </a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                <?php echo csrf_field(); ?>
            </form>
        </li>
    </div>
    <div class="sidebar-menu">
        <ul>
            <a href="<?php echo e(route('admin_dashboard')); ?>" id="admin_dashboard">
                <i class="fas fa-chart-line fa-chart-line-admin"></i>Tableau de bord
            </a>
            <a href="<?php echo e(route('admin_users')); ?>" id="admin_users">
                <i class="fas fa-users fa-users-admin"></i></i>Utilisateurs
            </a>          
            <a href="<?php echo e(route('admin_games')); ?>" id="admin_games">
                <i class="fas fa-gamepad fa-gamepad-admin"></i>Jeux
            </a>             
            <a href="<?php echo e(route('admin_platforms')); ?>" id="admin_platforms">
                <i class="fas fa-gamepad fa-gamepad-admin"></i>Plateformes
            </a>             
            <a href="<?php echo e(route('admin_categories')); ?>" id="admin_categories">
                <i class="fas fa-gamepad fa-gamepad-admin"></i>Catégories
            </a> 
            <a href="<?php echo e(route('admin_news')); ?>" id="admin_news">
                <i class="far fa-newspaper fa-newspaper-admin"></i>News
            </a> 
            <a href="<?php echo e(route('admin_news_highlights')); ?>" id="admin_news_highlights">
                <i class="far fa-newspaper fa-newspaper-admin"></i> News hightlights
            </a>              
            <a href="<?php echo e(route('home')); ?>"  id="home">
                <i class="fas fa-cube fa-cube-admin"></i>Retour accueil
            </a>
            <br>      
        </ul>
    </div>
</div>

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
        if (pathCurrentPage == "/admin/plateformes") {
            $("#admin_platforms").addClass("current-admin-page");
        }        
        if (pathCurrentPage == "/admin/categories") {
            $("#admin_categories").addClass("current-admin-page");
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
</script><?php /**PATH C:\wamp64\www\bricedev\gamebox\resources\views/admin/admin_sidebar.blade.php ENDPATH**/ ?>