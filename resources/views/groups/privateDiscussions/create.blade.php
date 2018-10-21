@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Create Discussion</h1>
    {!! Form::open(['action' => ['privateDiscussionController@store',$group_id], 'method' => 'POST']) !!}
        <div class="form-group">
          {{Form::label('category', 'Category')}}
          {{Form::select('category', ['sports' => 'Sports', 'technology' => 'Technology', 'education'=>'Education', 'politics'=>'Politics'], 'sports')}}
        </div>
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Description')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>

        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
  </div>

@endsection
