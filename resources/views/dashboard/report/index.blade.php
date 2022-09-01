<x-dashboard>
    <div class="container px-6 mx-auto grid">
        <h2
            class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
        >
            Reports
        </h2>

        <x-bladewind.tab-group name="free-pics" color="purple">

            <x-slot name="headings">
                <x-bladewind.tab-heading
                    name="unsplash-1" active="true" label="Users" ></x-bladewind.tab-heading>

                <x-bladewind.tab-heading
                    name="unsplash-2" label="Countries" ></x-bladewind.tab-heading>

                <x-bladewind.tab-heading
                    name="unsplash-3" label="Stock" ></x-bladewind.tab-heading>

                <x-bladewind.tab-heading
                    name="unsplash-4" label="Manufacturers" ></x-bladewind.tab-heading>
            </x-slot>

            <x-bladewind.tab-body>

                <x-bladewind.tab-content name="unsplash-1" active="true">
                    <form>
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
                                                                <option value="">Select a category...</option>
{{--                                    @foreach ($categories as $category)--}}
{{--                                        <option value="{{$category->id}}"--}}
{{--                                                @if (!empty($filteredCategories) && in_array($category->id,$filteredCategories))--}}
{{--                                                    selected--}}
{{--                                            @endif--}}
{{--                                        >{{$category->category_name}}</option>--}}
{{--                                    @endforeach--}}
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
                                <i class="fa-solid fa-file-excel"></i>
                                Export
                            </button>
                        </div>
                    </form>
                </x-bladewind.tab-content>

                <x-bladewind.tab-content name="unsplash-2">
                    <p class="font-semibold text-gray-700 dark:text-gray-200">Countries</p>
                        <x-bladewind.timeline
                            date="18-JUL"
                            color="purple"
                            label="You signed up"
                            status="completed"
                            stacked="true"/>

                        <x-bladewind.timeline
                            date="19-JUL"
                            color="purple"
                            label="Customer rep assigned"
                            status="completed"
                            stacked="true"/>

                        <x-bladewind.timeline
                            date="20-JUL"
                            color="purple"
                            label="Customer rep called"
                            status="completed"
                            stacked="true" />

                        <x-bladewind.timeline
                            date=""
                            color="purple"
                            label="Account is being reviewed"
                            stacked="true"/>

                        <x-bladewind.timeline
                            date=""
                            color="purple"
                            label="Account activated"
                            stacked="true"
                            last="true" />
                </x-bladewind.tab-content>

                <x-bladewind.tab-content name="unsplash-3">
                    <p class="font-semibold text-gray-700 dark:text-gray-200">Stock</p>
                </x-bladewind.tab-content>

                <x-bladewind.tab-content name="unsplash-4">
                    <p class="font-semibold text-gray-700 dark:text-gray-200">Manufacturers</p>
                </x-bladewind.tab-content>

            </x-bladewind.tab-body>

        </x-bladewind.tab-group>


    </div>
</x-dashboard>
