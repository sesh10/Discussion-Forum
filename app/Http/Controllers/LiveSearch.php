<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Group;
use App\Group_User;

use Auth;

use Illuminate\Database\Eloquent\Model;

class LiveSearch extends Controller
{
    //
    public function search($group_id){
      $group = Group::find($group_id);
      // $users = Auth::user()->availableUsers()->get();

      $ids = Group_User::where('group_id', '=', $group_id)->pluck('user_id');
      $users =  User::whereNotIn('id', $ids)->get();

      return view("addGroupMembers")->with('group',$group)->with('users',$users);
    }
    public function action(Request $request,$group_id){

      if($request->ajax())
       {
        $output = '';
        $query = $request->get('query');
        $group = Group::find($group_id);

        $ids = Group_User::where('group_id', '=', $group_id)->pluck('user_id');
        $users =  User::whereNotIn('id', $ids);

        if($query != '')
        {
         $data = $users->where('name', 'like', '%'.$query.'%')->where('email', 'like', '%'.$query.'%')->get();
        }
        else
        {
         $data = $users->get();

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
             <td><button class="btn btn-primary add" type="submit" data-user_id="{{ $row->id }}>
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
        // return view('addGroupMembers')->with('table_data',$output)->with('total_data',$total_row);
        echo json_encode($data);
       }
      }

      public function addUser(Request $request,$group_id){

        // $user = User::find($user_id);
        $email = $request->get('email');
        $user = User::where('email', $email)->get();
        $group = Group::find($group_id);
        // $id = $user->groups()->get(['group_id']);
        $group->users()->attach($user);

        // return redirect(route('liveSearch.search',$group_id));
        
      }

}
