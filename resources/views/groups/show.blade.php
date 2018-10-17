@extends('layouts.app')

@section('content')
    <div class="">
      <a href="{{URL::to('groups/'.$group_id.'/search')}}" class="btn btn-primary">Add Members</a>
    </div>
@endsection
