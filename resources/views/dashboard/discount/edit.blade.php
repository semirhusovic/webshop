<x-dashboard>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Edit discount: {{$discount->value.' - '.$discount->type.' - Valid until - '.$discount->expired_at}}
        </h2>


        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{route('discount.update',$discount->id)}}" method="POST">
                @csrf
                @method('PUT')
                <!-- Slide title -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Discount value</span>
                    <input value="{{$discount->value}}" name="value"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="Type value here">
                </label>
                <!-- End slide title -->

                <div class="mb-4">
                    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Discount type
                </span>
                        <select name="type"
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option></option>
                            <option value="percentage" {{ $discount->type === 'percentage' ? 'selected' : ''}}>Percentage</option>
                            <option value="percentage" {{ $discount->type === 'numeric' ? 'selected' : ''}}>Numeric</option>
                        </select>
                    </label>
                </div>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Valid until</span>
                    <input type="date" name="expired_at" value="{{$discount->expired_at}}"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                </label>


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
