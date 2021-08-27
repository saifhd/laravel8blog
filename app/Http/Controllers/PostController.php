<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PostCreateRequest;
use App\Mail\notificationPost;
use App\Models\NewsLetter;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    //

    public function index(Request $request){
        $categories=Category::all();
        $search=$request->input('search');
        $category_search=$request->category;

        if(isset($category_search) && isset($search))
        {
            if($category_search=="all"){
                $posts=Post::orderBy('id','DESC')->Filter($search)->paginate(6)->withQueryString();
            }
            else{


                $posts=Category::where('slug',$request->category)->first()->post()->orderBy('id','DESC')
                ->where(function($query) use($search){
                    $query->Filter($search);
                })->paginate(6)->withQueryString();
                // dd($posts);
            }


        }else{
            if(isset($category_search)){
                if($category_search=="all"){
                    $posts=Post::orderBy('id','Desc')->Paginate(6)->withQueryString();
                }
                else{
                    $category=Category::where('slug',$category_search)->first();
                    $posts=$category->post()->paginate(6)->withQueryString();

                }


            }
            elseif(isset($search)){
                $posts=Post::orderBy('id','DESC')->Filter($search)->paginate(6)->withQueryString();

            }
            else{

                $posts=Post::orderBy('id','Desc')->Paginate(6)->withQueryString();
                // dd($posts);

            }
        }

        return view('posts.posts',compact('posts'),compact('categories'));

    }

    public function preview($id){

        $post=Post::where('slug',$id)->first();
        // dd($post->created_at);
        return view('posts.postPreview',compact('post'));
    }

    public function create(){
        $categories=Category::all();

        return view('posts.createPost',compact('categories'));
    }

    public function store(PostCreateRequest $request){


        $post=new Post();
        $post->title=$request->input('title');
        $post->slug=$request->input('slug');
        $post->body=$request->input('body');
        $post->category_id=$request->input('category_id');

        //Upload Image with Unique id
        $image=$request->file('image');
        $imageOriginalExtension=$image->getClientOriginalExtension();
        $destinationPath='images/posts/';
        $imageName=uniqid().".".$imageOriginalExtension;
        $image->move($destinationPath,$imageName);

        $post->image=$destinationPath.$imageName;
        $post->user_id=auth()->user()->id;



        //mail
        $user=User::all();
        $title=$post->title;
        $body=$post->body;

        $slugmail='/post/'.$request->slug;
        foreach($user as $row){
            if(Mail::to($row->email)->send(new notificationPost($title,$body,$slugmail))){
                return "success";
            }
        }

        $newsletter=NewsLetter::all();
        foreach($newsletter as $row){
            if(Mail::to($row->email)->send(new notificationPost($title,$body,$slugmail))){
                return "success";
            }
        }

        if($post->save()){
            $notification=array(
                'messege'=>'Blog Post Uploaded succesfully',
                'alert-type'=>'success'
                );
            return Redirect()->back()->with($notification);
        }
        else{
            $notification=array(
                'messege'=>'Blog Post Not uploaded succesfully. Try Again',
                'alert-type'=>'error'
                );
            return Redirect()->back()->with($notification);
        }




    }
    public function UsersPosts(){
        $user_id=auth()->user()->id;
        $posts=Post::orderBy('id','DESC')->where('user_id',$user_id)->paginate(10)->withQueryString();
        // dd($posts);
        return view('posts.myPosts',compact('posts'));
    }

    public function delete($id){
        $post=Post::findOrFail($id);

        if($post->delete()){
            $notification=array(
                'messege'=>'Post Deleted succesfully',
                'alert-type'=>'success'
                );
            return Redirect()->back()->with($notification);

        }
        else{
            $notification=array(
                'messege'=>'Post Not Deleted Try Again',
                'alert-type'=>'error'
                );
            return Redirect()->back()->with($notification);
         }
    }

    public function edit($slug){
        $categories=Category::all();
        $post=Post::where('slug',$slug)->first();

        return view('posts.editPost',compact('post','categories'));
    }

    public function update(Request $request,$id){

        $post=Post::findOrFail($id);
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->category_id=$request->input('category_id');
        $post->slug=$request->input('slug');



        //if we want to update image
        if($request->file('image')){

            //delete previous image
            $image_path=$post->image;
            if(File::exists($image_path)){
                File::delete($image_path);

            }

            //upload Image
            $image=$request->file('image');
            $imageOriginalExtension=$image->getClientOriginalExtension();
            $destinationPath='images/posts/';
            $imageName=uniqid().".".$imageOriginalExtension;
            $image->move($destinationPath,$imageName);


            $post->image=$destinationPath.$imageName;

        }


        if($post->update()){
            $notification=array(
                'messege'=>'Post Updated succesfully',
                'alert-type'=>'success'
                );
            return redirect()->route('posts.edit', $request->slug)->with($notification);
        }
        else{
            $notification=array(
                'messege'=>'Post not Updated Try Again',
                'alert-type'=>'error'
                );
            return redirect()->route('posts.edit', $request->slug)->with($notification);
        }

    }
}
