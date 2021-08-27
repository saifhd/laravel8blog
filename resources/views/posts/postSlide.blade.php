
<article
    class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
    <div class="py-6 px-5">
        <div>
            <img src="{{asset($row->image)}}" alt="Blog Post illustration" class="rounded-xl">
        </div>

        <div class="mt-8 flex flex-col justify-between">
            <header>
                <div class="space-x-2">
                    <a href="#"
                        class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                        style="font-size: 10px">{{$row->category->name}}</a>


                </div>

                <div class="mt-4">
                    <h1 class="text-3xl">
                        {{$row->title}}
                    </h1>

                    <span class="mt-2 block text-gray-400 text-xs">
                        Published <time>{{\Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</time>
                    </span>
                </div>
            </header>

            <div class="text-sm mt-4">
                {!! subStr($row->body,0,300) !!}
            </div>

            <footer class="flex justify-between items-center mt-8">
                <div class="flex items-center text-sm">
                    <img class="h-16 w-16 rounded-full" src=<?php
                        if(! $row->user->avatar){
                            echo "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80";

                        }
                        else{
                            echo asset($row->user->avatar) ;
                        }
                    ?> alt="">
                    <div class="ml-3">
                        <h5 class="font-bold">{{$row->user->name}}</h5>

                    </div>
                </div>

                <div>
                    <a href="{{route('posts.preview',$row->slug)}}"
                        class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                    >
                        Read More
                    </a>
                </div>
            </footer>
        </div>
    </div>
</article>
