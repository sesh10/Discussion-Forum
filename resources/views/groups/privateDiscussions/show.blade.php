@extends('layouts.app')

@section('content')

    <div class="card">
      <div class="card-header">
        {{strtoupper($post->category)}}
        <span class="float-right">{{$post->created_at}}</span>
      </div>
      <div class="card-body">
        <h5 class="card-title">{{$post->title}}</h5>
        <p class="card-text">{{$post->content}}</p>
        <blockquote class="blockquote mb-0">
          <footer class="blockquote-footer">Started by  <cite title="Source Title">{{$post->user->name}}</cite></footer>
        </blockquote>
        @if(!Auth::guest())
          @if(Auth::user()->id === $post->user_id)
          <div class="float-right">
            <a href="{{$post->id."/edit"}}" class="btn btn-warning">Edit</a>

            {!!Form::open(['action' => ['privateDiscussionController@destroy',$group_id ,$post->id], 'method' => 'POST', 'style'=>"display:inline-block"])!!}
                  {{Form::hidden('_method', 'DELETE')}}
                  {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
          </div>
        @endif
        @endif
      </div>
    </div>



    <div class="card">
      <div class="card-body">
        <div class="text-right">
          <a class="btn btn-success" href='{{$post->id}}/comments/create'>Add Your Comment</a>
        </div>
        <hr>
         <h4><strong>Comments <span class="glyphicon glyphicon glyphicon-comment" aria-hidden="true"></span></strong></h4>
        <div class="row">
          @if (count($comments)>0)
            @foreach ($comments as $comment)
              <div class="col-md-12 mb-2">
                <div class="card">
                  <div class="card-body">
                    <div class="float-left">
                      <p class="card-title">{{$comment->user->name}}</p>
                      <p class="card-text">{{$comment->content}}</p>
                    </div>
                    <div class="float-right">
                      <p>{{$comment->created_at}}</p>
                      @if(!Auth::guest())
                        @if(Auth::user()->id === $comment->user_id)
                        <div class="float-right">
                          <a class="btn btn-xs btn-warning"
                             href='{{$post->id}}/comments/{{$comment->id}}/edit'>Edit</a>
                             {!!Form::open(['action' => ['privateRepliesController@destroy',$group_id,$post->id, $comment->id], 'method' => 'POST', 'style'=>"display:inline-block"])!!}
                                   {{Form::hidden('_method', 'DELETE')}}
                                   {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                             {!!Form::close()!!}
                        </div>
                      @endif
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            @endforeach

          {{-- <% }) %> --}}
          </div>
          @endif

      </div>
    </div>
@endsection
