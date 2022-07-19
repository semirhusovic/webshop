<x-dashboard>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Edit manufacturer: {{$manufacturer->manufacturerName}}
        </h2>


        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{route('manufacturer.update',$manufacturer->id)}}" method="POST">
                @csrf
                @method('PUT')
                <!-- Slide title -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Manufacturer name</span>
                    <input name="manufacturerName" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Type name here" value="{{$manufacturer->manufacturerName}}">
                </label>
                <!-- End slide title -->

{{--                <!-- Slide title -->--}}
{{--                <label class="block text-sm">--}}
{{--                    <span class="text-gray-700 dark:text-gray-400">Title</span> <span class="text-red-600">[SR]</span>--}}
{{--                    <input name="sr[manufacturerName]" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Country name" value="{{$manufacturer->translations[1]->manufacturerName}}">--}}
{{--                </label>--}}
{{--                <!-- End slide title -->--}}




                <div class="my-8">
                    <button class="my-5 px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Update
                    </button>
                </div>


            </form>

        </div>



    </div>
</x-dashboard>
