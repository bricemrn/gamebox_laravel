<!DOCTYPE html> <!-- Need this code here. If is not, TinyMCE Text Editor doesn't work -->


<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('admin.admin_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <div class="admin-view">

        <p>Liste des jeux</p>

        <div>

            <div class="option-btn">

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-secondary option-btn" data-toggle="modal" data-target="#addModal">Ajouter un jeu</button>

            </div>

            <table class="table table-striped" id="adminGameDataTable">
                <thead>
                    <tr>
                        <th>Poster</th>
                        <th>Titre</th>
                        <th>Catégorie(s)</th>
                        <th>Plateforme(s)</th>
                        <th>Intro</th>
                        <th>Desc</th>
                        <th>Date (sortie)</th>
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
                        <th><?php echo e($game->games_title); ?></th>
                        <th>
                            <?php $__currentLoopData = $game->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gameCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($gameCategory->name); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </th>
                        <th>
                            <?php $__currentLoopData = $game->platforms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($platform->platforms_name); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </th>
                        <th>
                            <a href="" class="reading-modal" data-toggle="modal" data-target="#readingModal" data-intro="<?php echo e($game->desc_intro); ?>">
                                <i class="far fa-eye fa-eye-admin"></i>
                            </a>
                        </th>
                        <th>
                            <a href="" class="reading-modal" data-toggle="modal" data-target="#readingModal" data-desc="<?php echo e($game->desc_body); ?>">
                                <i class="far fa-eye fa-eye-admin"></i>
                            </a>
                        </th>
                        <th><?php echo e(date('d-m-Y', strtotime($game->release_date))); ?></th>
                        <th><?php echo e($game->slug); ?></th>
                        <th>
                            <a href="" class="update-modal" data-toggle="modal" data-target="#updateModal" data-id="<?php echo e($game->id); ?>" data-poster="<?php echo e($game->poster); ?>" data-title="<?php echo e($game->games_title); ?>" data-categories="<?php echo e($game->categories->pluck('id')); ?>" data-intro="<?php echo e($game->desc_intro); ?>" data-desc="<?php echo e($game->desc_body); ?>" data-date="<?php echo e($game->release_date); ?>" data-slug="<?php echo e($game->slug); ?>">
                                <i class="fas fa-edit fa-edit-admin"></i>
                            </a>
                            <a href="" class="delete-modal" data-toggle="modal"  data-target="#deleteModal" data-id="<?php echo e($game->id); ?>">
                                <i class="fas fa-trash fa-trash-admin"></i>
                            </a>
                        </th>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <!-- Modal add -->
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Ajouter un jeu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="option-game-form" method="post" action="<?php echo e(route('add_game')); ?>" enctype="multipart/form-data">

                                <?php echo e(csrf_field()); ?>

                                
                                <div class="option-form-input">
                                    <label for="poster">Image</label>
                                    <input type="file" name="poster" class="fileSelect">
                                </div>

                                <div class="option-form-input">
                                    <label for="title">Titre</label>
                                    <input type="text" name="title">
                                </div>

                                <div class="option-form-input">
                                    <label>Catégorie(s)</label>
                                    <div>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <input type="checkbox" name="category[]" value="<?php echo e($category->id); ?>">
                                            <label for="category[]" class="categoryCheckbox"><?php echo e($category->name); ?></label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div> 

                                <div class="option-form-input">
                                    <label>Plateforme(s)</label>
                                    <div>
                                        <?php $__currentLoopData = $platforms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <input type="checkbox" name="platform[]" value="<?php echo e($platform->id); ?>">
                                            <label for="platform[]" class="platformCheckbox"><?php echo e($platform->platforms_name); ?></label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div> 
                                
                                <div class="option-form-input">
                                    <label for="desc_intro">Intro</label>
                                    <textarea type="text" name="desc_intro"></textarea>
                                </div>
                                
                                <div class="option-form-input">
                                    <label for="desc_body">Desc</label>
                                    <textarea type="text" name="desc_body"></textarea>
                                </div>
                                
                                <div class="option-form-input">
                                    <label for="release_date">Date (sortie)</label>
                                    <input type="date" name="release_date">
                                </div>

                                <div class="option-form-input">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug">
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
                            <form class="option-form" method="post" action="<?php echo e(route('update_game')); ?>" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>


                                <input type="hidden" name="updateGameId" id="updateGameId">
                                
                                <div class="option-form-input">
                                    <label for="poster">Image</label>
                                    <input type="file" name="poster">
                                </div>

                                <div class="option-form-input">
                                    <label for="title">Titre</label>
                                    <input type="text" name="title" id="updateGameTitle">
                                </div>

                                <div class="option-form-input">
                                    <label>Catégorie(s)</label>
                                    <div>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <input type="checkbox" name="category[]" value="<?php echo e($category->id); ?>">
                                            <label for="category[]" class="categoryCheckbox"><?php echo e($category->name); ?></label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div> 

                                <div class="option-form-input">
                                    <label>Plateforme(s)</label>
                                    <div>
                                        <?php $__currentLoopData = $platforms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <input type="checkbox" name="platform[]" value="<?php echo e($platform->id); ?>">
                                            <label for="platform[]" class="platformCheckbox"><?php echo e($platform->platforms_name); ?></label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div> 
                                
                                <div class="option-form-input">
                                    <label for="desc_intro">Intro</label>
                                    <textarea type="text" name="desc_intro" id="updateGameIntro"></textarea>
                                </div>
                                
                                <div class="option-form-input">
                                    <label for="desc_body">Desc</label>
                                    <textarea type="text" name="desc_body" id="updateGameDesc"></textarea>
                                </div>
                                
                                <div class="option-form-input">
                                    <label for="release_date">Date (sortie)</label>
                                    <input type="date" name="release_date" id="updateGameDate">
                                </div>

                                <div class="option-form-input">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="updateGameSlug">
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

            <!-- Modal reading -->
            <div class="modal fade" id="readingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="readingModalTitle"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p id="readingGameIntroDesc">

                            </p>
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
                            <form class="option-game-form" method="get" action="<?php echo e(route('delete_game')); ?>" enctype="multipart/form-data">
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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script>
    $('document').ready(function(){
        
        $('.update-modal').click(function () {
            var gameId = $(this).attr('data-id');
            var gameTitle = $(this).attr('data-title');
            var gameIntro = $(this).attr('data-intro');
            var gameDesc = $(this).attr('data-desc');
            var gameDate = $(this).attr('data-date');
            var gameSlug = $(this).attr('data-slug');
            
            document.getElementById('updateGameId').value = gameId;
            document.getElementById('updateGameTitle').value = gameTitle;
            document.getElementById('updateGameIntro').value = gameIntro;
            document.getElementById('updateGameDesc').value = gameDesc;
            document.getElementById('updateGameDate').value = gameDate;
            document.getElementById('updateGameSlug').value = gameSlug;
        })
        
        $('.reading-modal').click(function () {
            
            var gameIntro = $(this).attr('data-intro');
            var gameDesc = $(this).attr('data-desc');
            
            if(gameIntro){
                document.getElementById('readingGameIntroDesc').innerHTML = gameIntro;
                document.getElementById('readingModalTitle').innerHTML = "Introduction";
            } else {
                document.getElementById('readingGameIntroDesc').innerHTML = gameDesc;
                document.getElementById('readingModalTitle').innerHTML = "Description";
            }
            
        })
        
        $('.delete-modal').click(function () {
            
            var gameId = $(this).attr('data-id');
            
            document.getElementById('deleteGameId').value = gameId;
            
        })
        
        $('#adminGameDataTable').DataTable({
            "lengthMenu": [10, 25, 50, 100],
            "language": {
                "lengthMenu": "Affiche _MENU_ résultat(s)",
                "search": "Recherche :",
                "infoFiltered": "(Filtré sur _MAX_ résultat(s))",
                "info": "Résultat(s) _START_ à _END_ sur _TOTAL_",
                "infoEmpty": "Affiche 0 to 0 of 0 résultat(s)",
                "zeroRecords": "Aucun résultat",
                "paginate": {
                    "first":      "Premier",
                    "last":       "Dernier",
                    "next":       "Suivant",
                    "previous":   "Précédent"
                },
            }
        })

    })
</script>
<?php echo $__env->make('partials._admin_main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\bricedev\gamebox\resources\views/admin/admin_games.blade.php ENDPATH**/ ?>