@extends('layouts.app')

@section('content')

<main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
    <h1 class="px-6 text-xl text">All Users </h1><hr>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    #
                                </th>
                                <th scope="col" class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                            <?php $page=Request::get('page')-1; ?>
                        @if(count($users)>0)
                            @foreach($users as $row)
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

                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $row->name }}
                                            </div>

                                        </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $row->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($row->status==1)
                                            <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-green-600 rounded-full">Active</span>
                                        @elseif($row->status==0)
                                            <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">Deative</span>
                                        @endif
                                        @if($row->is_admin==1)
                                            <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-green-600 rounded-full">Admin</span>
                                        @elseif($row->is_admin==0)
                                            <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-blue-600 rounded-full">User</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{-- @if($row->status==0)
                                            <a href="{{ route('users.status',$row->id) }}" class="cursor-pointer inline-flex items-center h-8 px-4 m-2 text-sm text-white transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800"
                                                >aaa</a>
                                        @elseif($row->status==1)
                                            <a href="{{ route('users.status',$row->id) }}" class="cursor-pointer inline-flex items-center h-8 px-4 m-2 text-sm text-white transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800"
                                                >aaa</a>
                                        @endif --}}
                                        <form class="inline-flex items-center" action="{{route('users.status',$row->id)}}"  method="post">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            @if($row->status==0)
                                                <button type="submit" class="modal-open inline-flex items-center h-8 px-4 m-2 text-sm text-white transition-colors duration-150 bg-green-600 rounded-lg focus:shadow-outline hover:bg-green-700"
                                                >Activate</button>
                                            @elseif($row->status==1)
                                                <button type="submit" class="modal-open inline-flex items-center h-8 px-4 m-2 text-sm text-white transition-colors duration-150 bg-red-600 rounded-lg focus:shadow-outline hover:bg-red-700"
                                                >Deactivate</button>
                                            @endif
                                        </form>
                                        <form class="inline-flex items-center" action="{{route('users.admin',$row->id)}}"  method="post">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            @if($row->is_admin==0)
                                                <button type="submit" class="modal-open inline-flex items-center h-8 px-4 m-2 text-sm text-white transition-colors duration-150 bg-blue-600 rounded-lg focus:shadow-outline hover:bg-blue-700"
                                                >Admin</button>
                                            @elseif($row->is_admin==1)
                                                <button type="submit" class="modal-open inline-flex items-center h-8 px-4 m-2 text-sm text-white transition-colors duration-150 bg-green-600 rounded-lg focus:shadow-outline hover:bg-green-700"
                                                >User</button>
                                            @endif
                                        </form>


                                    </td>
                                </tr>

                            @endforeach

                            <!-- More people... -->
                        </tbody>
                    </table>
                    @else
                        <h3>No Users Available </h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{ $users->links() }}

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
