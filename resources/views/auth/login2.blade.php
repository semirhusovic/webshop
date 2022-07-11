<x-app-layout>

<div class="container max-w-screen-xl mx-auto px-4">


    <!--  COMPONENT: SIGN IN -->
    <div style="max-width:360px" class="mt-10 mb-20 p-4 md:p-7 mx-auto rounded bg-white shadow-lg">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h2 class="mb-5 text-2xl font-semibold">Sign in</h2>

            <div class="mb-4">
                <label class="block mb-1"> Email </label>
                <input class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" type="text" name="email" value="{{old('email')}}" required placeholder="Type here">
            </div>

            <div class="mb-4">
                <label class="block mb-1"> Password </label>
                <input class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" name="password" type="password" placeholder="Type here">
            </div>

            <label class="flex items-center w-max mb-5">
                <input checked="" name="" type="checkbox" class="h-4 w-4 checked:bg-teal-400 focus:border-teal-300" >
                <span class="ml-2 inline-block text-gray-500"> Remember me </span>
            </label>

            <button type="submit" class="px-4 py-2 text-center w-full inline-block text-white bg-teal-400 border border-transparent rounded-md hover:bg-teal-600" href="#">  Sign in </button>

{{--            <p class="text-center mt-5">--}}
{{--                Don’t have an account?  <a class="text-blue-500" href="{{route('register')}}">Sign up</a>--}}
{{--            </p>--}}
        </form>
    </div>
    <!--  COMPONENT: SIGN IN //END -->

</div>
</x-app-layout>
