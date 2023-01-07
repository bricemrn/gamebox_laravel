

<?php $__env->startSection('content'); ?>

    <div class="page-banner">
        <p><?php echo e($game->games_title); ?></p>
    </div>

    <div class="back-to">
        <div class="btn1">
            <a href="<?php echo e(route('games')); ?>">
                <span>Retour aux jeux</span>
            </a>
        </div>
    </div>
    
    <div class="page-details">

        <div class="page-details-content">

            <p class="page-details-meta">
                Date de sortie : <strong><?php echo e(\Carbon\Carbon::parse($game->release_date)->format('d-m-Y')); ?></strong>
            </p>            
            <p class="page-details-meta">
                Catégorie(s) : 
                <?php $__currentLoopData = $game->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('gamescategories', [$category->slug])); ?>" class="game-tag">
                        <span><?php echo e($category->name); ?></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>
            <p class="page-details-meta">
                Plateforme(s) : 
                <?php $__currentLoopData = $game->platforms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('gamesplatforms', [$platform->slug])); ?>" class="game-tag-platform">
                        <span><?php echo $platform->logo; ?></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>

            <p class="page-details-intro">
                <?php echo e($game->desc_intro); ?>

            </p>

            <img src="<?php echo e(url('')); ?>/<?php echo e($game->poster); ?>" alt="">

            <p class="page-details-body">
                <?php echo e($game->desc_body); ?>

            </p>
        
        </div>
        
        <div class="page-details-sidebar">

            <h4>Actualité de <?php echo e($game->games_title); ?></h4>
            <hr>

            <?php $__empty_1 = true; $__currentLoopData = $gameNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('newsdetails', [$news->slug])); ?>">
                        <div class="inline-card">
                            <div class="img">
                                <img src="<?php echo e(url('')); ?>/<?php echo e($news->image); ?>" alt="">
                            </div>
                            <div class="body">
                                <h6><?php echo e($news->news_title); ?></h6>
                                <p><?php echo e(\Illuminate\Support\Str::limit($news->desc_intro, $limit = 80, $end = ' ...')); ?></p>
                            </div>
                        </div>
                    </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p>Aucun articles pour le moment</p>
            <?php endif; ?>

        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials._main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\bricedev\gamebox\resources\views/gamesdetails.blade.php ENDPATH**/ ?>