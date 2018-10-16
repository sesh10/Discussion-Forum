@extends('layouts.app')

@section('content')
    <div class="container">
      <h2 class="">
        {{$post->title}}
      </h2>

      <h4>Write your comment <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span></h4>

    {{-- {!! Form::open(['action' => 'repliesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

        <div class="form-group">
            {{Form::label('username', 'User')}}
            {{Form::text('username', Auth::user()->name , ['class' => 'form-control', 'disabled'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Reply')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>

        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!} --}}
    <form id="add-comment-form" action="{{URL::to('discussions/'.$post->id.'/replies')}}" method="POST">
      {{ csrf_field() }}
     <div class="form-group">
       <input class="form-control" type="text" disabled value="{{Auth::user()->name}}">
     </div>
     <div class="form-group">
       <textarea class="form-control" id='article-ckeditor' name="body" placeholder="Write your comment..." form="add-comment-form" rows="5" cols="70"></textarea>
     </div>
     <div class="form-group">
       <button class="btn btn-success btn-sm">Comment <span class="glyphicon glyphicon-comment" aria-hidden="true"></span></button>
     </div>
   </form>

  </div>
@endsection
