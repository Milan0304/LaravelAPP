@extends('layouts.app')

@section('content')
    <div class="justify-center">
        <div class="flex justify-center font-bold text-gray-700 text-4xl">



            <div class="grid justify-items-center bg-white p-8 mt-10 rounded-lg shadow 2x1 w-4/5">
                <p class="uppercase">
                    Welcome to Invoice App!
                </p>
                @guest

                    <p class="text-sm mt-10 p-2">If you want to create some invoices, you need to login!   <a class="text-blue-500  font-semibold" href="/login">Login</a></p>

                    <p class="text-sm  p-2">If you dont have an account, you can create!   <a class="text-blue-500 font-semibold" href="/register">Sign up now</a></p>
                @endguest

            </div>



        </div>
    </div>
@endsection

