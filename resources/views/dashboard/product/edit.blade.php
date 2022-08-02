<x-dashboard>
    <div class="container px-6 mx-auto grid my-4">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Edit product : {{$product->productName}}
        </h2>

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- title -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Product name</span>
                    <input name="en[productName]"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="Product 1"
                           value="{{$product->translations[0]->productName}}">
                </label>


                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Product name</span>
                    <span class="text-red-600">[ME]</span>
                    <input name="me[productName]"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="Product 1"
                           value="{{$product->translations[1]->productName}}">
                </label>
                <!--title -->

                <!-- Price -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Product price</span>
                    <input name="productPrice"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="12"
                           value="{{$product->productPrice}}">
                </label>
                <!-- End price -->

                <!-- Discount price -->
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
                                    value="{{$discount->id}}"
                                    @if($product->discounts->first() && $product->discounts->first()->id === $discount->id) selected @endif
                                >{{$discount->value.' - '.$discount->type.' - Valid until - '.$discount->expired_at}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <!-- End discount price -->

                <!-- Description -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Product description</span>
                    <textarea name="en[productDescription]" rows="6"
                              class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                              placeholder="Description of your product">{{$product->translations[0]->productDescription}}</textarea>
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Product description</span>
                    <span class="text-red-600">[ME]</span>
                    <textarea name="me[productDescription]" rows="6"
                              class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                              placeholder="Description of your product">{{$product->translations[1]->productDescription}}</textarea>
                </label>
                <!-- End discount price -->

                <!-- Slide link -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Manufacturing date</span>
                    <input type="date" name="productManufacturingDate"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="24"
                    value="{{$product->productManufacturingDate}}">
                </label>
                <!-- End slide link -->


                <!-- Slide link -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Months of warrancy</span>
                    <input name="productMonthsOfWarranty"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="24"
                           value="{{$product->productMonthsOfWarranty}}">
                </label>
                <!-- End slide link -->

                <div class="mb-4">
                    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Choose country
                </span>
                        <select name="country_id"
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option></option>
                            @foreach($countries as $country)
                                <option
                                    value="{{$country->id}}" {{ $product->country_id == $country->id ? 'selected' : ''}}>{{$country->countryName}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <div>
                    <label class="block mt-4 text-sm">
                         <span class="text-gray-700 dark:text-gray-400">
                  Choose category
                </span>
                        <select
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            id="select-category" name="category[]" multiple
                            autocomplete="off">
                            @foreach ($product->categories as $ct)
                                <option value="{{$ct->id}}" selected>{{$ct->categoryName}}</option>
                            @endforeach
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->categoryName}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>


                <div class="mb-4">
                    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Choose manufacturer
                </span>
                        <select name="manufacturer_id"
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option></option>
                            @foreach($manufacturers as $manufacturer)
                                <option
                                    value="{{$manufacturer->id}}" {{ $product->manufacturer_id == $manufacturer->id ? 'selected' : ''}}>{{$manufacturer->manufacturerName}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>

                <div class="flex space-x-4">
                    @foreach($product->images as $image)
                        <div class="rounded h-96">
                            <img class="object-fill h-64 w-64" src="/public/img/{{$image->fileName}}" alt=""
                                 loading="lazy">
                        </div>
                    @endforeach
                </div>

                <!-- Drop upload -->
                <div style="margin-top: 1rem; " class="my-5 flex justify-center items-center w-full">
                    <label for="dropzone-file"
                           class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col justify-center items-center pt-5 pb-6">
                            <svg class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span>
                                or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                800x400px)</p>
                        </div>
                        <input name=image[] id="dropzone-file" type="file" multiple="multiple" class="hidden"/>
                    </label>
                </div>
                <!-- End drop upload -->

                <button style="margin-top: 1rem; "
                        class="my-5 px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Update
                </button>

            </form>
        </div>
    </div>
    <script>
        new TomSelect("#select-category", {
            plugins: ['remove_button'],
            create: true,
        });
    </script>
</x-dashboard>
