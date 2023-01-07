<div class="card-games">

    <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card-game">
            <a href="<?php echo e(route('gamesdetails', [$game->slug])); ?>">
                <div class="card-game-img" >
                    <img src="<?php echo e(url('')); ?>/<?php echo e($game->poster); ?>" alt="...">
                </div>
            </a>
            <div class="card-game-text">
                <h2><?php echo e(Illuminate\Support\Str::limit($game->games_title, $limit = 20, $end = ' ...')); ?></h2>
                <div class="game-cat">
                    <?php $__currentLoopData = $game->categories->slice(0, 2)->sortBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('gamescategories', [$categorie->slug])); ?>" class="game-tag">
                            <span><?php echo e($categorie->name); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="game-cat">
                    <?php $__currentLoopData = $game->platforms->sortBy('platforms_name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('gamesplatforms', [$platform->slug])); ?>" class="game-tag-platform">
                            <span><?php echo $platform->logo; ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <a href="<?php echo e(route('gamesdetails', [$game->slug])); ?>" class="game-more">
                    Voir la fiche
                </a>
                <a href="" class="game-fav" data-toggle="modal" data-target="#addFavoriteGameModal" data-id="<?php echo e($game->id); ?>" data-title="<?php echo e(Illuminate\Support\Str::limit($game->games_title, $limit = 20, $end = ' ...')); ?>">
                    <?php if(Auth::user()->games()->where('games_id', $game->id)->exists()): ?>
                        <i class="fa fa-star fa-star-fav"></i>
                    <?php else: ?>
                        <i class="far fa-star"></i>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

<div class="items-paginate">
    <?php echo $games->links(); ?>

</div>

<!-- Modal add favorite -->
<div class="modal fade" id="addFavoriteGameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFavoriteGameTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="" method="post" action="<?php echo e(route('add_favorite_game')); ?>" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>


                    <input type="hidden" name="id" id="addFavoriteGameId">

                    <p>Êtes-vous sûr de vouloir ajouter ce jeu à vos favoris ?</p>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-secondary">Confirmer</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\wamp64\www\bricedev\gamebox_prod\resources\views/gamesresults.blade.php ENDPATH**/ ?>