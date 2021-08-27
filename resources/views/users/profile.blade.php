@extends('layouts.app')


@section('content')

<main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">


    @if($errors->any())
        @foreach ($errors->all() as $error)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">

                <span class="block sm:inline">{{ $error }}</span>

            </div>
        @endforeach
    @endif

    <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
            <h1 class="text-lg text">Edit Profile</h1><hr>
            <br>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="company">
                    User Name
                </label>
                <input name="name" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id=""
                    type="text" value="{{ $user->name }}" required>

                </div>
                <div class="md:w-1/2 px-3">
                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="title">
                    Email
                </label>
                <input name="email" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id="" type="text" placeholder="Url Followed By"
                    value="{{ $user->email }}" required="">
                </div>
            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="company">
                        Password
                    </label>
                    <input name="old_password" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id=""
                        type="password" placeholder="Your Old Password">

                </div>
                <div class="md:w-1/2 px-3">
                    <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="title">
                        New Password(If you Wants to Change)
                    </label>
                    <input name="new_password" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id=""
                        type="password" placeholder= "Your New Password">
                </div>
            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="company">
                        Profile Picture
                    </label>
                    <input name="avatar" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id=""
                        type="file"  >

                </div>
                <div class="md:w-1/2 px-3">

                </div>
            </div>



            <div class="-mx-3 md:flex mt-2">
                <div class="md:w-full px-3">
                    <button class="md:w-full bg-gray-900 text-white font-bold py-2 px-4 border-b-4 hover:border-b-2 border-gray-500 hover:border-gray-100 rounded-full">
                        Update Profile
                    </button>
                </div>
            </div>
        </div>
    </form>
</main>






@endsection
