<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            記事投稿
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-6">
        @if(session('message'))
            <div class="text-red-600 font-bold">
                {{session('message')}}
            </div>
        @endif
        <form method="post" action="{{ route('post.store') }}">
            @csrf
            <x-input-field name="title" label="件名" type="text" />

            <x-input-field name="body" label="本文" type="textarea" />

            <x-button class="mt-4">
                ポストする
            </x-button>
        </form>
    </div>

</x-app-layout>
