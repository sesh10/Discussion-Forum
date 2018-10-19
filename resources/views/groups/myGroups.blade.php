@extends('layouts.app')

@section('content')
    <div class="container">
      {{-- {{$groups}} --}}
      @if ($groups->count() > 0)
        <ul class="list-group">
          @foreach ($groups as $group)
            <li class="list-group-item"><strong>{{$group->groupName}}</strong><span class="badge float-right"><a href="groups/{{$group->id}}" class="btn btn-primary btn-sm">Start Discussion</a></span></li>
          @endforeach
        </ul>
      @else
        <h5>No groups joined</h5>
      @endif


    </div>
@endsection
