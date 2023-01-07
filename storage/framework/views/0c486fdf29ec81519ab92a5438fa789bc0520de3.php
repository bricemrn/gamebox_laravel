

<?php $__env->startSection('pageTitle', 'Gestion plateformes'); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('admin.admin_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="admin-view">

        <p>Liste des plateformes</p>

        <div class="option-btn">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary option-btn" data-toggle="modal" data-target="#addModal">Ajouter une plateforme</button>

        </div>

        <?php if(session()->has('message')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('message')); ?>

            </div>
        <?php endif; ?>

        <?php if(session()->has('message')): ?>
            <div class="alert alert-danger">
                <?php echo e(session()->get('message')); ?>

            </div>
        <?php endif; ?>

        <table class="table table-striped" id="adminUserDataTable">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Logo</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $platforms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th><?php echo e($platform->platforms_name); ?></th>
                    <th><?php echo e($platform->logo); ?></th>
                    <th><?php echo e($platform->slug); ?></th>
                    <th>
                        <a href="" class="update-modal" data-toggle="modal" data-target="#updateModal" data-id="<?php echo e($platform->id); ?>" data-name="<?php echo e($platform->platforms_name); ?>" data-logo="<?php echo e($platform->logo); ?>"  data-slug="<?php echo e($platform->slug); ?>">
                            <i class="fas fa-edit fa-edit-admin"></i>
                        </a>
                        <a href="" class="delete-modal" data-toggle="modal"  data-target="#deleteModal" data-id="<?php echo e($platform->id); ?>">
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Ajouter une plateforme</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>

                        <form class="option-game-form" method="post" action="<?php echo e(route('add_platform')); ?>" enctype="multipart/form-data">

                            <?php echo e(csrf_field()); ?>


                            <div class="option-form-input">
                                <label for="name">Nom</label>
                                <input type="text" name="name" id="name">
                                <small class="admin-validate-small" id="smallName"></small>
                            </div>                            
                            
                            <div class="option-form-input">
                                <label for="logo">Logo</label>
                                <input type="text" name="logo" id="logo">
                                <small class="admin-validate-small" id="smallLogo"></small>
                            </div>

                            <div class="option-form-input">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug">
                                <small class="admin-validate-small" id="smallSlug"></small>
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Modifier une plateforme</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    <form class="option-form" method="post" action="<?php echo e(route('update_platform')); ?>" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>


                        <input type="hidden" name="id" id="updatePlatformId">

                        <div class="option-form-input">
                            <label for="name">Nom</label>
                            <input type="text" name="name" id="updatePlatformName">
                        </div>

                        <div class="option-form-input">
                            <label for="logo">Logo</label>
                            <input type="text" name="logo" id="updatePlatformLogo">
                        </div>

                        <div class="option-form-input">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" id="updatePlatformSlug">
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Supprimer une plateforme</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="" method="get" action="<?php echo e(route('delete_platform')); ?>" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>


                            <input type="hidden" name="id" id="deletePlatformId">

                            <p>Êtes-vous sûr de vouloir supprimer cette plateforme ?</p>

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
            
            var platformId = $(this).attr('data-id');
            var platformName = $(this).attr('data-name');
            var platformLogo = $(this).attr('data-logo');
            var platformSlug = $(this).attr('data-slug');
            
            document.getElementById('updatePlatformId').value = platformId;
            document.getElementById('updatePlatformName').value = platformName;
            document.getElementById('updatePlatformLogo').value = platformLogo;
            document.getElementById('updatePlatformSlug').value = platformSlug;
            
        })

        $('.delete-modal').click(function () {
            
            var platformId = $(this).attr('data-id');
            
            document.getElementById('deletePlatformId').value = platformId;
            
        })

        $('#adminUserDataTable').DataTable({
            "lengthMenu": [10, 15, 25, 50, 100],
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

        // VALIDATE ADD PLATFORM
        var form = document.querySelector(".option-game-form");
        var name = document.querySelector("#name");
        var logo = document.querySelector("#logo");
        var slug = document.querySelector("#slug");
        var smallName = $("#smallName");
        var smallLogo = $("#smallLogo");
        var smallSlug = $("#smallSlug");
        var messageName = "Attention ! Vous n'avez pas renseigné le nom de la catégorie";
        var messageLogo = "Attention ! Vous n'avez pas renseigné le logo";
        var messageSlug = "Attention ! Vous n'avez pas renseigné le slug";

        smallName.hide();
        smallSlug.hide();

        form.addEventListener("submit", (e) => {

            if(name.value === ""){
                e.preventDefault();
                smallName.show();
                smallName.html(messageName);
                name.className = "error-input";
            } else {
                smallName.hide();
                name.className = "";
            }

            if(logo.value === ""){
                e.preventDefault();
                smallLogo.show();
                smallLogo.html(messageLogo);
                logo.className = "error-input";
            } else {
                smallLogo.hide();
                logo.className = "";
            }
            
            if (slug.value === ""){
                e.preventDefault();
                smallSlug.show();
                smallSlug.html(messageSlug);
                slug.className = "error-input";
            } else {
                smallSlug.hide();
                slug.className = "";
            }
        })

    })
</script>
<?php echo $__env->make('partials._admin_main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/94e6ac6d287e346ebaeea29a3b71eb72/sites/gamebox.wewantdev.fr/gamebox/resources/views/admin/admin_platforms.blade.php ENDPATH**/ ?>