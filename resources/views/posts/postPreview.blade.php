@extends('layouts.app')

@section('content')
@if(isset($post))
<main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
    <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
        <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
            <img src="{{asset($post->image)}}" alt="" class="rounded-xl">

            <p class="mt-4 block text-gray-400 text-xs">
                Published <time>{{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</time>
            </p>

            <div class="flex items-center lg:justify-center text-sm mt-4">
                <img class="h-16 w-16 rounded-full" src=<?php
                    if(! $post->user->avatar){
                        echo "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80";

                    }
                    else{
                        echo asset($post->user->avatar) ;
                    }
                ?> alt="">
                <div class="ml-3 text-left">
                    <h5 class="font-bold">{{$post->user->name}}</h5>

                </div>
            </div>
        </div>

        <div class="col-span-8">
            <div class="hidden lg:flex justify-between mb-6">
                <a href="{{route('posts')}}"
                    class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                    <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                        <g fill="none" fill-rule="evenodd">
                            <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                            </path>
                            <path class="fill-current"
                                d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                            </path>
                        </g>
                    </svg>

                    Back to Posts
                </a>

                <div class="space-x-2">
                    <a href="#"
                        class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                        style="font-size: 10px">{{$post->category->name}}</a>

                </div>
            </div>

            <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                {{$post->title}}
            </h1>

            <div class="space-y-4 lg:text-lg leading-loose">
                {!! $post->body !!}
            </div>
            <br><br>
            <div class="fb-comments" data-href="{{ Request::url() }}" data-width="" data-numposts="5"></div>

        </div>
    </article>

</main>
@endif
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0" nonce="RJf2yMW4"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-60c6d417ddd00091"></script>
@endsection
