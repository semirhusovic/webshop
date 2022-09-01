<x-dashboard>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Create new color
        </h2>

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

            <x-auth-validation-errors class="mb-4" :errors="$errors"></x-auth-validation-errors>

            <form action="{{route('color.store')}}" method="POST">
                @csrf

                <!-- Slide title -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Color*</span>
                    <input value="{{old('en[color_name]')}}" name="en[color_name]"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="Type here">
                </label>
                <!-- End slide title -->

                <!-- Slide title -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Color*</span>
                    <span class="text-red-600">[ME]</span>
                    <input value="{{old('me[color_name]')}}" name="me[color_name]"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="Type here">
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Color hexcode</span>
                    <input type="color" value="{{old('hexcode')}}" name="hexcode"
                           class="block w-2/4 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray"
                           placeholder="Type here">
                </label>
                <!-- End slide title -->

                <div class="my-8">
                    <button
                        class="my-5 px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Create
                    </button>
                </div>


            </form>

        </div>


    </div>
</x-dashboard>