@extends('layouts.header')

@section('content')
    <div class="container mx-auto py-4"">
        <div class="flex justify-center">
            <div class="w-full max-w-lg">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="text-2xl font-bold mb-6">{{ __('Register') }}</div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-6">
                            <label for="name" class="block text-sm font-semibold mb-2">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-input mt-1 block w-full @error('name') border border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="email" class="block text-sm font-semibold mb-2">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-input mt-1 block w-full @error('email') border border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="password" class="block text-sm font-semibold mb-2">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-input mt-1 block w-full @error('password') border border-red-500 @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="password-confirm" class="block text-sm font-semibold mb-2">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-input mt-1 block w-full" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="mb-0">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
