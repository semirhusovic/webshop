<x-dashboard>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Create new item stock
        </h2>

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

            <x-auth-validation-errors class="mb-4" :errors="$errors"></x-auth-validation-errors>

            <form action="{{route('stock.store')}}" method="POST">
                @csrf

                <!-- Slide title -->
                <label class="block w-full text-sm mr-6">
                         <span class="text-gray-700 dark:text-gray-400">
                            Chose product
                         </span>
                    <select
                        class="block w-full mt-1 text-sm dark:text-white-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                        id="select-product" name="product_id"
                        autocomplete="off">
                        <option value="">Select a product...</option>
                        @foreach ($products as $product)
                            <option value="{{$product->id}}">{{$product->product_name}}</option>
                        @endforeach
                    </select>
                </label>
                <!-- End slide title -->

                <div class="mb-4">
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Choose size</span>
                        <select name="size_id"
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option value=""></option>
                            @foreach($sizes as $size)
                                <option value="{{$size->id}}">{{$size->size_name}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>


                <div class="mb-4">
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Choose color</span>
                        <select name="color_id"
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option value=""></option>
                            @foreach($colors as $color)
                                <option value="{{$color->id}}">{{$color->color_name}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>


                <!-- Slide duration -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Available quantity</span>
                    <input value="{{old('quantity')}}" type="number" min="1" name="quantity"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="3">
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Unit of measure</span>
                    <input value="{{old('unit_of_measure')}}" name="unit_of_measure"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="Type here">
                </label>

    <div class="my-8">
        <button
            class="my-5 px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Create
        </button>
    </div>


    </form>
<script>
    new TomSelect("#select-product", {
        plugins: ['remove_button'],
        create: true,
        maxItems:1
    });
</script>
    </div>


    </div>
</x-dashboard>
