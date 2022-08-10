<x-dashboard>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Edit user: {{$user->email}}
        </h2>


        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{route('user.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Slide duration -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">First Name</span>
                    <input type="text" name="first_name"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="Type here" value="{{$user->first_name}}">
                </label>
                <!-- End slide duration -->

                <!-- Slide duration -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Last Name</span>
                    <input type="text" name="last_name"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="Type here" value="{{$user->last_name}}">
                </label>
                <!-- End slide duration -->

                <!-- Slide duration -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Last Name</span>
                    <input type="email" name="email"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="Type here" value="{{$user->email}}">
                </label>
                <!-- End slide duration -->

                <!-- Slide link -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Phone number</span>
                    <input name="phone" type="tel"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="Type here" value="{{$user->phone}}">
                </label>
                <!-- End slide link -->


                <div class="mb-4">
                    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Role
                </span>
                        <select name="role_id"
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}" {{$user->role_id == $role->id ? 'selected' : ''}}>{{$role->role_name}}</option>
                            @endforeach

{{--                            <option value="0" {{$slider->isActive == 0 ? 'selected' : ''}}>Inactive</option>--}}
{{--                            <option value="1" {{$slider->isActive == 1 ? 'selected' : ''}}>Active</option>--}}
                        </select>
                    </label>
                </div>

                <div class="my-8">
                    <button
                        class="my-5 px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Update
                    </button>
                </div>

            </form>

        </div>


    </div>
</x-dashboard>
