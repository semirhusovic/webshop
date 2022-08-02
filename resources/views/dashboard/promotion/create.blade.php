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
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            id="select-category" name="category[]" multiple
                            autocomplete="off">
                            {{--                            <option value="">Select a category...</option>--}}
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}"
                                        @if (!empty($filteredCategories) && in_array($category->id,$filteredCategories))
                                            selected
                                    @endif
                                >{{$category->categoryName}}</option>
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
                            @foreach ($products as $product)
                                <option value="{{$product->id}}"
                                        @if (!empty($filteredProductsSelect) && in_array($product->id,$filteredProductsSelect))
                                            selected
                                    @endif>{{$product->productName}}</option>
                            @endforeach
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
                    <button onclick="fd(event,'{{@csrf_token()}}')" class=" w-full mr-6 md:inline-block px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        <svg class="w-4 h-4 inline-block" stroke="currentColor" stroke-width="2px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="#ffffff" d="M1 0h22l-9 14.094v9.906l-4-2v-7.906z"/></svg>
                        Filter</button>
                </div>
                <!-- Slide title -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Promotion name</span>
                    <input value="{{old('en[categoryName]')}}" name="en[promotionName]"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="Type name here">
                </label>
                <!-- End slide title -->

                <!-- Slide title -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Promotion name </span>
                    <span class="text-red-600">[SR]</span>
                    <input value="{{old('sr[categoryName]')}}" name="sr[promotionName]"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           placeholder="Type name here">
                </label>
                <!-- End slide title -->

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
{{--                                    value="{{$category->id}}" {{ old('$category_id' == $category->id ? 'selected' : '')}}>{{$category->categoryName}}</option>--}}
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
{{--                                <option value="{{$category->id}}">{{$category->categoryName}}</option>--}}
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
{{--                                <option value="{{$product->id}}">{{$product->productName}}</option>--}}
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
{{--                                    value="{{$manufacturer->id}}" {{ old('manufacturer_id' == $manufacturer->id ? 'selected' : '')}}>{{$manufacturer->manufacturerName}}</option>--}}
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

    <script>
    const fd = (e,csrf_token) => {
        e.preventDefault()
        let category = [...document.getElementById("select-category").options].filter(option => option.selected).map(option => option.value)
        let products = [...document.getElementById("select-product").options].filter(option => option.selected).map(option => option.value)
        // let products =  document.getElementById("select-product").value;
        let price_from =  document.getElementById("price_from").value;
        let price_to =  document.getElementById("price_to").value;
        let manufacturingDateStart =  document.getElementById("manufacturingDateStart").value;
        let manufacturingDateEnd =  document.getElementById("manufacturingDateEnd").value;
        const data = {
            category,
            products,
            price_from,
            price_to,
            manufacturingDateStart,
            manufacturingDateEnd,
        };

        fetch('/dashboard/promotion/filter-products',{method: 'POST', // or 'PUT'
            headers: {
                'X-CSRF-TOKEN': csrf_token,
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        }).then((response) => response.json())
            .then((data) => {
                console.log('Success:', data);
                fillTable(data);
            })
            .catch((error) => {
                console.error('Error:', error);
            });

    }
    const fillTable = (data) => {
        // data.lenght == 0 ?document.getElementById('products-table').classList.toggle("hidden");
        // data.lenght === 0 ?  document.getElementById('products-table').classList.add('hidden')
        if(data.length > 0) {
            document.getElementById('products-table').classList.remove('hidden')
        }

        let rows = '';
        data.forEach(element => {
            rows = rows + `<tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <!-- Avatar with inset shadow -->
                                                <div class="relative hidden w-10 h-8 mr-3 rounded-full md:block">
                                                    <img class="object-cover w-full h-full " src="/public/img/${element.images[0].fileName} " alt="" loading="lazy">
                                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                </div>
                                                <div>
                                                    <p class="font-semibold">${element.productName}</p>
                                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                                        ${element.productName}
            </p>
        </div>
    </div>
</td>
<td class="px-4 py-3 text-xs">
     <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100 rounded-full">
${element.total_price}
            </span>
       </td>
       <td class="px-4 py-3 text-sm">
${element.manufacturer.manufacturerName}
            </td>
        </tr>`;

            document.getElementById('tbody').innerHTML = rows;
        })

    }
    </script>
</x-dashboard>
