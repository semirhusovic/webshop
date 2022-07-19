<x-dashboard>
    <div class="container px-6 mx-auto grid">
        <h2
            class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
        >
            All items from: {{$promotion->promotionName}}
        </h2>

        @foreach($promotion->discounts as $discount)
            @if($discount->expired_at > date('Y-m-d H:i:s') )
                <div class="my-6 flex items-center bg-purple-600 text-white text-sm font-bold px-4 py-3 rounded" role="alert">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
                    </svg>
                    <p>This promotion has active discount for
                        <span>
                            @if($discount->type === 'numeric')
                            {{$discount->value. '$'}}
                            @else
                            {{$discount->value. '%'}}
                            @endif
                        </span>
                        that expires at
                        : {{Carbon\Carbon::parse($discount->expired_at)->format('d-m-Y H:i:s')}}</p>
                </div>
            @endif
        @endforeach

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Manufacturer</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                    @foreach($promotion->products as $product)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->
                                    <div class="relative hidden w-10 h-8 mr-3 rounded-full md:block">
                                        <img class="object-cover w-full h-full "
                                             src="/public/img/{{$product->images->first()->fileName}} " alt=""
                                             loading="lazy">
                                        <div class="absolute inset-0 rounded-full shadow-inner"
                                             aria-hidden="true"></div>
                                    </div>
                                    <div>
                                        <p class="font-semibold">{{$product->title}}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            {{$product->productName}}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{$product->manufacturer->manufacturerName}}
                            </td>
                            <td class="px-4 py-3 text-xs">
                        <span
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100 rounded-full">
                          {{$product->total_price.'$'}}
                        </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{$product->productManufacturingDate}}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <form method="post"
                                          action="{{route('remove-promotion-product',['promotion' =>$promotion->id , 'product' => $product->id])}}">
                                        @csrf
                                        <button
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Delete">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                      d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</x-dashboard>
