<header class="bg-white py-3 border-b">
    <div class="container max-w-screen-xl mx-auto px-4">
        <div class="flex flex-wrap items-center">

            <div class="flex-shrink-0 mr-5">
                <a href="/"> <img src="https://www.mojposao.me/administracija/logo/amplitudo%20logo.png" style="max-height: 40px" height="90px" width="auto" alt="Brand"> </a>
            </div>

            <!-- Search -->
            <div class="flex flex-nowrap items-center w-full order-last md:order-none mt-5 md:mt-0 md:w-2/4 lg:w-2/4">
                <input class="flex-grow appearance-none border border-gray-200 bg-gray-100 rounded-md mr-2 py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400" type="text" placeholder="Search">
                <button type="button" class="px-4 py-2 inline-block text-white border border-transparent bg-teal-400 rounded-md hover:bg-teal-600">
                    <i class="fa fa-search"></i>
                </button>
            </div>
            <!-- Search .//end -->

            <!-- Actions -->
            <div class="flex items-center space-x-2 ml-auto">
                @if(auth()->check())
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                    <button type="submit" class="px-3 py-2 inline-block text-center text-gray-700 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100 hover:border-gray-300">
                        <i class="text-gray-400 w-5 fa fa-user"></i>
                        <span class="hidden lg:inline ml-1">Logout</span>
                    </button>
                    </form>
                @else
                    <a class="px-3 py-2 inline-block text-center text-gray-700 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100 hover:border-gray-300" href="{{route('login')}}">
                        <i class="text-gray-400 w-5 fa fa-user"></i>
                        <span class="hidden lg:inline ml-1">Sign in</span>
                    </a>
                @endif

                <a class="px-3 py-2 inline-block text-center text-gray-700 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100 hover:border-gray-300" href="#">
                    <i class="text-gray-400 w-5 fa fa-heart"></i>
                    <span class="hidden lg:inline ml-1">Wishlist</span>
                </a>

                <a class="px-3 py-2 inline-block text-center text-gray-700 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100 hover:border-gray-300" href="{{route('cart')}}">
                    <i class="text-gray-400 w-5 fa fa-shopping-cart"></i>
                    <span class="hidden lg:inline ml-1">My cart</span>
                </a>
            </div>
            <!-- Actions .//end -->

            <!-- mobile-only -->
            <div class="lg:hidden ml-2">
                <button type="button" class="bg-white p-3 inline-flex items-center rounded-md text-black hover:bg-gray-200 hover:text-gray-800 border border-transparent">
                    <span class="sr-only">Open menu</span>
                    <i class="fa fa-bars fa-lg"></i>
                </button>
            </div>
            <!-- mobile-only //end  -->

        </div> <!-- flex grid //end -->
    </div> <!-- container //end -->
</header>
<nav class="relative shadow-sm">
    <div class="container max-w-screen-xl mx-auto px-4">
        <!-- Bottom -->
        <div class="hidden lg:flex flex-1 items-center py-1">
            <a class="px-3 py-2 rounded-md hover:bg-gray-100" href="#"> Heading1 </a>
            <a class="px-3 py-2 rounded-md hover:bg-gray-100" href="#"> Heading2 </a>
            <a class="px-3 py-2 rounded-md hover:bg-gray-100" href="#"> Heading3 </a>
            <a class="px-3 py-2 rounded-md hover:bg-gray-100" href="#"> Heading4 </a>
            <a class="px-3 py-2 rounded-md hover:bg-gray-100" href="#"> Heading5 </a>
        </div>
        <!-- Bottom //end -->
    </div> <!-- container //end -->
</nav>
