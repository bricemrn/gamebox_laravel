<header>
    <nav>
        <div class="logo">
            <a href="<?php echo e(route('games')); ?>">
                <h1>GameB<i class="fas fa-cube"></i>x</h1>
                <i class="fas fa-cube"></i>
            </a>
        </div>
        <ul class="nav-links">

            <div class="nav-menu">

                <div class="nav-menu-dropdown">
                    <div class="games-tab">
                        <a href="<?php echo e(route('games')); ?>" id="games">Jeux</a>
                    </div> 
                    <div class="news-tab">
                        <a href="<?php echo e(route('news')); ?>" id="news">Actualité</a>
                    </div> 
                    <div class="categories-tab">
                        <button id="categories">Catégories</button>
                        <div>
                            <ul>
                                <?php $__currentLoopData = $categories->sortBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('gamescategories', [$categorie->slug])); ?>"><?php echo e($categorie->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>                    
                    <div class="platforms-tab">
                        <button id="platforms">Plateformes</button>
                        <div>
                            <ul>
                                <?php $__currentLoopData = $platforms->sortBy('platforms_name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('gamesplatforms',[$platform->slug])); ?>"><?php echo e($platform->platforms_name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>

                
                
            </div>

            <div class="nav-login">
                <!-- Authentication Links -->
                <?php if(auth()->guard()->guest()): ?>
                    <div>
                        <a href="<?php echo e(route('login')); ?>"><i class="fas fa-sign-in-alt"></i><?php echo e(__('Connexion')); ?></a>
                    </div>
                    <?php if(Route::has('register')): ?>
                        <li>
                            <a href="<?php echo e(route('register')); ?>"><i class="fas fa-clipboard-check"></i><?php echo e(__('Inscription')); ?></a>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <div>
                        <a href="<?php echo e(route('profile', [Auth::user()->id])); ?>" id="profile"><img src="<?php echo e(url('')); ?>/<?php echo e(Auth::user()->avatar); ?>" alt="" class="nav-profile-img"><?php echo e(Auth::user()->name); ?></a>
                    </div>
                    <div>
                        <a href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <?php echo e(__('Déconnexion')); ?>

                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </ul>
        <div class="burger">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </nav>
</header>
<?php /**PATH C:\wamp64\www\bricedev\gamebox_prod\resources\views/partials/_header.blade.php ENDPATH**/ ?>