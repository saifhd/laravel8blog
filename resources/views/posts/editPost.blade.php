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
    <form action="{{route('posts.update',$post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('PUT') }}
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
            <h1 class="py-6 text-lg text">Edit and Update Post</h1><hr>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="company">
                    Title
                </label>
                <input name="title" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id=""
                    type="text" value="{{ $post->title }}" >

                </div>
                <div class="md:w-1/2 px-3">
                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="title">
                    Slug
                </label>
                <input name="slug" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id="" type="text" placeholder="Url Followed By"
                    value="{{ $post->slug }}" >
                </div>
            </div>

            <div class="-mx-3 md:flex mb-2">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="location">
                        Category Name
                    </label>
                    <div>
                        <select name="category_id" class="w-full bg-gray-200 border border-gray-200 text-black text-xs py-3 px-4 pr-8 mb-3 rounded" id="">
                            @foreach($categories as $row)
                                <option <?php
                                    if($post->category_id == $row->id){
                                        echo "selected";
                                    }
                                 ?> value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="md:w-1/2 px-3">
                    <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="application-link">
                            Image <span>(if you Wants to change then upload)</span>
                    </label>
                    <input name="image" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id="" type="file"
                    placeholder="http://...." >


                </div>

            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-full px-3">
                    <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="application-link">
                        Body
                    </label>
                    <textarea id="mytextarea" name="body" >{{ $post->body }}</textarea>

                    </div>
            </div>
            <div class="-mx-3 md:flex mt-2">
                <div class="md:w-full px-3">
                    <button class="md:w-full bg-gray-900 text-white font-bold py-2 px-4 border-b-4 hover:border-b-2 border-gray-500 hover:border-gray-100 rounded-full">
                        Button
                    </button>
                </div>
            </div>
        </div>
    </form>
</main>





<script src="https://cdn.tiny.cloud/1/i6nemghxzljgcjvimnwol0wew5uwq98yl1raqvpmgwl13535/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#mytextarea'
    });
</script>
@endsection
