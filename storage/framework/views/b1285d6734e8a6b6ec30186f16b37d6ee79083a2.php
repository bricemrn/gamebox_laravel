

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('admin.admin_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="admin-view">

        <p>Liste des news</p>

        <div class="option-btn">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary option-btn" data-toggle="modal" data-target="#addModal">Créer un article</button>

        </div>

        <table class="table table-striped" id="adminNewsDataTable">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Jeu</th>
                    <th>Catégorie</th>
                    <th>Titre</th>
                    <th>Intro highlight</th>
                    <th>Intro</th>
                    <th>Desc</th>
                    <th>Auteur</th>
                    <th>Slug</th>
                    <th>Date (création)</th>
                    <th>Date (modification)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th>
                        <img class="card-game-admin" src="<?php echo e(url('')); ?>/<?php echo e($new->image); ?>" alt="...">
                    </th>
                    <?php $__currentLoopData = $new->games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th>
                            <?php echo e($game->games_title); ?>

                        </th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $new->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th>
                            <?php echo e($category->name); ?>

                        </th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <th>
                        <?php echo e($new->news_title); ?>

                    </th>
                    <th>
                        <?php echo e(\Illuminate\Support\Str::limit($new->desc_intro, $limit = 20, $end = ' ...')); ?>

                    </th>
                    <th>
                        <a href="" class="reading-modal" data-toggle="modal" data-target="#readingModal" data-intro="<?php echo e($new->desc_intro); ?>">
                            <i class="far fa-eye fa-eye-admin"></i>
                        </a>
                    </th>
                    <th>
                        <a href="" class="reading-modal" data-toggle="modal" data-target="#readingModal" data-desc="<?php echo e($new->desc_body); ?>">
                            <i class="far fa-eye fa-eye-admin"></i>
                        </a>
                    </th>
                    <th>
                        <?php echo e($new->author); ?>

                    </th>
                    <th>
                        <?php echo e($new->slug); ?>

                    </th>
                    <th>
                        <?php echo e($new->created_at); ?>

                    </th>
                    <th>
                        <?php echo e($new->updated_at); ?>

                    </th>
                    <th>
                    <a href="" class="update-modal" data-toggle="modal" data-target="#updateModal" data-id="<?php echo e($new->id); ?>" data-title="<?php echo e($new->news_title); ?>" data-game="<?php echo e($game->id); ?>" data-category="<?php echo e($category->id); ?>" data-image="<?php echo e($new->image); ?>" data-intro-highlight="<?php echo e($new->desc_intro_highlight); ?>" data-intro="<?php echo e($new->desc_intro); ?>" data-desc="<?php echo e($new->desc_body); ?>" data-slug="<?php echo e($new->slug); ?>">
                            <i class="fas fa-edit fa-edit-admin"></i>
                        </a>
                        <a href="" class="delete-modal" data-toggle="modal"  data-target="#deleteModal" data-id="<?php echo e($new->id); ?>">
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Créer un article</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="option-game-form" method="post" action="<?php echo e(route('add_news')); ?>" enctype="multipart/form-data">

                            <?php echo e(csrf_field()); ?>

                            
                            <div class="option-form-input">
                                <label for="image">Image</label>
                                <input type="file" name="image">
                            </div>

                            <div class="option-form-input">
                                <label for="game">Jeu</label>
                                <select name="game">
                                    <option selected disabled>-</option>
                                    <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($game->id); ?>"><?php echo e($game->games_title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            
                            <div class="option-form-input">
                                <label for="category">Catégorie</label>
                                <select name="category">
                                    <option selected disabled>-</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            
                            <div class="option-form-input">
                                <label for="title">Titre</label>
                                <input type="text" name="title">
                            </div>

                            <div class="option-form-input">
                                <label for="desc_intro_highlight">Intro highlight</label>
                                <input type="text" name="desc_intro_highlight">
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
                                <label for="author">Auteur</label>
                                <input type="text" name="author" value="<?php echo e(Auth::user()->name); ?>" readonly="readonly">
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Modifier un article</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="option-form" method="post" action="<?php echo e(route('update_news')); ?>" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>


                            <input type="hidden" name="updateId" id="updateId">
                            
                            <div class="option-form-input">
                                <label for="image">Image</label>
                                <input type="file" name="image">
                            </div>

                            <div class="option-form-input">
                                <label for="title">Titre</label>
                                <input type="text" name="title" id="updateTitle">
                            </div>

                            <div class="option-form-input">
                                <label for="game">Jeu</label>
                                <select name="game" id="updateGame">
                                    <option selected disabled>-</option>
                                    <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($game->id); ?>"><?php echo e($game->games_title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="option-form-input">
                                <label for="category">Catégorie</label>
                                <select name="category" id="updateCategory">
                                    <option selected disabled>-</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>    

                            <div class="option-form-input">
                                <label for="desc_intro_highlight">Intro highlight</label>
                                <textarea type="text" name="desc_intro_highlight" id="updateIntroHighlight"></textarea>
                            </div>

                            <div class="option-form-input">
                                <label for="desc_intro">Intro</label>
                                <textarea type="text" name="desc_intro" id="updateIntro"></textarea>
                            </div>
                            
                            <div class="option-form-input">
                                <label for="desc_body">Desc</label>
                                <textarea type="text" name="desc_body" id="updateDesc"></textarea>
                            </div>

                            <div class="option-form-input">
                                <label for="author">Auteur</label>
                                <input type="text" name="author" value="<?php echo e(Auth::user()->name); ?>" readonly="readonly">
                            </div>

                            <div class="option-form-input">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="updateSlug">
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
                        <p id="readingNewsIntroDesc">

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
                        <h5 class="modal-title" id="exampleModalLongTitle">Supprimer cet article ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="option-game-form" method="get" action="<?php echo e(route('delete_news')); ?>" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>


                            <input type="hidden" name="deleteId" id="deleteId">

                            <p>Êtes-vous de vouloir supprimer cet article ?</p>

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

<?php $__env->stopSection(); ?>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    $('document').ready(function(){
        
        $('.update-modal').click(function () {
            
            var id = $(this).attr('data-id');
            var game = $(this).attr('data-game');
            var category = $(this).attr('data-category');
            var title = $(this).attr('data-title');
            var introHighlight = $(this).attr('data-intro-highlight');
            var intro = $(this).attr('data-intro');
            var desc = $(this).attr('data-desc');
            var slug = $(this).attr('data-slug');
            
            document.getElementById('updateId').value = id;
            document.getElementById('updateGame').value = game;
            document.getElementById('updateCategory').value = category;
            document.getElementById('updateTitle').value = title;
            document.getElementById('updateIntroHighlight').value = introHighlight;
            document.getElementById('updateIntro').value = intro;
            document.getElementById('updateDesc').value = desc;
            document.getElementById('updateSlug').value = slug;
            
        })
        
        $('.reading-modal').click(function () {
            
            var gameIntro = $(this).attr('data-intro');
            var gameDesc = $(this).attr('data-desc');
            
            if(gameIntro){
                document.getElementById('readingNewsIntroDesc').innerHTML = gameIntro;
                document.getElementById('readingModalTitle').innerHTML = "Introduction";
            } else {
                document.getElementById('readingNewsIntroDesc').innerHTML = gameDesc;
                document.getElementById('readingModalTitle').innerHTML = "Description";
            }
            
        })
        
        $('.delete-modal').click(function () {
            
            var id = $(this).attr('data-id');
            
            document.getElementById('deleteId').value = id;
            
        })
        
        $('#adminNewsDataTable').DataTable({
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
<?php echo $__env->make('partials._admin_main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\bricedev\gamebox\resources\views/admin/admin_news.blade.php ENDPATH**/ ?>