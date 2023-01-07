

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('admin.admin_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="admin-view">

        <p>Gestion des news highlights</p>

        <form action="<?php echo e(route('add_news_highlights')); ?>" method="post" enctype="multipart/form-data">

            <?php echo e(csrf_field()); ?>


            <div class="option-btn">

                <button type="submit" class="btn btn-secondary option-btn">Mise à jour</button>

            </div>

            <table class="table table-striped" id="adminNewsDataTable">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Jeu</th>
                        <th>Catégorie</th>
                        <th>Titre</th>
                        <th>Intro highlight</th>
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
                            <?php echo e(\Illuminate\Support\Str::limit($new->desc_intro_highlight, $limit = 20, $end = ' ...')); ?>

                        </th>
                        <th>
                            <select name="highlighted[<?php echo e($new->id); ?>]">
                                <?php if($new->highlighted == 0): ?>
                                    <option value="0">No highlighted</option>
                                    <option value="1">Highlighted</option>
                                <?php elseif($new->highlighted == 1): ?>
                                    <option value="1">Highlighted</option>
                                    <option value="0">No highlighted</option>
                                <?php else: ?>
                                <?php endif; ?>
                            </select>
                        </th>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </form>

    </div>

<?php $__env->stopSection(); ?>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>

    $('document').ready(function(){

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
<?php echo $__env->make('partials._admin_main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\bricedev\gamebox\resources\views/admin/admin_news_highlights.blade.php ENDPATH**/ ?>