@extends('layouts.app')

@section('content')

<main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
    <h1 class="px-6 text-xl text">All Categories <a class="inline-flex items-center h-8 px-4 m-2 text-sm text-white transition-colors duration-150 bg-green-500 rounded-lg focus:shadow-outline hover:bg-green-600"
        style="float: right;" href="{{ route('categories.create') }}">Add New</a></h1><hr>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Slug
                                </th>
                                @if(auth()->user()->is_admin == 1 && auth()->user()->status==1)
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @if(count($categories)>0)
                            @foreach($categories as $row)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">

                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $row->name }}
                                            </div>

                                        </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $row->slug }}</div>
                                    </td>
                                    @if(auth()->user()->status==1 && auth()->user()->is_admin==1)
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                            <a href="{{ route('categories.edit',$row->slug) }}" class="cursor-pointer inline-flex items-center h-8 px-4 m-2 text-sm text-white transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800"
                                                >Edit</a>
                                            <form class="inline-flex items-center" action="{{route('categories.delete',$row->id)}}" id="deletecat" method="post">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button class="modal-open inline-flex items-center h-8 px-4 m-2 text-sm text-white transition-colors duration-150 bg-red-600 rounded-lg focus:shadow-outline hover:bg-red-700"
                                                >Delete</button>
                                            </form>


                                        </td>
                                    @endif
                                </tr>

                            @endforeach

                            <!-- More people... -->
                        </tbody>
                    </table>
                    @else
                        <h3>No Categories Available </h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{ $categories->links() }}

</main>



<script>
    $(document).on("click","#deletecat",function(e){
        e.preventDefault();
        var link=$(this).attr("action");
        Swal.fire({
            title: 'Are you Wants to Delete?',
            text: "You won't be able to revert this! Your Category Posts will be Deleted",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {

                window.location.action=$(this).submit();
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                );
            }
        });
    });
</script>




@endsection
