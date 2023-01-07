

<?php $__env->startSection('content'); ?>

    <div class="games">

        <p>Liste des jeux</p>

        <div>

            <div class="option-game">

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-secondary option-game-btn" data-toggle="modal" data-target="#addModal">Ajouter un jeu</button>

            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th>
                            <img class="card-game-admin" src="<?php echo e(url('')); ?>/<?php echo e($game->poster); ?>" alt="...">
                        </th>
                        <th><?php echo e($game->title); ?></th>
                        <?php $__currentLoopData = $game->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th><?php echo e($categorie->name); ?></th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <th><?php echo e($game->slug); ?></th>
                        <th>
                            <a href="" class="update-modal" data-toggle="modal" data-target="#updateModal" data-id="<?php echo e($game->id); ?>" data-title="<?php echo e($game->title); ?>" data-category="<?php echo e($categorie->id); ?>" data-poster="<?php echo e($game->poster); ?>" data-slug="<?php echo e($game->slug); ?>">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="" class="delete-modal" data-toggle="modal"  data-target="#deleteModal" data-id="<?php echo e($game->id); ?>">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </th>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <!-- Modal add -->
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Ajouter un jeu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="option-game-form" method="post" action="<?php echo e(route('add-game')); ?>" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                                <div class="option-game-form-input">
                                    <label for="title">Titre</label>
                                    <input type="text" name="title" id="">
                                </div>

                                <div class="option-game-form-input">
                                    <label for="category">Catégorie</label>
                                    <select name="category" id="">
                                        <option selected disabled>-</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="option-game-form-input">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="">
                                </div>

                                <div class="option-game-form-input">
                                    <label for="poster">Image</label>
                                    <input type="file" name="poster" id="">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-secondary">Enregistrer</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal update -->
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modifier un jeu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="option-game-form" method="post" action="<?php echo e(route('update-game')); ?>" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>


                                <input type="hidden" name="updateGameId" id="updateGameId">

                                <div class="option-game-form-input">
                                    <label for="title">Titre</label>
                                    <input type="text" name="title" id="updateGameTitle">
                                </div>

                                <div class="option-game-form-input">
                                    <label for="category">Catégorie</label>
                                    <select name="category" id="updateGameCategory">
                                        <option selected disabled>-</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="option-game-form-input">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="updateGameSlug">
                                </div>

                                <div class="option-game-form-input">
                                    <label for="poster">Image</label>
                                    <input type="file" name="poster" id="updateGamePoster">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-secondary">Enregistrer</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal delete -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Supprimer un jeu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="option-game-form" method="get" action="<?php echo e(route('delete-game')); ?>" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>


                                <input type="hidden" name="deleteGameId" id="deleteGameId">

                                <p>Êtes-vous de vouloir supprimer ce jeu ?</p>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-secondary">Confirmer</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    $('document').ready(function(){

        $('.update-modal').click(function () {

            var gameId = $(this).attr('data-id');
            var gameTitle = $(this).attr('data-title');
            var gameCategory = $(this).attr('data-category');
            var gameSlug = $(this).attr('data-slug');

            document.getElementById('updateGameId').value = gameId;
            document.getElementById('updateGameTitle').value = gameTitle;
            document.getElementById('updateGameCategory').value = gameCategory;
            document.getElementById('updateGameSlug').value = gameSlug;

        })

        $('.delete-modal').click(function () {

            var gameId = $(this).attr('data-id');

            document.getElementById('deleteGameId').value = gameId;

        })

    })
</script>
<?php echo $__env->make('partials._main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\bricedev\gnews\resources\views/admin/admin_games.blade.php ENDPATH**/ ?>