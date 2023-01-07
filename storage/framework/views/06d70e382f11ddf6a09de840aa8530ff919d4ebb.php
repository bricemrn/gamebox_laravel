

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('admin.admin_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="admin-view">

        <p>Liste des catégories</p>

        <div class="option-btn">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary option-btn" data-toggle="modal" data-target="#addModal">Ajouter une catégorie</button>

        </div>

        <table class="table table-striped" id="adminUserDataTable">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th><?php echo e($categorie->name); ?></th>
                    <th><?php echo e($categorie->slug); ?></th>
                    <th>
                        <a href="" class="update-modal" data-toggle="modal" data-target="#updateModal" data-id="<?php echo e($categorie->id); ?>" data-name="<?php echo e($categorie->name); ?>" data-slug="<?php echo e($categorie->slug); ?>">
                            <i class="fas fa-edit fa-edit-admin"></i>
                        </a>
                        <a href="" class="delete-modal" data-toggle="modal"  data-target="#deleteModal" data-id="<?php echo e($categorie->id); ?>">
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Ajouter une catégorie</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="option-game-form" method="post" action="<?php echo e(route('add_category')); ?>" enctype="multipart/form-data">

                            <?php echo e(csrf_field()); ?>


                            <div class="option-form-input">
                                <label for="name">Nom</label>
                                <input type="text" name="name">
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Modifier une catégorie</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form class="option-form" method="post" action="<?php echo e(route('update_category')); ?>" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>


                        <input type="hidden" name="id" id="updateCategoryId">

                        <div class="option-form-input">
                            <label for="name">Nom</label>
                            <input type="text" name="name" id="updateCategoryName">
                        </div>

                        <div class="option-form-input">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" id="updateCategorySlug">
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Supprimer une catégorie</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="" method="get" action="<?php echo e(route('delete_category')); ?>" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>


                            <input type="hidden" name="id" id="deleteCategoryId">

                            <p>Êtes-vous de vouloir supprimer cette catégorie ?</p>

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

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script>
    $('document').ready(function(){

        $('.update-modal').click(function () {
            
            var categoryId = $(this).attr('data-id');
            var categoryName = $(this).attr('data-name');
            var categorySlug = $(this).attr('data-slug');
            
            document.getElementById('updateCategoryId').value = categoryId;
            document.getElementById('updateCategoryName').value = categoryName;
            document.getElementById('updateCategorySlug').value = categorySlug;
            
        })

        $('.delete-modal').click(function () {
            
            var categoryId = $(this).attr('data-id');
            
            document.getElementById('deleteCategoryId').value = categoryId;
            
        })

        $('#adminUserDataTable').DataTable({
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
<?php echo $__env->make('partials._admin_main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\bricedev\gamebox\resources\views/admin/admin_categories.blade.php ENDPATH**/ ?>