<div class="sm:hidden" id="mobile-menu"  x-show="open">
    <div class="px-2 pt-2 pb-3 space-y-1" >
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        <a href="{{route('posts')}}" aria-current="page" class="<?php
            if(Request::is('/')){
                echo "bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium";
            }
            else{
                echo "text-black-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium";
            }
        ?>">Dashboard</a>
        @guest
            <a href="{{Route('login')}}" class="text-black-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page">Login</a>
            <a href="{{route('register')}}" class="text-black-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page">Register</a>
        @endguest
        @auth
            @if(auth()->user()->status == 1)
                <a href="{{route('posts.create.view')}}" class="<?php
                    if(Request::is('posts/create')){
                        echo "bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium";
                    }
                    else{
                        echo "text-black-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium";
                    }
                ?>">Create Post</a>

                <a href="{{route('posts.myposts')}}" class="<?php
                    if(Request::is('posts')){
                        echo "bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium";
                    }
                    else{
                        echo "text-black-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium";
                    }
                ?>">My Posts</a>

                <a href="{{route('categories')}}" class="<?php
                    if(Request::is('categories')){
                        echo "bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium";
                    }
                    else{
                        echo "text-black-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium";
                    }
                ?>">Categories</a>
            @endif
            @if(auth()->user()->is_admin == 1 && auth()->user()->status == 1)
                <a href="{{route('newsletter')}}" class="<?php
                    if(Request::is('newsletter')){
                        echo "bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium";
                    }
                    else{
                        echo "text-black-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium";
                    }
                ?>">NewsLetter</a>
                <a href="{{route('users')}}" class="<?php
                    if(Request::is('users')){
                        echo "bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium";
                    }
                    else{
                        echo "text-black-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium";
                    }
                ?>">Users</a>
            @endif

        @endauth
    </div>
</div>
