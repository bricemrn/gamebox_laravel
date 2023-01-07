

<?php $__env->startSection('pageTitle', $news->news_title); ?>

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

                        
                        <textarea name="comment" id="comment" class="comment" cols="30" rows="10" placeholder="Écrire un commentaire"></textarea>

                        <small id="smallComment" class="small-error"></small>
                        
                        <button class="btn btn-warning" type="submit">Publier</button>
    
                    </form>
                <?php else: ?>
                    <div class="btn1">
                        <a href="<?php echo e(route('login')); ?>">
                            <span>Connectez-vous pour laisser votre commentaire</span>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if(session()->has('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session()->get('success')); ?>

                    </div>
                <?php endif; ?>

                <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="comment">

                        <div class="comment-avatar">
                            <img src="<?php echo e(url('')); ?>/<?php echo e($comment->avatar); ?>" alt="">
                        </div>

                        <div>
                            <div class="comment-author">
                                <span style="margin: 4px 0"><strong><?php echo e($comment->name); ?></strong>,</span>
                                <span style="font-size: .8em"><?php echo e(\Carbon\Carbon::parse($comment->created_at)->diffForHumans()); ?></span>
                                <?php if($comment->users_id == Auth::user()->id): ?>
                                    <button class="comment-delete" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo e($comment->id); ?>">supprimer</button>
                                <?php endif; ?>
                            </div>
                            
                            <div class="comment-content">
                                <p><?php echo e($comment->comments_body); ?></p>
                            </div>
                        </div>

                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <!-- Modal delete -->
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Supprimer un commentaire</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="" method="get" action="<?php echo e(route('delete_comments')); ?>" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>


                                    <input type="hidden" name="commentId" id="commentId">

                                    <p>Êtes-vous sûr de vouloir supprimer ce commentaire ?</p>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-secondary">Confirmer</button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="items-paginate">
                    <?php echo e($comments->links()); ?>

                </div>


            </div>

        </div>
        
        <div class="page-details-sidebar">

            <?php $__currentLoopData = $news->games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <h4>Autres articles de <?php echo e($game->games_title); ?></h4>
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
                <p>Aucun article pour le moment.</p>
            <?php endif; ?>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>

        $(document).ready(function(){

            /** KEEP SCROLL POSITION AFTER REFRESH **/  
            $(window).scroll(function () {
                sessionStorage.scrollTop = $(this).scrollTop();
            });

            $(document).ready(function () {
                if (sessionStorage.scrollTop != "undefined") {
                    $(window).scrollTop(sessionStorage.scrollTop);
                }
            });

            // VALIDATE COMMENT
            var form = document.querySelector(".comment-form");
            var comment = document.querySelector("#comment");
            var smallComment = $("#smallComment");
            var message = "Attention ! Vous n'avez pas rédigé votre commentaire";

            smallComment.hide();

            form.addEventListener("submit", (e) => {

                if(comment.value === ""){
                    e.preventDefault();
                    smallComment.show();
                    smallComment.html(message);
                    comment.className = "comment comment-error";
                } else {
                    smallComment.hide();
                    comment.className = "comment";
                }
            })

            // DELETE COMMENT
            $('.comment-delete').click(function (e) {
                
                var commentId = $(this).attr('data-id');
                console.log(commentId)
                document.getElementById('commentId').value = commentId;
                
            })

        })

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('partials._main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\bricedev\gamebox_prod\resources\views/newsdetails.blade.php ENDPATH**/ ?>