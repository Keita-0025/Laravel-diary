<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            コメント入力
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-6">
        @if (session('message'))
            <div class="text-green-600 font-bold">
                {{ session('message') }}
            </div>
        @endif
        <div class="bg-white shadow-md rounded-lg p-6 mt-4">
            <h3 class="text-lg font-semibold">件名: {{ $post->title }}</h3>
            <p class="mt-2 text-gray-700">{{ $post->body }}</p>
        </div>

        <form method="post" action="{{ route('comment.store', $post) }}">
            @csrf
            <div>
                <div class="w-full flex flex-col">
                    <label for="content" class="font-semibold mt-4">コメント</label>
                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    <textarea name="content" class="w-full py-2 border border-gray-300 rounded-md" id="content" cols="30"
                        rows="5">{{ old('content') }}</textarea>
                </div>
            </div>
            <x-primary-button class="mt-4">
                送信する
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
