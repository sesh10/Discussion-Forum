@extends('layouts.app')

@section('content')
    <div class="">
      <div class="form-group">
        <input type="text" name="search" id="search" class="form-control" placeholder="Search Customer Data" />
     </div>
     <div class="table-responsive">
      <h3 align="center">Total Data : <span id="total_records"></span></h3>
      <table class="table table-striped table-bordered">
       <thead>
        <tr>
         <th>Name
         </th>
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

      fetch_customer_data();

      function fetch_customer_data(query = '')
      {
      $.ajax({
         url:"{{ route('liveSearch.action',$group_id) }}",
         method:'GET',
         data:{query:query},
         dataType:'json',
         success:function(data)
         {
          $('tbody').html(data.table_data);
          $('#total_records').text(data.total_data);
         }
      })
      }

      $(document).on('keyup', '#search', function(){
      var query = $(this).val();
      fetch_customer_data(query);
      });

      $("#add").on('click',function(event) {
        console.log("clicked");
        // event.preventDefault();
        // email = event.target.parentNode.prev.val();
        //
        // $.ajax({
        //         type: 'post',
        //         url: '{{ route('liveSearch.addUser',$group_id) }}',
        //         data: {
        //             email : email
        //         }
        //     })
        //     .done(function() {
        //       event.target.parentNode.parentNode.remove();
        //     });
        });
    });


  </script>
@endsection
