

<?php $__env->startSection('pageTitle', 'Gestion utilisateurs'); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('admin.admin_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="admin-view">

        <p>Liste des utilisateurs</p>

        <div class="option-btn">

        </div>

        <table class="table table-striped" id="adminUserDataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>E-mail</th>
                    
                    <th>Date (inscription)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th><?php echo e($user->id); ?></th>
                    <th><?php echo e($user->name); ?></th>
                    <th><?php echo e($user->email); ?></th>
                    
                    <th><?php echo e($user->created_at); ?></th>
                    <th>
                        <a href="" class="update-modal" data-toggle="modal" data-target="#updateModal" data-id="<?php echo e($user->id); ?>" data-name="<?php echo e($user->name); ?>" data-email="<?php echo e($user->email); ?>" data-password="<?php echo e($user->password); ?>" data-date="<?php echo e($user->created_at); ?>">
                            <i class="fas fa-edit fa-edit-admin"></i>
                        </a>
                        <a href="" class="update-password-modal" data-toggle="modal" data-target="#updateUserPasswordModal" data-id="<?php echo e($user->id); ?>" data-password="<?php echo e($user->password); ?>">
                            <i class="fas fa-key fa-key-admin"></i>
                        </a>
                        <a href="" class="delete-modal" data-toggle="modal"  data-target="#deleteModal" data-id="<?php echo e($user->id); ?>">
                            <i class="fas fa-trash fa-trash-admin"></i>
                        </a>
                    </th>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <!-- Modal update -->
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modifier un utilisateur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form class="option-form" method="post" action="<?php echo e(route('update_user')); ?>" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>


                        <input type="hidden" name="updateUserId" id="updateUserId">

                        <div class="option-form-input">
                            <label for="name">Nom</label>
                            <input type="text" name="name" id="updateUserName">
                        </div>

                        <div class="option-form-input">
                            <label for="email">E-mail</label>
                            <input type="text" name="email" id="updateUserEmail">
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

        <!-- Modal update password -->
        <div class="modal fade" id="updateUserPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modifier un mot de passe</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="" method="post" action="<?php echo e(route('update_password_user')); ?>" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>


                            <input type="hidden" name="updateUserPasswordId" id="updateUserPasswordId">

                            <div class="option-form-input">
                                <label for="newpassword">Nouveau mot de passe</label>
                                <input type="text" name="newpassword">
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Supprimer un utilisateur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="" method="get" action="<?php echo e(route('delete_user')); ?>" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>


                            <input type="hidden" name="deleteUserId" id="deleteUserId">

                            <p>Êtes-vous sûr de vouloir supprimer cet utilisateur ?</p>

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

<?php $__env->startPush('script'); ?>
    <script>
        $('document').ready(function(){

            $('.update-modal').click(function () {
                
                var userId = $(this).attr('data-id');
                var userName = $(this).attr('data-name');
                var userEmail = $(this).attr('data-email');
                var userPassword = $(this).attr('data-password');
                
                document.getElementById('updateUserId').value = userId;
                document.getElementById('updateUserName').value = userName;
                document.getElementById('updateUserEmail').value = userEmail;
                document.getElementById('updateUserPassword').value = userPassword;
                
            })

            $('.update-password-modal').click(function () {

                var userId = $(this).attr('data-id');

                document.getElementById('updateUserPasswordId').value = userId;

            })

            $('.delete-modal').click(function () {
                
                var userId = $(this).attr('data-id');
                
                document.getElementById('deleteUserId').value = userId;
                
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('partials._admin_main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/94e6ac6d287e346ebaeea29a3b71eb72/sites/gamebox.wewantdev.fr/gamebox/resources/views/admin/admin_users.blade.php ENDPATH**/ ?>