<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Group;

use Illuminate\Database\Eloquent\Model;

class LiveSearch extends Controller
{
    //
    public function search($group_id){
      return view("addGroupMembers")->with('group_id',$group_id);
    }
    public function action(Request $request,$group_id){
      if($request->ajax())
       {
        $output = '';
        $query = $request->get('query');
        if($query != '')
        {
         $data = User::where('name', 'like', '%'.$query.'%')->where('email', 'like', '%'.$query.'%')->get();


        }
        else
        {
         $data = User::orderBy('created_at', 'desc')->get();

        }
        $total_row = $data->count();
        if($total_row > 0)
        {
         foreach($data as $row)
         {
          $output .= '
          <tr>
           <td>'.$row->name.'</td>
           <td id="email">'.$row->email.'</td>
           <td><button class="btn btn-primary" type="submit" id="add">
            <span class="glyphicon glyphicon-plus"></span> ADD
          </button></td>
          </tr>
          ';
         }
        }
        else
        {
         $output = '
         <tr>
          <td align="center" colspan="5">No Data Found</td>
         </tr>
         ';
        }
        $data = array(
         'table_data'  => $output,
         'total_data'  => $total_row
        );

        echo json_encode($data);
       }
      }

      public function addUser(Request $request,$group_id){
        $email = $request->get('email');

        $user = User::where('email',$email);
        $group = Group::find($group_id);

        $group->users()->attach($user);

      }

}
