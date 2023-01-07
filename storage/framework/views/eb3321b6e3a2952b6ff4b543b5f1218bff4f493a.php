<body>
    <header>
        <nav>
            <a href="<?php echo e(route('home')); ?>" class="logo">
                <h1>PlayB<i class="fas fa-cube"></i>x</h1>
                <i class="fas fa-cube"></i>
            </a>
            <ul class="nav-links">
                <li><a href="<?php echo e(route('games')); ?>">Jeux</a></li>
                <li><a href="<?php echo e(route('news')); ?>">Actualité</a></li>
                <li><a href="<?php echo e(route('about')); ?>">À propos</a></li>
                <!-- Authentication Links -->
                <?php if(auth()->guard()->guest()): ?>
                    <li>
                        <a href="<?php echo e(route('login')); ?>"><i class="fas fa-sign-in-alt"></i><?php echo e(__('Se connecter')); ?></a>
                    </li>
                    <?php if(Route::has('register')): ?>
                        <li>
                            <a href="<?php echo e(route('register')); ?>"><i class="fas fa-clipboard-check"></i><?php echo e(__('S\'inscrire')); ?></a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a href="<?php echo e(route('admin_dashboard')); ?>"><i class="fas fa-user-shield"></i><?php echo e(__('Administrateur')); ?></a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <?php echo e(__('Se déconnecter')); ?>

                            <span>(<?php echo e(Auth::user()->name); ?>)</span>
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>
                <?php endif; ?>
            </ul>
            <div class="burger">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </nav>
    </header>
<?php /**PATH C:\wamp64\www\bricedev\gnews\resources\views/partials/_header.blade.php ENDPATH**/ ?>