

<?php $__env->startSection('pageTitle', 'Plateformes'); ?>

<?php $__env->startSection('content'); ?>

    <div class="page-banner">
        <p>Plateforme : <?php echo e($platform->platforms_name); ?></p>
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
            <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card-game">
                    <a href="<?php echo e(route('gamesdetails', [$game->slug])); ?>">
                        <div class="card-game-img" >
                            <img src="<?php echo e(url('')); ?>/public/<?php echo e($game->poster); ?>" alt="...">
                        </div>
                    </a>
                    <div class="card-game-text">
                        <h2><?php echo e(Illuminate\Support\Str::limit($game->games_title, $limit = 20, $end = ' ...')); ?></h2>
                        <div class="game-cat">
                            <?php $__currentLoopData = $game->categories->slice(0,3)->sortBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('gamescategories', [$categorie->slug])); ?>" class="game-tag">
                                    <span><?php echo e($categorie->name); ?></span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="game-cat">
                            <?php $__currentLoopData = $game->platforms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('gamesplatforms', [$platform->slug])); ?>" class="game-tag-platform">
                                    <span><?php echo $platform->logo; ?></span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <a href="<?php echo e(route('gamesdetails', [$game->slug])); ?>" class="game-more">
                            Voir la fiche
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="games-sidebar">
    
            <h4>Filtres</h4>
            <hr>
    
        </div>

    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('partials._main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/94e6ac6d287e346ebaeea29a3b71eb72/sites/gamebox.wewantdev.fr/gamebox/resources/views/gamesplatforms.blade.php ENDPATH**/ ?>