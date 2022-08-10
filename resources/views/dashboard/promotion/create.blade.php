<x-dashboard>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Create new promotion
        </h2>

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

            <x-auth-validation-errors class="mb-4" :errors="$errors"/>
            {{--        new accordition    --}}
            <div class="w-full md:w-3/5 mx-auto mb-6 p-8">
                <div id='accord' class="shadow-md">

                </div>
            </div>
            {{--            new accrordition--}}
            <form action="{{route('promotion.store')}}" method="POST">
                @csrf
                {{--                2 red--}}
                <div class="flex mb-2">
                    <label class="block w-full text-sm mr-6">
                         <span class="text-gray-700 dark:text-gray-400">
                            Filter by category
                         </span>
                        <select
                            onchange="fillProducts('{{@csrf_token()}}')"
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            id="select-category" name="category[]" multiple
                            autocomplete="off">
                            {{--                            <option value="">Select a category...</option>--}}
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}"
                                        @if (!empty($filteredCategories) && in_array($category->id,$filteredCategories))
                                            selected
                                    @endif
                                >{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="block w-full text-sm mr-6">
                         <span class="text-gray-700 dark:text-gray-400">
                            Filter by specific product
                         </span>
                        <select
                            class="block w-full mt-1 text-sm dark:text-white-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            id="select-product" name="products[]" multiple
                            id="products"
                            autocomplete="off">
                            {{--                                <option value="">Select a product...</option>--}}
                            {{--                            @foreach ($products as $product)--}}
                            {{--                                <option value="{{$product->id}}"--}}
                            {{--                                        @if (!empty($filteredProductsSelect) && in_array($product->id,$filteredProductsSelect))--}}
                            {{--                                            selected--}}
                            {{--                                    @endif>{{$product->product_name}}</option>--}}
                            {{--                            @endforeach--}}
                        </select>
                    </label>
                </div>
                {{--                2 red kraj--}}

                {{--                3 red--}}
                <div class="flex mb-2">
                    <label class="block w-full text-sm mr-6">
                        <span class="text-gray-700 dark:text-gray-400">Filter by min price</span>
                        <input name="price_from" id="price_from"
                               class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                               min="1" type="number" placeholder="12">
                    </label>
                    <label class="block w-full text-sm mr-6">
                        <span class="text-gray-700 dark:text-gray-400">Filter by max price</span>
                        <input name="price_to"
                               id="price_to"
                               class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                               type="number" placeholder="12">
                    </label>
                </div>
                {{--                3 red kraj--}}

                {{--                4 red--}}
                <div class="flex mb-2">
                    <label class="block w-full text-sm mr-6">
                        <span class="text-gray-700 dark:text-gray-400">Filter by earliest manufacturing date</span>
                        <input type="date" name="manufacturingDateStart"
                               id="manufacturingDateStart"
                               class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        >
                    </label>
                    <label class="block w-full text-sm mr-6">
                        <span class="text-gray-700 dark:text-gray-400">Filter by latest manufacturing date</span>
                        <input type="date" name="manufacturingDateEnd"
                               id="manufacturingDateEnd"
                               class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        >
                    </label>
                </div>
                {{--                4 red kraj--}}


                {{--    3 red  --}}
                <div class="flex mb-2">
                    <button onclick="fd(event,'{{@csrf_token()}}')"
                            class="mt-6 w-full mr-6 md:inline-block px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        <svg class="w-4 h-4 inline-block" stroke="currentColor" stroke-width="2px"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill="#ffffff" d="M1 0h22l-9 14.094v9.906l-4-2v-7.906z"/>
                        </svg>
                        Filter
                    </button>
                </div>
                <!-- Slide title -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Promotion name</span>
                    <input value="{{old('en[category_name]')}}" name="en[promotion_name]"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="Type name here">
                </label>
                <!-- End slide title -->

                <!-- Slide title -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Promotion name </span>
                    <span class="text-red-600">[ME]</span>
                    <input value="{{old('me[category_name]')}}" name="me[promotion_name]"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="Type name here">
                </label>
                <!-- End slide title -->
                <input type="hidden" id="filteredIds" name="filteredIds">


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
                        Create
                    </button>
                </div>
            </form>
    </div>

    <script>
        new TomSelect("#select-category", {
            plugins: ['remove_button'],
            create: true,
        });
        const pds = new TomSelect("#select-product", {
            plugins: ['remove_button'],
            create: true,
            valueField: 'id',
            labelField: 'title',
        });
    </script>

    <script src="{{asset('js/fillProductsByCategory.js')}}"></script>
    <script src="{{asset('js/filterProducts.js')}}"></script>
        <script>
            /* Optional Javascript to close the radio button version by clicking it again */
            var myRadios = document.getElementsByName('tabs2');
            var setCheck;
            var x = 0;
            for(x = 0; x < myRadios.length; x++){
                myRadios[x].onclick = function(){
                    if(setCheck != this){
                        setCheck = this;
                    }else{
                        this.checked = false;
                        setCheck = null;
                    }
                };
            }
        </script>
</x-dashboard>
