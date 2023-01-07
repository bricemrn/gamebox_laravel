

<?php $__env->startSection('content'); ?>
    <div class="games">
        <p>Parcourir</p>
        <div class="filters">
            <span>Trier</span>
        </div>         
        <div class="card-games">
            <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card-game">
                    <a href="">
                        <div class="card-game-img" >
                            <img src="<?php echo e(url('')); ?>/<?php echo e($game->poster); ?>" alt="...">
                        </div>
                        <div class="card-game-text">
                            <h2><?php echo e($game->title); ?></h2>
                            <?php $__currentLoopData = $game->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span><?php echo e($categorie->name); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials._main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\bricedev\gnews\resources\views/games.blade.php ENDPATH**/ ?>