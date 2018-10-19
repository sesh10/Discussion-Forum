@extends('layouts.app')

@section('content')
    <h1>Edit Comment</h1>
    <h4>Name - {{$comment->user->name}}</h4>
    {!! Form::open(['action' => ['privateRepliesController@update',$group_id,$post->id , $comment->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('body', 'Comment')}}
            {{Form::textarea('body', $comment->content, ['id' => 'article-ckeditor', 'class' => 'form-control'])}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
