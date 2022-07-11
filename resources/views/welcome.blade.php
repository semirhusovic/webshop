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
                        <img src="/public/img/{{$slider->image->fileName}}" data-src="{{$slider->image}}" alt="Slide" class="">
                        <div class="slide-text"><span>{{$slider->title}}</span></div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>


    <ul class="list-disc">
        @include('categories.subcategories', ['categories' => $categories])
    </ul>




    <script>

        $('.owl-carousel').owlCarousel({
            loop:true,
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            margin:150,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        })
    </script>
</x-app-layout>
