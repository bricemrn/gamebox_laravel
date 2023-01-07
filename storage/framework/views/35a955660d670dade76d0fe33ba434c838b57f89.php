

<?php $__env->startSection('pageTitle', 'Actualité'); ?>

<?php $__env->startSection('content'); ?>

    <div class="page-banner">
        <p>Actualité</p>
    </div>

    <div class="page-title">
        <h2><span>À l'affiche</span></h2>
    </div>

    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-intervale="2000">

        <ol class="carousel-indicators">
            <?php $__currentLoopData = $newsHighlighted; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li data-target="#myCarousel" data-slide-to="<?php echo e($loop->index); ?>" class="<?php echo e($loop->first ? 'active' : ''); ?>"></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>

        <div class="carousel-inner">

            <?php $__currentLoopData = $newsHighlighted; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="carousel-item item <?php echo e($loop->first ? ' active' : ''); ?>">
                <img class="d-block w-100" src="<?php echo e(url('')); ?>/public/<?php echo e($new->image); ?>" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo e($new->news_title); ?></h5>
                    <p><?php echo e($new->desc_intro_highlight); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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

        <?php $__currentLoopData = $lastNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="news-card">
                <div class="news-card-header">
                    <a href="<?php echo e(route('newsdetails', [$new->slug])); ?>">
                        <img src="<?php echo e(url('')); ?>/public/<?php echo e($new->image); ?>" alt="">
                    </a>
                </div>
                <div class="news-card-body">
                    <div class="news-card-meta">
                        <span>Par <?php echo e($new->author); ?>, <?php echo e(Carbon\Carbon::parse($new->created_at)->diffForHumans()); ?></span>
                    </div>
                    <div class="news-card-tag">
                        <?php $__currentLoopData = $new->games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('gamesdetails', [$game->slug])); ?>" class="game-tag">
                                <span><?php echo e($game->games_title); ?></span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $new->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="" class="game-tag">
                                <span><?php echo e($category->name); ?></span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                  
                    </div>
                    <div class="news-card-intro">
                        <p>
                            <?php echo e(\Illuminate\Support\Str::limit($new->desc_intro, $limit = 50, $end = ' ...')); ?>

                        </p>
                    </div>
                    <div class="news-card-desc">
                        <p>
                            <?php echo e(\Illuminate\Support\Str::limit($new->desc_body, $limit = 160, $end = ' ...')); ?>

                        </p>
                    </div>
                    <div class="btn1">
                        <a href="<?php echo e(route('newsdetails', [$new->slug])); ?>">
                            <span>Lire plus</span>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials._main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/94e6ac6d287e346ebaeea29a3b71eb72/sites/gamebox.wewantdev.fr/gamebox/resources/views/news.blade.php ENDPATH**/ ?>