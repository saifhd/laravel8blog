<div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
    <div class="flex-shrink-0 flex items-center">
        <a href="{{route('posts')}}">
            
            <img class=" lg:block h-8 w-auto" src="{{asset('images/logo.svg')}}" alt="Workflow">
        </a>
    </div>
    <div class="hidden sm:block sm:ml-6">
        <div class="flex space-x-4">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="{{route('posts')}}" class="<?php
                if(Request::is('/')){
                    echo "bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium";
                }
                else{
                    echo "text-black-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium";
                }
            ?>">Dashboard</a>
            @auth
            @if(auth()->user()->status == 1)
                <a href="{{route('posts.create.view')}}"
                class=" <?php
                    if(Request::is('posts/create')){
                        echo "bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium";
                    }
                    else{
                        echo "text-black-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium";
                    }
                ?>">Create Post</a>

                <a href="{{route('posts.myposts')}}" class="<?php
                    if(Request::is('posts')){
                        echo "bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium";
                    }
                    else{
                        echo "text-black-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium";
                    }
                ?>">My Posts</a>


                <a href="{{ route('categories') }}" class="<?php
                    if(Request::is('categories')){
                        echo "bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium";
                    }
                    else{
                        echo "text-black-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium";
                    }
                ?>">Categories</a>
            @endif
            @if(auth()->user()->is_admin == 1 && auth()->user()->status == 1)
                <a href="{{ route('newsletter') }}" class="<?php
                    if(Request::is('newsletter')){
                        echo "bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium";
                    }
                    else{
                        echo "text-black-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium";
                    }
                ?>">NewsLetters</a>
                <a href="{{ route('users') }}" class="<?php
                    if(Request::is('users')){
                        echo "bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium";
                    }
                    else{
                        echo "text-black-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium";
                    }
                ?>">Users</a>
            @endif
            @endauth
        </div>
    </div>
</div>
<div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

    <!-- Profile dropdown -->
    @auth
    <div class="ml-3 relative" x-data="{ open: false }">
        <div>
            <button type="button" @click="open = !open" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
            <span class="sr-only">Open user menu</span>
            <img class="h-8 w-8 rounded-full" src=<?php
            if(!auth()->user()->avatar){
                echo "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80";

            }
            else{
                echo asset(auth()->user()->avatar) ;
            }
            ?> alt="">
            </button>
        </div>


        <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" x-show="open">
            <!-- Active: "bg-gray-100", Not Active: "" -->
            <ul >
                <li class="w-full text-left block px-4 py-2 text-sm text-gray-700">{{  auth()->user()->name }}</li>
            <form action="{{route('logout')}}" method="post">
                @csrf
                <li> <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-700 hover:text-white " role="menuitem" tabindex="-1" id="user-menu-item-0">Logout</button></li>
            </form>
                <li> <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-700 hover:text-white " role="menuitem" tabindex="-1" id="user-menu-item-1">Profile</a></li>

            </ul>

        </div>
    </div>
    @endauth
    @guest
    <div class="invisible md:visible ">
        <a href="{{route('login')}}" class="text-xs font-bold uppercase">Login</a>

        <a href="{{route('register')}}" class="bg-blue-500 ml-3 rounded-full font-bold text-xs  text-white uppercase py-3 px-5">
            Register
        </a>
    </div>
    @endguest
</div>
