@extends('layouts.app')

@section('content')
    <div class="">
      @if(Auth::user()->id == $group->admin_id)
        <a href="{{URL::to('groups/'.$group->id.'/search')}}" class="btn btn-primary">Add Members</a>
      @endif
      
    </div>
@endsection
