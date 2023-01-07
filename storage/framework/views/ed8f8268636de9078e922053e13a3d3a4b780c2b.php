

<?php $__env->startSection('content'); ?>

    <div class="page-banner">
        <p><?php echo e($news->news_title); ?></p>
    </div>

    <div class="back-to">
        <div class="btn1">
            <a href="<?php echo e(route('news')); ?>">
                <span>Retour à l'actualité</span>
            </a>
        </div>
    </div>
    
    <div class="page-details">

        <div class="page-details-content">

            <p class="page-details-meta">
                Par <strong><?php echo e($news->author); ?></strong>, <?php echo e(\Carbon\Carbon::parse($news->created_at)->diffForHumans()); ?>

            </p>

            <p class="page-details-intro">
                <?php echo e($news->desc_intro); ?>

            </p>
            
            <img src="<?php echo e(url('')); ?>/<?php echo e($news->image); ?>" alt="">
            
            <p class="page-details-body">
                <?php echo e($news->desc_body); ?>

            </p>
            
            <div class="comments">
                
                <hr>
                
                <p><?php echo e(count($comments)); ?> commentaires</p>
                
                <?php if(Auth::user()): ?>
                    <form class="comment-form" action="<?php echo e(route('newscomments', [$news->id])); ?>" method="post">
    
                        <?php echo e(csrf_field()); ?>

    
                        <textarea name="comment" id="" cols="30" rows="10" placeholder="Écrire un commentaire"></textarea>
                        
                        <button class="btn btn-warning" type="submit">Publier</button>
    
                    </form>
                <?php else: ?>
                    <div class="btn1">
                        <a href="<?php echo e(route('login')); ?>">
                            <span>Connectez-vous pour laisser votre commentaire</span>
                        </a>
                    </div>
                <?php endif; ?>

                <div class="newsdetails-paginate">
                    <?php echo e($comments->links()); ?>

                </div>

                <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="comment">

                        <div class="comment-avatar">
                            <img src="<?php echo e(url('')); ?>/<?php echo e($comment->avatar); ?>" alt="">
                        </div>

                        <div>
                            <div class="comment-author">
                                <span style="margin: 4px 0"><strong><?php echo e($comment->name); ?></strong>,</span>
                                <span style="font-size: .8em"><?php echo e(\Carbon\Carbon::parse($comment->created_at)->diffForHumans()); ?></span>
                            </div>
                            
                            <div class="comment-content">
                                <p><?php echo e($comment->comments_body); ?></p>
                            </div>
                        </div>

                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <div class="newsdetails-paginate">
                    <?php echo e($comments->links()); ?>

                </div>


            </div>

        </div>
        
        <div class="page-details-sidebar">

            <?php $__currentLoopData = $news->games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <h4>Actualité de <?php echo e($game->games_title); ?></h4>
                <hr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php $__empty_1 = true; $__currentLoopData = $otherNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>

    /** KEEP SCROLL POSITION AFTER REFRESH **/  
    $(window).scroll(function () {
        sessionStorage.scrollTop = $(this).scrollTop();
    });

    $(document).ready(function () {
        if (sessionStorage.scrollTop != "undefined") {
            $(window).scrollTop(sessionStorage.scrollTop);
        }
    });

</script>
<?php echo $__env->make('partials._main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\bricedev\gamebox\resources\views/newsdetails.blade.php ENDPATH**/ ?>