@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="card" style="margin: 20px 0px;">
      <div class="card-header">
        <strong>{{strtoupper($post->category)}}</strong>
        <span class="float-right">{{$post->created_at}}</span>
      </div>
      <div class="card-body">
        <h5 class="card-title"><strong>{{$post->title}}</strong></h5>
        <p class="card-text">{{$post->content}}</p>
        <blockquote class="blockquote mb-0">
          <footer class="blockquote-footer">Started by  <cite title="Source Title">{{$post->user->name}}</cite></footer>
        </blockquote>
        @if(!Auth::guest())
          @if(Auth::user()->id === $post->user_id)
          <div class="float-right">
            <a href="{{URL::to("discussions/$post->id/edit")}}" class="btn btn-warning">Edit</a>

            {!!Form::open(['action' => ['discussionController@destroy', $post->id], 'method' => 'POST', 'style'=>"display:inline-block"])!!}
                  {{Form::hidden('_method', 'DELETE')}}
                  {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
          </div>
        @endif
        @endif
      </div>
    </div>



    <div class="card" style="marginBottom: 20px;">
      <div class="card-body">
        <div class="text-right">
          <a class="btn btn-success" href='{{$post->id}}/replies/create'><i class="fas fa-comments fa-2x" style="marginRight: 10px;"></i>Add Your Comment</a>
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
                      <h6 class="card-title"><strong>{{$comment->user->name}}</strong></h6>
                      <p class="card-text">{{$comment->content}}</p>
                    </div>
                    <div class="float-right">
                      <p>{{date("d M Y", strtotime($comment->created_at))}}</p>
                      @if(!Auth::guest())
                        @if(Auth::user()->id === $comment->user_id)
                        <div class="float-right">
                          <a class="btn btn-xs btn-warning"
                             href='{{$post->id}}/replies/{{$comment->id}}/edit'>Edit</a>
                             {!!Form::open(['action' => ['repliesController@destroy',$post->id, $comment->id], 'method' => 'POST', 'style'=>"display:inline-block"])!!}
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
  </div>

@endsection
