<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateProfileRequest;


use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showProfile(){
        $user_id=auth()->user()->id;
        $user=User::findOrFail($user_id);
        // dd($user);

        return view('users.profile',compact('user'));
    }
    public function updateProfile(UpdateProfileRequest $request){
        $user_id=auth()->user()->id;
        $user=User::findOrFail($user_id);

        $user->name=$request->name;
        $user->email=$request->email;

        if(isset($request->old_password)){
            $password_match=Hash::check($request->old_password, $user->password);

            if($password_match==true && isset($request->new_password)){
                $request->validate(['new_password'=>'min:8']);
                $user->password=Hash::make($request->new_password);

            }

        }
        if($request->file('avatar')){
            if($user->avatar){
                if(FILE::exists($user->avatar))
                {
                    File::delete($user->avatar);

                }
            }

            $avatar=$request->file('avatar');
            $request->validate(['avatar'=>'image']);

            $avatarExtension=$avatar->getClientOriginalExtension();
            $destinationPath='images/users/';
            $avatarName=uniqid().$avatarExtension;
            $avatar->move($destinationPath,$avatarName);
            $user->avatar=$destinationPath.$avatarName;
        }
        $user->update();
        $notification=array(
            'messege'=>'User Details Updated succesfully',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }


    public function index(){
        $users=User::orderBy('id','Desc')->paginate(10);
        return view('users.all_users',compact('users'));
    }
    public function statusUpdate($id,Request $request){
        $user=User::findOrFail($id);
        if($user->status == 0){
            $user->status=1;
            if($user->update()){
                $notification=array(
                    'messege'=>'User Activated',
                    'alert-type'=>'success'
                    );
                return Redirect()->back()->with($notification);
            }
        }
        elseif($user->status == 1){
            $user->status=0;
            if($user->update()){
                $notification=array(
                    'messege'=>'User Deactivated',
                    'alert-type'=>'warning'
                    );
                return Redirect()->back()->with($notification);
            }
        }
        $notification=array(
            'messege'=>'Try Again. Something Error',
            'alert-type'=>'error'
            );
        return Redirect()->back()->with($notification);
    }
    public function adminUpdate($id,Request $request){
        $user=User::findOrFail($id);
        if($user->is_admin == 0){
            $user->is_admin=1;
            if($user->update()){
                $notification=array(
                        'messege'=>'User Change as Admin',
                        'alert-type'=>'success'
                    );
                return Redirect()->back()->with($notification);
            }
        }
        elseif($user->is_admin == 1){

            $user->is_admin=0;
            if($user->update()){
                $notification=array(
                    'messege'=>'Admin Change as User',
                    'alert-type'=>'warning'
                );
                return Redirect()->back()->with($notification);
            }

        }
        $notification=array(
                'messege'=>'Try Again. Something Error',
                'alert-type'=>'error'
            );
        return Redirect()->back()->with($notification);
    }
}
