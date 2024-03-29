@extends('layouts.header')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full max-w-md">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="text-xl font-bold mb-6">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <span class="block sm:inline">{{ session('status') }}</span>
                            </div>
                        @endif

                        <p class="text-gray-700">{{ __('You are logged in!') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
