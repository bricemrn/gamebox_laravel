        <?php echo $__env->make('partials._head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <main>
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        
        <?php echo $__env->make('partials._scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->yieldPushContent('script'); ?>
        
    </body>
</html><?php /**PATH /home/clients/94e6ac6d287e346ebaeea29a3b71eb72/sites/gamebox.wewantdev.fr/gamebox/resources/views/partials/_admin_main.blade.php ENDPATH**/ ?>