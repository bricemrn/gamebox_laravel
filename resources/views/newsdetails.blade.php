@extends('partials._main')

@section('pageTitle', $news->news_title)

@section('content')

    <div class="page-banner">
        <p>{{ $news->news_title }}</p>
    </div>

    <div class="back-to">
        <div class="btn1">
            <a href="{{ route('news') }}">
                <span>Retour à l'actualité</span>
            </a>
        </div>
    </div>
    
    <div class="page-details">

        <div class="page-details-content">

            <p class="page-details-meta">
                Par <strong>{{ $news->author }}</strong>, {{ \Carbon\Carbon::parse($news->created_at)->diffForHumans() }}
            </p>

            <p class="page-details-intro">
                {{ $news->desc_intro }}
            </p>
            
            <img src="{{url('') }}/{{ $news->image}}" alt="">
            
            <p class="page-details-body">
                {{ $news->desc_body }}
            </p>
            
            <div class="comments">

                {{-- @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach    
                    </div>
                @endif --}}
                
                <hr>
                
                <p>{{ count($comments) }} commentaires</p>
                
                @if(Auth::user())
                    <form class="comment-form" action="{{ route('newscomments', [$news->id]) }}" method="post">
                        
                        {{ csrf_field() }}
                        
                        <textarea name="comment" id="comment" class="comment" cols="30" rows="10" placeholder="Écrire un commentaire"></textarea>

                        <small id="smallComment" class="small-error"></small>
                        
                        <button class="btn btn-warning" type="submit">Publier</button>
    
                    </form>
                @else
                    <div class="btn1">
                        <a href="{{ route('login') }}">
                            <span>Connectez-vous pour laisser votre commentaire</span>
                        </a>
                    </div>
                @endif

                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                @foreach($comments as $comment)

                    <div class="comment">

                        <div class="comment-avatar">
                            <img src="{{ url('') }}/{{ $comment->avatar }}" alt="">
                        </div>

                        <div>
                            <div class="comment-author">
                                <span style="margin: 4px 0"><strong>{{ $comment->name }}</strong>,</span>
                                <span style="font-size: .8em">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span>
                                @if($comment->users_id == Auth::user()->id)
                                    <button class="comment-delete" data-toggle="modal" data-target="#deleteModal" data-id="{{ $comment->id }}">supprimer</button>
                                @endif
                            </div>
                            
                            <div class="comment-content">
                                <p>{{ $comment->comments_body }}</p>
                            </div>
                        </div>

                    </div>

                @endforeach

                <!-- Modal delete -->
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Supprimer un commentaire</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="" method="get" action="{{ route('delete_comments') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                    <input type="hidden" name="commentId" id="commentId">

                                    <p>Êtes-vous sûr de vouloir supprimer ce commentaire ?</p>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-secondary">Confirmer</button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="items-paginate">
                    {{ $comments->links() }}
                </div>


            </div>

        </div>
        
        <div class="page-details-sidebar">

            @foreach($news->games as $game)
                <h4>Autres articles de {{ $game->games_title }}</h4>
                <hr>
            @endforeach
            @forelse($otherNews as $news)
                    <a href="{{ route('newsdetails', [$news->slug]) }}">
                        <div class="inline-card">
                            <div class="img">
                                <img src="{{ url('') }}/{{ $news->image }}" alt="">
                            </div>
                            <div class="body">
                                <h6>{{ $news->news_title }}</h6>
                                <p>{{ \Illuminate\Support\Str::limit($news->desc_intro, $limit = 80, $end = ' ...') }}</p>
                            </div>
                        </div>
                    </a>
            @empty
                <p>Aucun article pour le moment.</p>
            @endforelse

        </div>

    </div>

@endsection

@push('script')
    <script>

        $(document).ready(function(){

            /** KEEP SCROLL POSITION AFTER REFRESH **/  
            $(window).scroll(function () {
                sessionStorage.scrollTop = $(this).scrollTop();
            });

            $(document).ready(function () {
                if (sessionStorage.scrollTop != "undefined") {
                    $(window).scrollTop(sessionStorage.scrollTop);
                }
            });

            // VALIDATE COMMENT
            var form = document.querySelector(".comment-form");
            var comment = document.querySelector("#comment");
            var smallComment = $("#smallComment");
            var message = "Attention ! Vous n'avez pas rédigé votre commentaire";

            smallComment.hide();

            form.addEventListener("submit", (e) => {

                if(comment.value === ""){
                    e.preventDefault();
                    smallComment.show();
                    smallComment.html(message);
                    comment.className = "comment comment-error";
                } else {
                    smallComment.hide();
                    comment.className = "comment";
                }
            })

            // DELETE COMMENT
            $('.comment-delete').click(function (e) {
                
                var commentId = $(this).attr('data-id');
                console.log(commentId)
                document.getElementById('commentId').value = commentId;
                
            })

        })

    </script>
@endpush