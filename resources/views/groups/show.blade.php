@extends('layouts.app')

@section('content')
    <div class="container">
      @if (Auth::check())
        @if(Auth::user()->id == $group->admin_id)
          <a href="{{URL::to('groups/'.$group->id.'/search')}}" class="btn btn-primary float-right">Add Members</a>
        @endif
        <a href="{{$group->id}}/discussions/create" class="btn btn-primary btn-lg">Start New Discussion</a>

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
                              {{-- {{$post->user()->name}} --}}
                              User
                          </footer>
                      </blockquote>
                      @if(Auth::check())
                      <div class="" style="display: inline-block;">
                        <a href="#" class="like">{{ Auth::user()->likes()->where('discussion_id', $post->id)->first() ? Auth::user()->likes()->where('discussion_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |
                        <a href="#" class="like">{{ Auth::user()->likes()->where('discussion_id', $post->id)->first() ? Auth::user()->likes()->where('discussion_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a>

                      </div>
                      @endif
                      <a href="{{URL::to("groups/$group->id/discussions/$post->id")}}" class="btn btn-success">Participate</a>
                  </div>
              </div>
            @endforeach
            @else
            <p>No posts found</p>
            @endif

      @else

      @endif

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
