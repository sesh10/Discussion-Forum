@extends('layouts.app')

@section('content')
  {{-- <h1>{{$group}}</h1>
  <h2>{{$users}}</h2> --}}
    <div class="">
      <div class="form-group">
        <input type="text" name="search" id="search" class="form-control" placeholder="Search Customer Data" />
     </div>
     <div class="table-responsive">
      <h3 align="center">Total Data : <span id="total_records"></span></h3>
      <table class="table table-striped table-bordered">
       <thead>
        <tr>
         <th>Name</th>
         <th>Email</th>
         <th>Add User</th>
        </tr>
       </thead>
       <tbody>
         @if($users->count() > 0)
           @foreach($users as $user)
             <tr>
               <td>{{$user->name}}</td>
               <td id="email">{{$user->email}}</td>
               <td>
                 {!! Form::open(['action' => ["LiveSearch@addUser",$group->id,$user->id], 'method' => 'POST']) !!}
                 {{Form::submit('Add', ['class'=>'btn btn-primary'])}}
                 {!! Form::close() !!}
               </td>
             </tr>
           @endforeach
           @else
           <p>No Users found</p>
           @endif
       </tbody>
      </table>
     </div>
    </div>
@endsection
{{-- @section('js')
  <script>

  $(document).ready(function(){
      var urlLike = '{{ route('liveSearch.addUser', $group_id) }}';
      const group_id = {{$group_id}}
      console.log(group_id);
      fetch_customer_data();

      function fetch_customer_data(query = '')
      {
        console.log("function called");
        console.log(group_id);

      $.ajax({
         url:"{{ route('liveSearch.action',$group_id) }}",
         method:'GET',
         data:{query:query},
         dataType:'json',
         success:function(data)
         {
           console.log(group_id);

          $('tbody').html(data.table_data);
          $('#total_records').text(data.total_data);
          $(".add").on('click',function(event) {
            console.log(group_id);

            console.log(event.target.parentNode.previousElementSibling.innerText);
            event.preventDefault();
            email = event.target.parentNode.previousElementSibling.innerText;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                    type: 'post',
                    url: urlLike,
                    data: {
                        email : email
                    }
                })
                .done(function() {
                  console.log(group_id);

                  event.target.parentNode.parentNode.remove();
                });
            });
         }
      })
      }

      $(document).on('keyup', '#search', function(){
      var query = $(this).val();
      fetch_customer_data(query);
      });


    });


  </script>
@endsection --}}
