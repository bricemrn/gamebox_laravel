

<?php $__env->startSection('pageTitle', 'Gestion tableau de bord'); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('admin.admin_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="admin-view">

        <p>Tableau de bord</p>

        <div class="option-btn">

        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials._admin_main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\bricedev\gamebox_prod\resources\views/admin/admin_dashboard.blade.php ENDPATH**/ ?>