<x-dashboard>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Edit promotion: {{$promotion->promotionName}}
        </h2>


        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{route('promotion.update',$promotion->id)}}" method="POST">
                @csrf
                @method('PUT')
                <!-- Slide title -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Promotion name</span>
                    <input name="en[promotionName]"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="Type name here"
                           value="{{$promotion->translations[0]->promotionName}}">
                </label>
                <!-- End slide title -->

                <!-- Slide title -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Promotion name </span>
                    <span class="text-red-600">[SR]</span>
                    <input name="sr[promotionName]"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="Type name here"
                           value="{{$promotion->translations[1]->promotionName}}">
                </label>
                <!-- End slide title -->


                <div class="mb-4">
                    <label class="block mt-4 text-sm">
                         <span class="text-gray-700 dark:text-gray-400">
                            Choose category
                         </span>
                        <select
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            id="select-category" name="category[]" multiple
                            autocomplete="off">

                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->categoryName}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>

                <div class="mb-4">
                    <label class="block mt-4 text-sm">
                         <span class="text-gray-700 dark:text-gray-400">
                            Choose products
                         </span>
                        <select
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            id="select-product" name="products[]" multiple
                            autocomplete="off">
                            @foreach ($products as $product)
                                <option value="{{$product->id}}">{{$product->productName}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>

                <div class="mb-4">
                    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Choose manufacturer
                </span>
                        <select name="manufacturer"
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option></option>
                            @foreach($manufacturers as $manufacturer)
                                <option
                                    value="{{$manufacturer->id}}" {{ $promotion->manufacturer == $manufacturer->id ? 'selected' : ''}}>{{$manufacturer->manufacturerName}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>


                <!-- Price from -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Product price min</span>
                    <input name="price_from"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="12">
                </label>
                <!-- End price from -->

                <!-- Price to -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Product price max</span>
                    <input name="price_to"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="12">
                </label>
                <!-- End price to -->

                <div class="mb-4">
                    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Apply discount
                </span>
                        <select name="discount"
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option></option>
                            @foreach($discounts as $discount)
                                <option
                                    value="{{$discount->id}}" {{ old('discount' == $discount->id ? 'selected' : '')}}>{{$discount->value.' - '.$discount->type.' - Valid until - '.$discount->expired_at}}</option>
                            @endforeach
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


        <script>
            new TomSelect("#select-category", {
                plugins: ['remove_button'],
                create: true,
            });
            new TomSelect("#select-product", {
                plugins: ['remove_button'],
                create: true,
            });
        </script>
    </div>
</x-dashboard>
