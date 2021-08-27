<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsLetter;


class NewsLetterController extends Controller
{
    //
    public function index(){
        $newsletters=NewsLetter::orderBy('id','DESC')->paginate(10)->withQueryString();
        return view('newsletter.index',compact('newsletters'));
    }

    public function store(Request $request){
        $newsLetter=new NewsLetter();
        $newsLetter->email=$request->input('email');
        if($newsLetter->save()){
            $notification=array(
                'messege'=>'You are Subscribed Successfully',
                'alert-type'=>'success'
                );
            return Redirect()->back()->with($notification);
        }
        else{
            $notification=array(
                'messege'=>'Try Again',
                'alert-type'=>'error'
                );
            return Redirect()->back()->with($notification);
        }
    }

    public function delete($id){
        $newsLetter=NewsLetter::findOrFail($id);
        if($newsLetter->delete()){
            $notification=array(
                'messege'=>'News Letter Deleted Successfully',
                'alert-type'=>'success'
                );
            return Redirect()->back()->with($notification);
        }
        else{
            $notification=array(
                'messege'=>'Try Again',
                'alert-type'=>'error'
                );
            return Redirect()->back()->with($notification);
        }
    }
}
