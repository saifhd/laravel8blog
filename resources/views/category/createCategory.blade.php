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

    <form action="{{route('categories.store')}}" method="post" >
        @csrf
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
            <h1 class="text-lg text">Create New Category</h1><hr>
            <br>

            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-full px-3">
                    <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="application-link">
                        Category Name
                    </label>
                    <input name="name" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id=""
                    type="text" placeholder="Category Name" value="{{ old('name') }}" required="">


                    </div>
            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-full px-3">
                    <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="application-link">
                        Category Slug
                    </label>
                    <input name="slug" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id=""
                    type="text" placeholder="Url Follwed By/Slug" value="{{ old('slug') }}" required="">


                    </div>
            </div>
            <div class="-mx-3 md:flex mt-2">
                <div class="md:w-full px-3">
                    <button class="md:w-full bg-gray-900 text-white font-bold py-2 px-4 border-b-4 hover:border-b-2 border-gray-500 hover:border-gray-100 rounded-full">
                        Create Category
                    </button>
                </div>
            </div>
        </div>
    </form>
</main>






@endsection
