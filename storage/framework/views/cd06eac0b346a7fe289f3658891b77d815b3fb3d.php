

<?php $__env->startSection('pageTitle', 'Jeux'); ?>

<?php $__env->startSection('content'); ?>

    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>

    <div class="page-banner">
        <p>Jeux</p>
    </div>

    <?php if(session()->has('success')): ?>
        <div class="alert alert-success fav-alert">
            <?php echo e(session()->get('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session()->has('error')): ?>
        <div class="alert alert-danger fav-alert">
            <?php echo e(session()->get('error')); ?>

        </div>
    <?php endif; ?>

    <div class="page-title">
        <h2><span>Parcourir</span></h2>
    </div>

    <div class="games">

        <div class="games-sidebar-media">
    
            <h4>Filtres</h4>
            
            <hr>

            <div class="search-sidebar">

                <form action="" method="" id="searchFormMedia" enctype="multipart/form-data" >
                <?php echo e(csrf_field()); ?>


                    <i class="fas fa-search"></i>

                    <input type="text" name="search" id="search" placeholder="Titre, mot clé...">
    
                    <button type="submit" class="btn btn-warning">Rechercher</button>

                </form>

            </div>
    
        </div>

        <div class="games-content">
            <?php echo $__env->make('gamesresults', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div class="games-sidebar">
    
            <h4>Filtres</h4>
            
            <hr>

            <div class="search-sidebar">

                <form action="" method="" id="searchForm" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>


                    <i class="fas fa-search"></i>
                    
                    <input type="text" name="search" id="search" placeholder="Titre, mot clé...">
    
                    <button type="submit" class="btn btn-warning">Rechercher</button>

                </form>

            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>

        $(document).ready(function(){

            // PAGINATION GAMES
            $(document).on('click', '.pagination a', function(e){
                
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];

                fetch_data(page);
            })

            function fetch_data(page){

                $("#overlay").fadeIn(300);

                $.ajax({
                    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '/jeux/pagination?page='+page,
                    type:'post',
                    data:{_token: '<?php echo e(csrf_token()); ?>'},

                    success: function(data){
                        $('.games-content').html(data);   
                    }
                }).done(function() {
                    setTimeout(function(){
                        $("#overlay").fadeOut(300);
                    },500);
                });
            }

            // SEARCH GAMES
            $('#searchForm').submit(function(e){
                e.preventDefault();
                var terms = $('#search').val();

                $("#overlay").fadeIn(300);

                $.ajax({
                    url:'/jeux/recherche',
                    type:'post',
                    data:{terms:terms},
                    dataType:'text',
                    data: new FormData(this),
                    contentType:false,
                    processData:false,
                    cache:false,
                    
                    success:function(data){
                        $('.games-content').html(data);                
                    }
                }).done(function() {
                    setTimeout(function(){
                        $("#overlay").fadeOut(300);
                    },500);
                });
            })

            $('#searchFormMedia').submit(function(e){
                e.preventDefault();
                var terms = $('#search').val();

                $("#overlay").fadeIn(300);

                $.ajax({
                    url:'/jeux/recherche',
                    type:'post',
                    data:{terms:terms},
                    dataType:'text',
                    data: new FormData(this),
                    contentType:false,
                    processData:false,
                    cache:false,
                    
                    success:function(data){
                        $('.games-content').html(data);                
                    }
                }).done(function() {
                    setTimeout(function(){
                        $("#overlay").fadeOut(300);
                    },500);
                });
            })
            
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('partials._main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/94e6ac6d287e346ebaeea29a3b71eb72/sites/gamebox.wewantdev.fr/gamebox/resources/views/games.blade.php ENDPATH**/ ?>