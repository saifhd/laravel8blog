@extends('layouts.app')

@section('content')

@include('posts.header',['categories'=>$categories])

<main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
@if(count($posts)>0)
    <article
        class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
        <div class="py-6 px-5 lg:flex">
            <div class="flex-1 lg:mr-8">
                <img src="{{asset($posts->first()->image)}}" alt="Blog Post illustration" class="rounded-xl">
            </div>

            <div class="flex-1 flex flex-col justify-between">
                <header class="mt-8 lg:mt-0">
                    <div class="space-x-2">
                        <a href="#"
                            class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                            style="font-size: 10px">{{$posts->first()->category->name}}</a>


                    </div>

                    <div class="mt-4">
                        <h1 class="text-3xl">
                            {{$posts->first()->title}}
                        </h1>

                        <span class="mt-2 block text-gray-400 text-xs">
                                Published <time> {{\Carbon\Carbon::parse($posts->first()->created_at)->diffForHumans()}}</time>
                            </span>
                    </div>
                </header>

                <div class="text-sm mt-2">
                   {!! subStr($posts->first()->body,0,300) !!}


                </div>

                <footer class="flex justify-between items-center mt-8">
                    <div class="flex items-center text-sm">
                        <img class="h-16 w-16 rounded-full" src=<?php
                            if(! $posts->first()->user->avatar){
                                echo "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80";

                            }
                            else{
                                echo asset($posts->first()->user->avatar) ;
                            }
                        ?> alt="">
                        <div class="ml-3">
                            <h5 class="font-bold">{{$posts->first()->user->name}}</h5>

                        </div>
                    </div>

                    <div class="hidden lg:block">
                        <a href="{{route('posts.preview',$posts->first()->slug)}}"
                            class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                        >Read More</a>
                    </div>
                </footer>
            </div>
        </div>
    </article>

    <div class="lg:grid lg:grid-cols-2">
        @foreach($posts->skip(1) as $row)
            @if($loop->iteration==1 || $loop->iteration==2)
                @include('posts.postSlide')
            @endif
        @endforeach

    </div>

    <div class="lg:grid lg:grid-cols-3">
    @foreach($posts->skip(3) as $row)
        @include('posts.postSlide')
    @endforeach

    </div>
    {{$posts->links()}}
@else
    <h4>There Have No Posts Yet</h4>
@endif

</main>

@endsection
