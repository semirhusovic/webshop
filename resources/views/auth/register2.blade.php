<x-app-layout>

    <div class="container max-w-screen-xl mx-auto px-4">


        <!--  COMPONENT: SIGN IN -->
        <div style="max-width:480px" class="mt-10 mb-20 p-4 md:p-7 mx-auto rounded bg-white shadow-lg">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h2 class="mb-5 text-2xl font-semibold">Sign up</h2>

                <div class="grid md:grid-cols-2 gap-x-2">
                    <div class="mb-4">
                        <label class="block mb-1"> First name </label>
                        <input class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" type="text" name="first_name" value="{{old('first_name')}}" placeholder="Type here">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1"> Last name </label>
                        <input class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" type="text" name="last_name" value="{{old('last_name')}}" placeholder="Type here">
                    </div>
                </div> <!-- grid -->

                <div class="mb-4">
                    <label class="block mb-1"> Phone </label>

                    <div class="flex  w-full">
                        <input class="appearance-none w-24 border border-gray-200 bg-gray-100 rounded-tl-md rounded-bl-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400" type="text" placeholder="Code" value="+382">
                        <input class="appearance-none flex-1 border border-gray-200 bg-gray-100 rounded-tr-md rounded-br-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400" type="text" name="phone" value="{{old('phone_number')}}" placeholder="Type phone">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block mb-1"> Email </label>
                    <input class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" type="email" name="email" value="{{old('email')}}" placeholder="Type here">
                </div>

                <div class="mb-4">
                    <label class="block mb-1"> Create password </label>
                    <input class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" type="password" name="password" placeholder="Type here">
                </div>

                <div class="mb-4">
                    <label class="block mb-1"> Confirm password </label>
                    <input class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" type="password" name="password_confirmation"  placeholder="Type here">
                </div>

                <button type="submit" class="my-2 px-4 py-2 text-center w-full inline-block text-white bg-teal-400 border border-transparent rounded-md hover:bg-teal-600"> Register </button>
            </form>
        </div>
    </div>
</x-app-layout>
