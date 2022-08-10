<x-dashboard>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Create new promotion
        </h2>

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

            <x-auth-validation-errors class="mb-4" :errors="$errors"/>
            <form class="form-inline" method="GET">
                <div id="products-table" class="hidden w-full overflow-hidden rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">Title</th>
                                <th class="px-4 py-3">Price</th>
                                <th class="px-4 py-3">Manufacturer</th>
                            </tr>
                            </thead>
                            <tbody id="tbody" class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                            </tbody>
                        </table>
                    </div>
                </div>
                {{--                aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa--}}

            </form>


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

                {{--                <div class="mb-4">--}}
                {{--                    <label class="block mt-4 text-sm">--}}
                {{--                <span class="text-gray-700 dark:text-gray-400">--}}
                {{--                  Parent category--}}
                {{--                </span>--}}
                {{--                        <select name="category_id"--}}
                {{--                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">--}}
                {{--                            <option></option>--}}
                {{--                            @foreach($categories as $category)--}}
                {{--                                <option--}}
                {{--                                    value="{{$category->id}}" {{ old('$category_id' == $category->id ? 'selected' : '')}}>{{$category->category_name}}</option>--}}
                {{--                            @endforeach--}}
                {{--                        </select>--}}
                {{--                    </label>--}}
                {{--                </div>--}}

                {{--                <div class="mb-4">--}}
                {{--                    <label class="block mt-4 text-sm">--}}
                {{--                         <span class="text-gray-700 dark:text-gray-400">--}}
                {{--                            Choose category--}}
                {{--                         </span>--}}
                {{--                        <select--}}
                {{--                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"--}}
                {{--                            id="select-category" name="category[]" multiple--}}
                {{--                            autocomplete="off">--}}
                {{--                            --}}{{--                        <option value="">Select a category...</option>--}}
                {{--                            @foreach ($categories as $category)--}}
                {{--                                <option value="{{$category->id}}">{{$category->category_name}}</option>--}}
                {{--                            @endforeach--}}
                {{--                        </select>--}}
                {{--                    </label>--}}
                {{--                </div>--}}

                {{--                <div class="mb-4">--}}
                {{--                    <label class="block mt-4 text-sm">--}}
                {{--                         <span class="text-gray-700 dark:text-gray-400">--}}
                {{--                            Choose products--}}
                {{--                         </span>--}}
                {{--                        <select--}}
                {{--                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"--}}
                {{--                            id="select-product" name="products[]" multiple--}}
                {{--                            autocomplete="off">--}}
                {{--                            --}}{{--                        <option value="">Select a category...</option>--}}
                {{--                            @foreach ($products as $product)--}}
                {{--                                <option value="{{$product->id}}">{{$product->product_name}}</option>--}}
                {{--                            @endforeach--}}
                {{--                        </select>--}}
                {{--                    </label>--}}
                {{--                </div>--}}

                {{--                <div class="mb-4">--}}
                {{--                    <label class="block mt-4 text-sm">--}}
                {{--                <span class="text-gray-700 dark:text-gray-400">--}}
                {{--                  Choose manufacturer--}}
                {{--                </span>--}}
                {{--                        <select name="manufacturer"--}}
                {{--                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">--}}
                {{--                            <option></option>--}}
                {{--                            @foreach($manufacturers as $manufacturer)--}}
                {{--                                <option--}}
                {{--                                    value="{{$manufacturer->id}}" {{ old('manufacturer_id' == $manufacturer->id ? 'selected' : '')}}>{{$manufacturer->manufacturer_name}}</option>--}}
                {{--                            @endforeach--}}
                {{--                        </select>--}}
                {{--                    </label>--}}
                {{--                </div>--}}


                <!-- Price from -->
                {{--                <label class="block text-sm">--}}
                {{--                    <span class="text-gray-700 dark:text-gray-400">Min price</span>--}}
                {{--                    <input name="price_from"--}}
                {{--                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"--}}
                {{--                           placeholder="12">--}}
                {{--                </label>--}}
                <!-- End price from -->

                <!-- Price to -->
                {{--                <label class="block text-sm">--}}
                {{--                    <span class="text-gray-700 dark:text-gray-400">Max price</span>--}}
                {{--                    <input name="price_to"--}}
                {{--                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"--}}
                {{--                           placeholder="12">--}}
                {{--                </label>--}}
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
                        Create
                    </button>
                </div>


            </form>
            {{-- accordition --}}
{{--            <div class="accordion" id="accordionExample">--}}
{{--                <div class="accordion-item bg-white border border-gray-200">--}}
{{--                    <h2 class="accordion-header mb-0" id="headingOne">--}}
{{--                        <button class="--}}
{{--        accordion-button--}}
{{--        relative--}}
{{--        flex--}}
{{--        items-center--}}
{{--        w-full--}}
{{--        py-4--}}
{{--        px-5--}}
{{--        text-base text-gray-800 text-left--}}
{{--        bg-white--}}
{{--        border-0--}}
{{--        rounded-none--}}
{{--        transition--}}
{{--        focus:outline-none--}}
{{--      " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"--}}
{{--                                aria-controls="collapseOne">--}}
{{--                            Accordion Item #1--}}
{{--                        </button>--}}
{{--                    </h2>--}}
{{--                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"--}}
{{--                         data-bs-parent="#accordionExample">--}}
{{--                        <div class="accordion-body py-4 px-5">--}}
{{--                            // code here--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="accordion-item bg-white border border-gray-200">--}}
{{--                    <h2 class="accordion-header mb-0" id="headingTwo">--}}
{{--                        <button class="--}}
{{--        accordion-button--}}
{{--        collapsed--}}
{{--        relative--}}
{{--        flex--}}
{{--        items-center--}}
{{--        w-full--}}
{{--        py-4--}}
{{--        px-5--}}
{{--        text-base text-gray-800 text-left--}}
{{--        bg-white--}}
{{--        border-0--}}
{{--        rounded-none--}}
{{--        transition--}}
{{--        focus:outline-none--}}
{{--      " type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"--}}
{{--                                aria-controls="collapseTwo">--}}
{{--                            Accordion Item #2--}}
{{--                        </button>--}}
{{--                    </h2>--}}
{{--                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"--}}
{{--                         data-bs-parent="#accordionExample">--}}
{{--                        <div class="accordion-body py-4 px-5">--}}
{{--                            <strong>This is the second item's accordion body.</strong> It is hidden by default,--}}
{{--                            until the collapse plugin adds the appropriate classes that we use to style each--}}
{{--                            element. These classes control the overall appearance, as well as the showing and--}}
{{--                            hiding via CSS transitions. You can modify any of this with custom CSS or overriding--}}
{{--                            our default variables. It's also worth noting that just about any HTML can go within--}}
{{--                            the <code>.accordion-body</code>, though the transition does limit overflow.--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        {{-- end accordition --}}


{{--        new accordition    --}}
            <div class="w-full md:w-3/5 mx-auto p-8">
                <div class="shadow-md">
                    <div class="tab w-full overflow-hidden border-t">
                        <input class="absolute opacity-0 " id="tab-multi-one" type="checkbox" name="tabs">
                        <label class="block p-5 leading-normal cursor-pointer" for="tab-multi-one">First filter</label>
                        <div class="tab-content overflow-hidden border-l-2 bg-gray-100 border-indigo-500 leading-normal">
                            <div id="products-table" class="w-full overflow-hidden rounded-lg shadow-xs">
                                <div class="w-full overflow-x-auto">
                                    <table class="w-full whitespace-no-wrap">
                                        <thead>
                                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                            <th class="px-4 py-3">Title</th>
                                            <th class="px-4 py-3">Price</th>
                                            <th class="px-4 py-3">Manufacturer</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tbody" class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"><tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3">
                                                <div class="flex items-center text-sm">
                                                    <!-- Avatar with inset shadow -->
                                                    <div class="relative hidden w-10 h-8 mr-3 rounded-full md:block">
                                                        <img class="object-cover w-full h-full " src="/public/img/2022080512002.jpg " alt="" loading="lazy">
                                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold">Buffy Davis</p>
                                                        <p class="text-xs text-gray-600 dark:text-gray-400">Buffy Davis</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-xs">
     <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100 rounded-full">
727.00
            </span>
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                Samsung
                                            </td>
                                        </tr><tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3">
                                                <div class="flex items-center text-sm">
                                                    <!-- Avatar with inset shadow -->
                                                    <div class="relative hidden w-10 h-8 mr-3 rounded-full md:block">
                                                        <img class="object-cover w-full h-full " src="/public/img/2022080512051.jpg " alt="" loading="lazy">
                                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold">Test edit</p>
                                                        <p class="text-xs text-gray-600 dark:text-gray-400">Test edit</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-xs">
     <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100 rounded-full">
876.00
            </span>
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                Xiaomi
                                            </td>
                                        </tr><tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3">
                                                <div class="flex items-center text-sm">
                                                    <!-- Avatar with inset shadow -->
                                                    <div class="relative hidden w-10 h-8 mr-3 rounded-full md:block">
                                                        <img class="object-cover w-full h-full " src="/public/img/202208081447mi-11-lite-5g-1417-300x300.jpg.webp " alt="" loading="lazy">
                                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold">Xiaomi Mi 11 Lite 5g</p>
                                                        <p class="text-xs text-gray-600 dark:text-gray-400">Xiaomi Mi 11 Lite 5g</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-xs">
     <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100 rounded-full">
150.00
            </span>
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                Apple
                                            </td>
                                        </tr></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab w-full overflow-hidden border-t">
                        <input class="absolute opacity-0" id="tab-multi-two" type="checkbox" name="tabs">
                        <label class="block p-5 leading-normal cursor-pointer" for="tab-multi-two">Label Two</label>
                        <div class="tab-content overflow-hidden border-l-2 bg-gray-100 border-indigo-500 leading-normal">
                            <p class="p-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, architecto, explicabo perferendis nostrum, maxime impedit atque odit sunt pariatur illo obcaecati soluta molestias iure facere dolorum adipisci eum? Saepe, itaque.</p>
                        </div>
                    </div>
                    <div class="tab w-full overflow-hidden border-t">
                        <input class="absolute opacity-0" id="tab-multi-three" type="checkbox" name="tabs">
                        <label class="block p-5 leading-normal cursor-pointer" for="tab-multi-three">Label Three</label>
                        <div class="tab-content overflow-hidden border-l-2 bg-gray-100 border-indigo-500 leading-normal">
                            <p class="p-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, architecto, explicabo perferendis nostrum, maxime impedit atque odit sunt pariatur illo obcaecati soluta molestias iure facere dolorum adipisci eum? Saepe, itaque.</p>
                        </div>
                    </div>
                </div>
            </div>
{{--            new accrordition--}}
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
