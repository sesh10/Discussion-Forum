@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Create Private Group</h1>
    {!! Form::open(['action' => ['GroupUserController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            <strong>{{Form::label('groupName', 'Group Name')}}</strong>
            {{Form::text('groupName', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder'=>'Group Name'])}}
        </div>
        {{Form::submit('Create', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
  </div>

@endsection
