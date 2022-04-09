{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}
@extends('layouts.auth')

@section('title', 'Sign In')

@section('content')
    <div class="min-h-screen">
        <div class="grid lg:grid-cols-2">
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <!-- Form-->
            <div class="px-4 lg:px-[91px] pt-10">
                <!-- Logo Brand -->
                <a href="{{ route('index') }}" class="flex-shrink-0 inline-flex items-center">
                    <img class="h-12 lg:h-16" src="{{ asset('assets/frontsite/images/logo.png') }}" alt="Meet Doctor Logo"/>
                </a>
                <div class="flex flex-col justify-center py-14 h-screen lg:min-h-screen">
                    <h2 class="text-[#1E2B4F] text-4xl font-semibold leading-normal">
                        Improve Your <br />
                        Health With Expert
                    </h2>
                    <div class="mt-12">
                        <!-- Form input -->
                        <form method="POST" action="{{ route('login') }}" class="grid gap-6">
                            @csrf
                            {{-- Email --}}
                            <label class="block">
                                <input
                                type="email" id="email" name="email"
                                class="block w-full rounded-full py-4 text-[#1E2B4F] font-medium placeholder:text-[#AFAEC3] placeholder:font-normal px-7 border border-[#d4d4d4] focus:outline-none focus:border-[#0D63F3]"
                                placeholder="Email Address" value="{{ old('email') }}" required autofocus/>
                                @if ($errors->has('email'))
                                    <p class="text-red-500 mb-3 text-sm">{{ $errors->first('email') }}</p>
                                @endif
                            </label>
                            {{-- Password --}}
                            <label class="block">
                                <input
                                type="password" id="password" name="password"
                                class="block w-full rounded-full py-4 text-[#1E2B4F] font-medium placeholder:text-[#AFAEC3] placeholder:font-normal px-7 border border-[#d4d4d4] focus:outline-none focus:border-[#0D63F3]"
                                placeholder="Password" required autocomplete={{ "current-password" }}/>
                                @if ($errors->has('password'))
                                    <p class="text-red-500 mb-3 text-sm">{{ $errors->first('password') }}</p>
                                @endif
                            </label>
                            
                            <div class="mt-10 grid gap-4">
                                <button class="text-center text-white text-lg font-medium bg-[#0D63F3] px-10 py-4 rounded-full">
                                    Sign In
                                </button>
                                <a href="{{ route('register') }}"
                                class="text-center text-lg text-[#1E2B4F] font-medium bg-[#F2F6FE] px-10 py-4 rounded-full">
                                    New Account
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!-- End Form -->
        <!-- Qoute -->
            <div class="hidden sm:block bg-[#F9FBFC]">
                <div class="flex flex-col justify-center h-full px-24 pt-10 pb-20">
                    <div class="relative">
                        <div class="relative top-0 -left-5 mb-7">
                            <img
                                src="{{ asset("assets/frontsite/images/blockqoutation.svg") }}"
                                class="h-[30px]"
                                alt=""/>
                        </div>
                        <p class="text-2xl leading-loose">
                            MeetDoctor telah membantu saya terhubung dengan dokter yang
                            professional dan memberikan dampak yang sangat besar kepada
                            kesehatan yang baik kepada saya
                        </p>
                        <div class="flex-shrink-0 group block mt-7">
                            <div class="flex items-center">
                                <div class="ring-1 ring-[#0D63F3] ring-offset-4 rounded-full">
                                    <img
                                        class="inline-block h-14 w-14 rounded-full"
                                        src="{{ asset("/assets/frontsite/images/patient-testimonial.png") }}"
                                        alt=""
                                    />
                                </div>
                                <div class="ml-5">
                                    <p class="font-medium text-[#1E2B4F]">Shayna</p>
                                    <p class="text-sm text-[#AFAEC3]">Product Designer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- End Qoute -->
        </div>
    </div>
@endsection