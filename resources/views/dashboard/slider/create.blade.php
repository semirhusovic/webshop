<x-dashboard>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Create new slider
        </h2>

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

            <x-auth-validation-errors class="mb-4" :errors="$errors"/>

            <form action="{{route('slider.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Slide title -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Title</span>
                    <input value="{{old('title')}}" name="en[title]"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="Slide name">
                </label>
                <!-- End slide title -->

                <!-- Slide title -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Title </span> <span class="text-red-600">[SR]</span>
                    <input value="{{old('title')}}" name="sr[title]"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="Slide name">
                </label>
                <!-- End slide title -->

                <!-- Slide duration -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Duration</span>
                    <input value="{{old('duration')}}" type="number" min="1" max="15" name="duration"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="3">
                </label>
                <!-- End slide duration -->

                <!-- Slide link -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Link</span>
                    <input value="{{old('link')}}" name="link"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="http://www.google.com">
                </label>
                <!-- End slide link -->

                <!-- Slide position -->
                <div class="mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Slide position
                </span>
                    <div class="mt-2">
                        <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                            <input type="radio"
                                   class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                   name="order" value="1" {{old('order') == 1 ? 'checked' : ''}}>
                            <span class="ml-2">1</span>
                        </label>
                        <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                            <input type="radio"
                                   class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                   name="order" value="2" {{old('order') == 2 ? 'checked' : ''}}>
                            <span class="ml-2">2</span>
                        </label>
                        <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                            <input type="radio"
                                   class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                   name="order" value="3" {{old('order') == 3 ? 'checked' : ''}}>
                            <span class="ml-2">3</span>
                        </label>
                        <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                            <input type="radio"
                                   class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                   name="order" value="4" {{old('order') == 4 ? 'checked' : ''}}>
                            <span class="ml-2">4</span>
                        </label>
                        <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                            <input type="radio"
                                   class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                   name="order" value="5" {{old('order') == 5 ? 'checked' : ''}}>
                            <span class="ml-2">5</span>
                        </label>
                    </div>
                </div>
                <!-- End slide position -->

                <div class="mb-4">
                    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Activate slide
                </span>
                        <select name="isActive"
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option value="0" {{ old('isActive' == 0 ? 'selected' : '')}}>Inactive</option>
                            <option value="1" {{ old('isActive' == 1 ? 'selected' : '')}}>Active</option>
                        </select>
                    </label>
                </div>


                <div class="my-5 text-sm">
                    <label class="flex items-center dark:text-gray-400">Choose an image</label>
                    <input type="file" accept=".jpg,.jpeg,.png,"
                           class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           required name="image">
                </div>


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
