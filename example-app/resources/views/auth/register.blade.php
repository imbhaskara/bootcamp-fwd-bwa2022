{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}
@extends('layouts.auth')

@section('title', 'Sign Up')

@section('content')
<div class="min-h-screen">
    <div class="grid lg:grid-cols-2">
      <!-- Form -->
      <div class="px-4 lg:px-[91px] pt-10">
        <!-- Logo Brand -->
        <a href="{{ route('index') }}" class="flex-shrink-0 inline-flex items-center">
          <img class="h-12 lg:h-16" src="{{ asset('assets/frontsite/images/logo.png') }}" alt="Meet Doctor Logo"/>
        </a>

        <div class="flex flex-col justify-center py-14 h-full lg:min-h-screen">
            <h2 class="text-[#1E2B4F] text-4xl font-semibold leading-normal">
                Improve Your <br />
                Health With Expert
            </h2>
          <div class="mt-12">
            <!-- Form input -->
            <form method="POST" action="{{ route('register') }}" class="grid gap-4">
              {{-- Token here --}}
              @csrf
             {{-- Complate Name Input --}}
              <label class="block">
                  <input
                  type="text" id="name" name="name"
                  class="block w-full rounded-full py-4 text-[#1E2B4F] font-medium placeholder:text-[#AFAEC3] placeholder:font-normal px-7 border border-[#d4d4d4] focus:outline-none focus:border-[#0D63F3]"
                  placeholder="Complete Name" value="{{ old('name') }}" required autofocus
                  />
                  @if ($errors->has('name'))
                    <p class="text-red-500 mb-3 text-sm">{{ $errors->first('name') }}</p>
                  @endif
              </label>
              {{-- Email Input --}}
              <label class="block">
                  <input
                  for= "email" type="email" id="email" name="email"
                  class="block w-full rounded-full py-4 text-[#1E2B4F] font-medium placeholder:text-[#AFAEC3] placeholder:font-normal px-7 border border-[#d4d4d4] focus:outline-none focus:border-[#0D63F3]"
                  placeholder="Email Address" value="{{ old('email') }}" required autofocus
                  />
                  @if ($errors->has('email'))
                    <p class="text-red-500 mb-3 text-sm">{{ $errors->first('email') }}</p>
                  @endif
              </label>
              {{-- Password Input --}}
              <label class="block">
                  <input
                  for="password" type="password" id="password" name="password"
                  class="block w-full rounded-full py-4 text-[#1E2B4F] font-medium placeholder:text-[#AFAEC3] placeholder:font-normal px-7 border border-[#d4d4d4] focus:outline-none focus:border-[#0D63F3]"
                  placeholder="Password" value="{{ old('password') }}" required autofocus
                  />
              </label>
              {{-- Password Confirmation Input --}}
              <label class="block">
                <input
                for="password_confirmation" type="password" id="password_confirmation" name="password_confirmation"
                class="block w-full rounded-full py-4 text-[#1E2B4F] font-medium placeholder:text-[#AFAEC3] placeholder:font-normal px-7 border border-[#d4d4d4] focus:outline-none focus:border-[#0D63F3]"
                placeholder="Confirmation Password" required autofocus
                />
                @if ($errors->has('password'))
                  <p class="text-red-500 mb-3 text-sm">{{ $errors->first('password') }}</p>
                @endif

            </label>
              {{-- Button Register & Sign In --}}
              <div class="mt-10 grid gap-4">
                <button type="submit" class="text-center text-white text-lg font-medium bg-[#0D63F3] px-10 py-4 rounded-full">
                  Continue
                </button>
                <a
                href="{{ route('login') }}"
                class="text-center text-lg text-[#1E2B4F] font-medium bg-[#F2F6FE] px-10 py-4 rounded-full"
                >
                  Sign In
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
                alt=""
              />
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
                    src="{{ asset("assets/frontsite/images/patient-testimonial.png") }}"
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