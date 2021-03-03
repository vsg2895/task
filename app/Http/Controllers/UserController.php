<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function block_user($id){

      $user = User::find($id);
      $user->status = 1;
      $status = 'Blocked';
      $user->save();
      MailController::sendUserEmail($user->name,$user->lastname,$user->email,$status);
      return redirect()->back()->with(session()->flash('alert-success','User blocking success'));


   }

   public function delete_user($id){

       $user = User::find($id);

//      if ($user_delete->trashed()){
//
//          dd('softdelete');
//      }
//       User::delete($id);
//       $user->delete();

       $status = 'Deleted';
//       $user->save();
       MailController::sendUserEmail($user->name,$user->lastname,$user->email,$status);
       $user_delete =  User::where('id',$id)->delete();
       return redirect()->back()->with(session()->flash('alert-success','User deleted success'));
   }

   public function blocked_user(){

       $all_users = User::where('status',1)->get();

       return view('site.blockedusers',['all_users'=>$all_users]);

   }

    public function deleted_user(){

        $all_users = User::onlyTrashed()->get();

        return view('site.deletedusers',['all_users'=>$all_users]);

    }

   public function activate_user($id){

       $active_user = User::find($id);
       $active_user->status = 0;
       $status = 'Activating';
       $active_user->save();
       MailController::sendUserEmail($active_user->name,$active_user->lastname,$active_user->email,$status);
       return redirect()->back()->with(session()->flash('alert-success','User activating success'));

   }

}
