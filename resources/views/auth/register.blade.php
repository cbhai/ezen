@extends('layouts.app')

@section('content')
<section class="relative w-full h-full min-h-screen py-40">
    <div class="container h-full px-4 mx-auto">
        <div class="flex items-center content-center justify-center h-full">
            <div class="w-full px-4 lg:w-6/12">
                <div class="relative flex flex-col w-full min-w-0 mb-6 break-words border-0 rounded-lg shadow-lg bg-blueGray-200">
                    <div class="px-6 py-6 mb-0 rounded-t">
                        <div class="mb-3 text-center">
                            <h6 class="text-sm font-bold text-blueGray-500">
                                {{ __('global.register') }}
                            </h6>
                        </div>
                        <hr class="mt-6 border-b-1 border-blueGray-300" />
                    </div>
                    <div class="flex-auto px-4 py-10 pt-0 lg:px-10">
                        <form method="POST" id="registration_form" action="{{ route('register') }}">
                            @csrf
                            <div class="relative w-full mb-3">
                                <label class="block mb-2 text-xs font-bold uppercase text-blueGray-600" for="name">
                                    {{ __('global.user_name') }}
                                </label>
                                <input id="name" name="name" type="text" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full {{ $errors->has('name') ? ' ring ring-red-300' : '' }}" placeholder="{{ __('global.user_name') }}" required autofocus autocomplete="name" value="{{ old('name') }}" />
                                @error('name')
                                    <div class="text-red-500">
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>
                            <div class="relative w-full mb-3">
                                <label class="block mb-2 text-xs font-bold uppercase text-blueGray-600" for="email">
                                    {{ __('global.login_email') }}
                                </label>
                                <input id="email" name="email" type="email" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full {{ $errors->has('email') ? ' ring ring-red-300' : '' }}" placeholder="{{ __('global.login_email') }}" required autocomplete="email" value="{{ old('email') }}" />
                                @error('email')
                                    <div class="text-red-500">
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>
                            <div class="relative w-full mb-3">
                                <label class="block mb-2 text-xs font-bold uppercase text-blueGray-600" for="password">
                                    {{ __('global.login_password') }}
                                </label>
                                <input id="password" name="password" type="password" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full {{ $errors->has('password') ? ' ring ring-red-300' : '' }}" placeholder="{{ __('global.login_password') }}" required autocomplete="new-password" />
                                @error('password')
                                    <div class="text-red-500">
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>
                            <div class="relative w-full mb-3">
                                <label class="block mb-2 text-xs font-bold uppercase text-blueGray-600" for="password_confirmation">
                                    {{ __('global.confirm_password') }}
                                </label>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="w-full px-3 py-3 text-sm bg-white border-0 rounded shadow placeholder-blueGray-300 text-blueGray-600 focus:outline-none focus:ring" placeholder="{{ __('global.confirm_password') }}" required autocomplete="new-password" />
                            </div>
                            <div class="mt-6 text-center">
                                <button class="w-full px-6 py-3 mb-1 mr-1 text-sm font-bold text-white uppercase transition-all duration-150 ease-linear rounded shadow outline-none bg-blueGray-800 active:bg-blueGray-600 hover:shadow-lg focus:outline-none">
                                    {{ __('global.register') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection