

<?php $__env->startSection('pageTitle', 'Gestion tableau de bord'); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('admin.admin_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="admin-view">

        <p>Tableau de bord</p>

        <div class="option-btn">

        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials._admin_main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/94e6ac6d287e346ebaeea29a3b71eb72/sites/gamebox.wewantdev.fr/gamebox/resources/views/admin/admin_dashboard.blade.php ENDPATH**/ ?>