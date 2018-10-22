@extends('layouts.app')

@section('content')
  {{-- <h1>{{$group}}</h1>
  <h2>{{$users}}</h2> --}}
  
    <div class="container">
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

       </tbody>
      </table>
     </div>
    </div>
@endsection
@section('js')
  <script>

  $(document).ready(function(){
      var urlLike = '{{ route('liveSearch.addUser', $group->id) }}';
      console.log({{$group->id}});
      fetch_customer_data();

      function fetch_customer_data(query = '')
      {
        console.log("function called");
        console.log({{$group->id}};

      $.ajax({
         url:"{{ route('liveSearch.action',$group->id) }}",
         method:'GET',
         data:{query:query},
         dataType:'json',
         success:function(data)
         {

          $('tbody').html(data.table_data);
          $('#total_records').text(data.total_data);
          $(".add").on('click',function(event) {

            console.log(event.target.parentNode.previousElementSibling.innerText);
            event.preventDefault();
            // user_id = event.target.dataset['user_id'];

            email = event.target.parentNode.previousElementSibling.innerText;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                    type: 'post',
                    url: '{{ route('liveSearch.addUser', $group->id) }}',
                    data: {
                        email : email
                    },
                    success: function(){
                      console.log("done");
                      event.target.parentNode.parentNode.remove();
                    }
                });
                // .done(function() {
                //   console.log("done");
                //   event.target.parentNode.parentNode.remove();
                // });
            });
         }
      })
      

      $(document).on('keyup', '#search', function(){
      var query = $(this).val();
      fetch_customer_data(query);
      });


    


  </script>
@endsection
