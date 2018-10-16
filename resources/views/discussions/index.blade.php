@extends('layouts.app')

@section('content')
<div>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Discussions</h1>
            <p class="lead">Lets discuss various topics together</p>
        </div>
    </div>

    <div class="container">
      @if(count($posts) > 0)
          @foreach($posts as $post)
            <div class="card" data-postid="{{ $post->id }}">
                <div class="card-header">
                    {{strtoupper($post->category)}}
                        <span class="float-right">{{$post->created_at}}</span>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">
                        {{$post->content}}
                    </p>
                    <blockquote class="blockquote mb-0">
                        <footer class="blockquote-footer">Started by
                            user
                        </footer>
                    </blockquote>
                    @if(Auth::check())
                    <div class="" style="display: inline-block;">
                      <a href="#" class="like">{{ Auth::user()->likes()->where('discussion_id', $post->id)->first() ? Auth::user()->likes()->where('discussion_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |
                      <a href="#" class="like">{{ Auth::user()->likes()->where('discussion_id', $post->id)->first() ? Auth::user()->likes()->where('discussion_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a>

                    </div>
                    @endif
                    <a href="{{URL::to("discussions/$post->id")}}" class="btn btn-success">Participate</a>
                </div>
            </div>
          @endforeach
          {{$posts->links()}}
          @else
          <p>No posts found</p>
          @endif
          <hr>
    </div>


</div>
@endsection
@section('js')
  <script>
          var token = '{{ Session::token() }}';
          var urlLike = '{{ route('like') }}';
  </script>
  <script>
  $(document).ready(function() {
    // jQuery('#ajaxSubmit').click(function(e){
    //            e.preventDefault();
    //            $.ajaxSetup({
    //               headers: {
    //                   'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    //               }
    //           });
    //         });

    $('.like').on('click', function(event) {
      event.preventDefault();

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      postId = event.target.parentNode.parentNode.parentNode.dataset['postid'];
      var isLike = event.target.previousElementSibling == null;
      console.log(isLike);
      $.ajax({
          method: 'POST',
          url: urlLike,
          data: {isLike: isLike, postId: postId, _token: token}
      })
          .done(function() {
            event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'Dislike' ? 'You don\'t like this post' : 'Dislike';
              if (isLike) {
                  event.target.nextElementSibling.innerText = 'Dislike';
              } else {
                  event.target.previousElementSibling.innerText = 'Like';
              }
          });
    });
  });
  </script>

@endsection
