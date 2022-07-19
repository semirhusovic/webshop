<x-app-layout>
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>

    <div class="container mx-auto lg:w-3/5">
        <div class="owl-carousel owl-theme">
            {{--            <div class="item"><img src="https://voli.me/storage/images/banner-images/1615457562baner.png" data-src="https://voli.me/storage/images/banner-images/1615457562baner.png" alt="Slide" class=""></div>--}}
            {{--            <div class="item"><a href="https://voli.me/brendovi/598/kategorije/147" target="_blank" rel="noopener"><img src="https://voli.me/storage/images/banner-images/16260897361607340257final basta2.jpg" data-src="https://voli.me/storage/images/banner-images/16260897361607340257final basta2.jpg" alt="Slide" class=""> <div class="slide-text"><span>Domaće svježe povrće.<br>Naš brend, Naša bašta!</span></div></a></div>--}}
            {{--            <div class="item"><img src="https://voli.me/storage/images/banner-images/1649226687lago%20banner.jpg" data-src="https://voli.me/storage/images/banner-images/1649226687lago%20banner.jpg" alt="Slide" class=""></div>--}}
            {{--            <div class="item"><a href="https://voli.me/proizvod/5128" target="_blank" rel="noopener"><img src="https://voli.me/storage/images/banner-images/1645776293Ferrero banner.jpg" data-src="https://voli.me/storage/images/banner-images/1645776293Ferrero banner.jpg" alt="Slide" class=""> <div class="slide-text"><span>Još uvijek ih nijeste probali? hmm...</span></div></a></div>--}}
            {{--            <div class="item">--}}
            {{--                <a href="https://voli.me/pretraga?term=xiaomi" target="_blank" rel="noopener">--}}
            {{--                    <img src="https://voli.me/storage/images/banner-images/16565845711651851304_Xiaomi-Robot-Vacuum-Mop-2S-the-robot-vacuum-cleaner-returns-at.jpg" data-src="https://voli.me/storage/images/banner-images/16565845711651851304_Xiaomi-Robot-Vacuum-Mop-2S-the-robot-vacuum-cleaner-returns-at.jpg" alt="Slide" class="">--}}
            {{--                        <div class="slide-text"><span>Xiaomi smart uređaji, klik i saznaj više.</span></div>--}}
            {{--                </a>--}}
            {{--            </div>--}}
            @foreach ($sliders as $slider)
                <div class="item">
                    <a href="{{ $slider->link}} " target="_blank" rel="noopener">
                        <img src="/public/img/{{$slider->image->fileName}}" data-src="{{$slider->image}}" alt="Slide"
                             class="">
                        <div class="slide-text"><span>{{$slider->title}}</span></div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>


{{--        <ul class="list-disc">--}}
{{--            @include('categories.subcategories', ['categories' => $categories])--}}
{{--        </ul>--}}


    {{--    Items--}}
    <div class="container w-5/6 mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

            @foreach($products as $product)
                <div>
                    <!-- COMPONENT: PRODUCT CARD -->
                    <article class="mb-4">
                        <a href="/"
                           class="rounded bg-gray-100 border border-gray-200 block relative p-1 hover:border-blue-300">
                            <img src="/public/img/{{$product->images->first()->fileName}}"
                                 class="mx-auto mix-blend-multiply w-auto max-h-64" alt="{{$product->productName}}">
                        </a>
                        <div class="pt-3">
                            <a class="float-right px-3 py-2 text-gray-400 border border-gray-300 rounded-md hover:border-teal-400 hover:text-teal-600"
                               href="/">
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                            @if($product->total_price < $product->productPrice)
                                <p class="font-semibold">{{$product->total_price}}$
                                    <del class="text-sm text-gray-500 line-through">{{$product->productPrice}}$</del>
                                </p>
                            @else
                                <p class="font-semibold">{{$product->productPrice}}$</p>
                            @endif
                            <h6>
                                <a href="" class="text-gray-600 hover:text-blue-500">
                                    {{$product->productName}}
                                </a>
                            </h6>
                            <small class="text-sm text-gray-400"> {{$product->productDescription}}</small>
                        </div>
                    </article>
                    <!-- COMPONENT: PRODUCT CARD //END -->
                </div>
            @endforeach
        </div>
    </div>
    {{--    End items--}}


    <script>

        $('.owl-carousel').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            margin: 150,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })
    </script>
</x-app-layout>
