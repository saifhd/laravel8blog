@extends('layouts.app')

@section('content')

<main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
    <h1 class="px-6 text-xl text">My Posts</h1><hr>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    #
                                </th>
                                <th scope="col" class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    title
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category
                                </th>


                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Action</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $page=Request::get('page')-1; ?>
                        @if(count($posts)>0)
                            @foreach($posts as $row)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900"><?php
                                            if(isset($page) && $page >= 0){
                                                echo ($page*10)+$loop->iteration;
                                            }
                                            else{
                                                echo $loop->iteration;
                                            }
                                        ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="{{asset($row->image)}}" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                            {{$row->title}}
                                            </div>

                                        </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{$row->category->name}}</div>

                                    </td>


                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a class="inline-flex items-center h-8 px-4 m-2 text-sm text-white transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800"
                                            href="{{route('posts.edit',$row->slug)}}">Edit</a>
                                        <form class="inline-flex items-center" action="{{route('posts.delete',$row->id)}}" method="post" id="delete">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button  class="modal-open inline-flex items-center h-8 px-4 m-2 text-sm text-white transition-colors duration-150 bg-red-600 rounded-lg focus:shadow-outline hover:bg-red-700"
                                            type="submit">Delete</button>
                                        </form>
                                        <a class="inline-flex items-center h-8 px-4 m-2 text-sm text-white transition-colors duration-150 bg-green-500 rounded-lg focus:shadow-outline hover:bg-green-600"
                                            href="{{route('posts.preview',$row->slug)}}">View</a>

                                    </td>
                                </tr>

                            @endforeach

                            <!-- More people... -->
                        </tbody>
                    </table>
                    @else
                        <h3>No Posts Available </h3>
                    @endif

                </div>
            </div>
        </div>
    </div>
    {{ $posts->links() }}
</main>





@endsection
