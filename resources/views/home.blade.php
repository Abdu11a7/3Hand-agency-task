@extends('layouts.app')

@section('content')
    <section class="text-center py-20">
        <h1 class="text-4xl font-bold mb-4">{{ __('main.welcome_title') }}</h1>
        <p class="text-lg mb-6">{{ __('main.welcome_desc') }}</p>
        <button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">
            <a href="/users">{{ __('main.get_started') }}</a>
        </button>
    </section>
@endsection
