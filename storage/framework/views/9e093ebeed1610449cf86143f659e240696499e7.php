

<?php $__env->startSection('pageTitle', 'Mon profil'); ?>

<?php $__env->startSection('content'); ?>

    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>

    <div class="profile">

        <div class="profile-banner">

            <img src="<?php echo e(url('')); ?>/public/assets/images/backgrounds/grey-cube.jpg" alt="">

            <div class="profile-avatar">
                <img src="<?php echo e(url('')); ?>/public/<?php echo e($user->avatar); ?>" alt="" id="avatarImg">
                <a href="" class="update-avatar-modal" data-toggle="modal" data-target="#updateModal" data-avatar="<?php echo e($user->avatar); ?>">
                    <i class="fas fa-edit fa-edit-avatar"></i>
                </a>
            </div>


        </div>

        <div class="profile-body">

                <div class="profile-intro">
                    <span>Bonjour, <?php echo e($user->name); ?></span>
                    <ul>
                        <li>
                            <a href="<?php echo e(route('logout')); ?>"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-sign-out-alt-profile"></i>
                                <?php echo e(__('Déconnexion')); ?>

                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                </div>

                <div id="accordion" class="profile-content">

                    <?php if(session()->has('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('success')); ?>

                        </div>
                    <?php endif; ?>
                    <?php if(session()->has('error')): ?>
                        <div class="alert alert-danger">
                            <?php echo e(session()->get('error')); ?>

                        </div>
                    <?php endif; ?>

                    <div class="card mb-3" style="border:none">
                        <div class="card-header" id="headingOne" style="background-color:#d4d4d4; border-bottom:none">
                            <h5 class="mb-0 text-center" style="opacity:.7">
                                <button class="btn text-uppercase font-weight-bold" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="box-shadow: none">
                                    Informations personnelles
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">

                                <div class="name">

                                    <div class="content-title">
                                        <h5>Nom</h5>
                                        <i class="fas fa-edit fa-edit-name" id="nameEditBtn"></i>
                                    </div>

                                    <div id="nameField">

                                        <p id="nameFieldContent"><?php echo e(Auth::user()->name); ?></p>

                                    </div>
                                    
                                    <div id="nameEditForm">
                                        <form action="" id="nameForm" enctype="multipart/form-data">
                                        <?php echo e(csrf_field()); ?>


                                            <input type="text" name="name" id="name" value="<?php echo e($user->name); ?>">
                                            
                                            <button type="submit" class="btn btn-secondary">Valider</button>
                                            
                                        </form>
                                    </div>

                                </div>

                                <div class="email">

                                    <div class="content-title">
                                        <h5>E-mail</h5>
                                        <i class="fas fa-edit fa-edit-email" id="emailEditBtn"></i>
                                    </div>

                                    <div id="emailField">

                                        <p id="emailFieldContent"><?php echo e(Auth::user()->email); ?></p>

                                    </div>
                                    
                                    <div id="emailEditForm">
                                        <form action="" id="emailForm" enctype="multipart/form-data">
                                        <?php echo e(csrf_field()); ?>


                                            <input type="text" name="email" id="email" value="<?php echo e($user->email); ?>">
                                            
                                            <button type="submit" class="btn btn-secondary">Valider</button>
                                            
                                        </form>
                                    </div>

                                </div>

                                <div class="my_desc">

                                    <div class="content-title">
                                        <h5>Bio</h5>
                                        <i class="fas fa-edit fa-edit-bio" id="bioEditBtn"></i>
                                    </div>

                                    <div id="bioField">

                                        <p id="bioFieldContent"><?php echo e($user->my_desc); ?></p>
                                    
                                    </div>

                                    <div id="bioEditForm">

                                        <form action="" id="bioForm" enctype="multipart/form-data">
                                        <?php echo e(csrf_field()); ?>


                                            <textarea id="bio" name="bio"><?php echo e($user->my_desc); ?></textarea>

                                            <button type="submit" class="btn btn-secondary">Valider</button>

                                        </form>

                                    </div>
                                
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card mb-3" style="border:none">
                        <div class="card-header" id="headingTwo" style="background-color:#d4d4d4; border-bottom:none">
                            <h5 class="mb-0 text-center" style="opacity:.7">
                                <button class="btn collapsed text-uppercase font-weight-bold" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="box-shadow: none">
                                    Jeux favoris (<?php echo e(count($user->games)); ?>)
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <div class="fav-mini-container">
                                    <?php $__currentLoopData = $user->games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        
                                            <div class="fav-mini">

                                                <a href="<?php echo e(route('gamesdetails', [$game->slug])); ?>">
                                                    <img src="<?php echo e(url('')); ?>/public/<?php echo e($game->poster); ?>" alt="">
                                                </a>

                                                <a href="" class="delete-modal fav-delete" data-toggle="modal"  data-target="#deleteFavoriteGame" data-id="<?php echo e($game->id); ?>" data-title="<?php echo e($game->games_title); ?>">
                                                    <i class="fas fa-minus-circle fa-minus-fav"></i>
                                                </a>
                                                
                                            </div>
                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3" style="border:none">
                        <div class="card-header" id="headingThree" style="background-color:#d4d4d4; border-bottom:none">
                            <h5 class="mb-0 text-center" style="opacity:.7">
                                <button class="btn collapsed text-uppercase font-weight-bold" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="box-shadow: none">
                                    Mes amis
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                
                            </div>
                        </div>
                    </div>
                </div>

        </div>

        <!-- Modal avatar update -->
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modifier mon avatar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form id="formAvatarUpdate" class="option-form" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>


                            <div>
                                <label for="avatarFile"><i class="fas fa-cloud-upload-alt"></i></label>
                                <span id="file-chosen">sélectionner un fichier (.jpeg, .jpg, .png, .webp)</span>
                                <input type="file" name="avatarFile" class="add-field" id="avatarFile" hidden>
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

        <!-- Modal delete favorite -->
        <div class="modal fade" id="deleteFavoriteGame" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteFavoriteGameTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class="" method="get" action="<?php echo e(route('delete_favorite_game')); ?>" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>


                            <input type="hidden" name="id" id="deleteFavoriteGameId">

                            <p>Êtes-vous sûr de vouloir supprimer ce jeu de vos favoris ?</p>

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

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>

    $('document').ready(function(){

        /** AVATAR UPDATE **/
        $('#formAvatarUpdate').submit(function(e){

            e.preventDefault();

            var avatar = $('#avatarFile').val();

            if(avatar == ''){

                $(alert('Veuillez choisir un avatar'))

            } else {

                $('#updateModal').modal('hide')
                $("#overlay").fadeIn(300);

                $.ajax({

                    url:'/profil/avatar',
                    method:'post',
                    data:{avatar:avatar},
                    dataType:'json',
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    cache:false,
                                        
                    success:function(response){

                        $('#avatarImg').attr('src', '<?php echo e(url('')); ?>/public/'+response.data)

                    }

                }).done(function() {
                    setTimeout(function(){
                        $("#overlay").fadeOut(300);
                    },500);
                });
            }
        })

        /** NAME UPDATE **/
        $('#nameEditForm').hide();

        $('#nameEditBtn').click(function(){

            $('#nameField').toggle();
            $('#nameEditForm').toggle();

        })

        $('#nameForm').submit(function(e){

            e.preventDefault();

            var email = $('#name').val();

            $("#overlay").fadeIn(300);

            $.ajax({
                url:'/profil/nom',
                method:'post',
                data:{name:name},
                dataType:'json',
                data:new FormData(this),
                contentType:false,
                processData:false,
                cache:false,
                
                success:function(response){
                    
                    $('#nameFieldContent').text(response.data)
                    $('#nameField').fadeIn(300);
                    $('#nameEditForm').hide();

                }

            }).done(function() {
                    setTimeout(function(){
                        $("#overlay").fadeOut(300);
                    },500);
                });

        })

        /** EMAIL UPDATE **/
        $('#emailEditForm').hide();

        $('#emailEditBtn').click(function(){

            $('#emailField').toggle();
            $('#emailEditForm').toggle();

        })

        $('#emailForm').submit(function(e){

            e.preventDefault();

            var email = $('#email').val();

            $("#overlay").fadeIn(300);

            $.ajax({
                url:'/profil/email',
                method:'post',
                data:{email:email},
                dataType:'json',
                data:new FormData(this),
                contentType:false,
                processData:false,
                cache:false,
                
                success:function(response){
                    
                    $('#emailFieldContent').text(response.data)
                    $('#emailField').fadeIn(300);
                    $('#emailEditForm').hide();

                }

            }).done(function() {
                    setTimeout(function(){
                        $("#overlay").fadeOut(300);
                    },500);
                });

        })

        /** BIO UPDATE **/
        $('#bioEditForm').hide();

        $('#bioEditBtn').click(function(){

            $('#bioField').toggle();
            $('#bioEditForm').toggle();

        })

        $('#bioForm').submit(function(e){

            e.preventDefault();

            var bio = $('#bio').val();

            $("#overlay").fadeIn(300);

            $.ajax({
                url:'/profil/bio',
                method:'post',
                data:{bio:bio},
                dataType:'json',
                data:new FormData(this),
                contentType:false,
                processData:false,
                cache:false,
                
                success:function(response){
                    
                    $('#bioFieldContent').html(response.data)
                    $('#bioField').fadeIn(300);
                    $('#bioEditForm').hide();
                    
                }

            }).done(function() {
                    setTimeout(function(){
                        $("#overlay").fadeOut(300);
                    },500);
                });

        })

        // CHOOSE FILE CUSTOM BUTTON
        const avatarFile = document.getElementById('avatarFile');
        const fileChosen = document.getElementById('file-chosen');

        avatarFile.addEventListener('change', function(){
            fileChosen.textContent = this.files[0].name
        })

        // DELETE FAVORITE GAME
        $('.delete-modal').click(function () {
            
            var favoriteGameId = $(this).attr('data-id');
            var favoriteGameTitle = $(this).attr('data-title');

            $('#deleteFavoriteGameId').val(favoriteGameId);
            $('#deleteFavoriteGameTitle').html(favoriteGameTitle);
            
        })

    })

</script>
<?php echo $__env->make('partials._main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/94e6ac6d287e346ebaeea29a3b71eb72/sites/gamebox.wewantdev.fr/gamebox/resources/views/user/profile.blade.php ENDPATH**/ ?>