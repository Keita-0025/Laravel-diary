<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            フォーム
        </h2>
    </x-slot>
    <x-container>
        @if (session('message'))
            <div class="text-red-600 font-bold">
                {{ session('message') }}
            </div>
        @endif

        <form method="post" action="{{ route('post.update', $post) }}">
            @csrf
            @method('patch')
            <x-input-field name="title" label="件名" type="text" :value="$post->title" />
            <x-input-field name="body" label="本文" type="textarea" :value="$post->body" />

            <x-button class="mt-4">
                ポストする
            </x-button>
        </form>
    </x-container>

</x-app-layout>
