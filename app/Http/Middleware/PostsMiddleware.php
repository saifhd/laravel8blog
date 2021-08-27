<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(isset($request->slug)){
            $slug=$request->slug;
            $post=Post::where('slug',$slug)->first();
        }
        elseif(isset($request->id)){
            $id=$request->id;
            $post=Post::findOrFail($id);
        }

        $user_id=auth()->user()->id;
        if($user_id == $post->user_id){
            return $next($request);
        }
        else{
            $notification=array(
                'messege'=>'You Cant Do Actions On Other Users Posts',
                'alert-type'=>'error'
                );
            return Redirect()->back()->with($notification);
        }

    }
}
