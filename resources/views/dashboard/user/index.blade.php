<x-dashboard>
    <div class="container px-6 mx-auto grid">
        <h2
            class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
        >
            User
        </h2>
        <div class="flex flex-row justify-around">
            <form method="GET">
                <div class="flex mb-2">
                    <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
                        <div class="absolute inset-y-0 flex items-center pl-2">
                            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input value="{{$filter}}" class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text" placeholder="Search for users" aria-label="Search" name="filter">
                    </div>
                    <button type="submit" class="md:inline-block px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Search</button>
                </div>
            </form>

            <a href="{{route('users.export')}}" class="w-fit ml-4 mb-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Export</a>
            <form id="import-data" class="p-0" action="{{route('users.import')}}" method="POST" enctype='multipart/form-data'>
                @csrf

                <button type="button" onclick="event => event.preventDefault()" class="px-4 ml-4 mb-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    <label for="import-file">
                    Import
                    </label>
                </button>
                    <input id="import-file" onchange="confirmImport(event)" type="file" class="hidden" name="import-file" />
            </form>
        </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Role</th>
{{--                    <th class="px-4 py-3">Date</th>--}}
                    <th class="px-4 py-3">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @if(count($users) == 0)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td colspan="5" class="px-4 py-3">
                            <div class="mx-auto">
                                <p class="font-semibold mx-auto text-center">No results found</p>
                            </div>
                        </td>
                    </tr>
                @endif
                @foreach($users as $user)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div>
                                    <p class="font-semibold">{{$user->first_name. ' ' .$user->last_name}}</p>
{{--                                    <p class="text-xs text-gray-600 dark:text-gray-400">--}}
{{--                                        {{$user->last_name}}--}}
{{--                                    </p>--}}
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$user->email}}
                        </td>
{{--                        <td class="px-4 py-3 text-xs">--}}
{{--                        <span class="px-2 py-1 font-semibold leading-tight {{ $slide->isActive ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100' }} rounded-full">--}}
{{--                          {{$slide->isActive ? 'Active' : 'Inactive'}}--}}
{{--                        </span>--}}
{{--                        </td>--}}
                        <td class="px-4 py-3 text-sm">
                            {{$user->role->role_name}}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <a href="{{route('user.edit',$user->id)}}" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </a>
                                <form id="delete{{$user->id}}" method="post" action="{{route('user.destroy',$user->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(event,{{$user->id.','. "'".$user->first_name."'"}})" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
        {{ $users->links('vendor.pagination.custom-pagination') }}
    </div>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{asset('js/confirmDelete.js')}}"></script>
        <script>
            function confirmImport(e){
                    e.preventDefault();
                    // document.getElementById('import-data').submit();
                    console.log(e);
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You will not be able to restore this insert",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#7e3af2',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, insert data!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                                document.getElementById('import-data').submit();
                        }
                    })
            }
        </script>
</x-dashboard>
