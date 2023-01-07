@extends('partials._main')

@section('pageTitle', 'Jeux')

@section('content')

    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>

    <div class="page-banner">
        <p>Jeux</p>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success fav-alert">
            {{ session()->get('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger fav-alert">
            {{ session()->get('error') }}
        </div>
    @endif

    <div class="page-title">
        <h2><span>Parcourir</span></h2>
    </div>

    <div class="games">

        <div class="games-sidebar-media">
    
            <h4>Filtres</h4>
            
            <hr>

            <div class="search-sidebar">

                <form action="" method="" id="searchFormMedia" enctype="multipart/form-data" >
                {{ csrf_field() }}

                    <i class="fas fa-search"></i>

                    <input type="text" name="search" id="search" placeholder="Titre, mot clé...">
    
                    <button type="submit" class="btn btn-warning">Rechercher</button>

                </form>

            </div>
    
        </div>

        <div class="games-content">
            @include('gamesresults')
        </div>

        <div class="games-sidebar">
    
            <h4>Filtres</h4>
            
            <hr>

            <div class="search-sidebar">

                <form action="" method="" id="searchForm" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <i class="fas fa-search"></i>
                    
                    <input type="text" name="search" id="search" placeholder="Titre, mot clé...">
    
                    <button type="submit" class="btn btn-warning">Rechercher</button>

                </form>

            </div>

        </div>

    </div>

@endsection

@push('script')
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
                    data:{_token: '{{ csrf_token() }}'},

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

            // ADD FAVORITE GAME
            $(document).on('click', '.game-fav', function() {

                var gameId = $(this).attr('data-id');
                var gameTitle = $(this).attr('data-title');
                console.log(gameId)
                
                $('#addFavoriteGameId').val(gameId);
                $('#addFavoriteGameTitle').html(gameTitle);
                
            })
            
        })
    </script>
@endpush
