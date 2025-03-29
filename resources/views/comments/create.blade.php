<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            コメント入力
        </h2>
    </x-slot>
    <x-container>
        @if (session('message'))
            <div class="text-green-600 font-bold">
                {{ session('message') }}
            </div>
        @endif
        <div class="max-w-7xl mt-4 mx-auto p-5  bg-white  rounded-2xl">
            <x-post-header :title="$post->title" :url="route('post.show', $post)" />
            <hr class="w-full">
            <x-post-body :body="$post->body" />
            <x-post-footer :post="$post" :createdAt="$post->created_at" :userName="$post->user->name" :commentCount="$post->comments->count()">
            </x-post-footer>
        </div>
        <hr class="w-full">
        <form method="post" action="{{ route('comment.store', $post) }}">
            @csrf
            <x-input-field name="content" label="コメント" type="textarea" />
            <x-button class="mt-4">
                送信する
            </x-button>
        </form>
    </x-container>
</x-app-layout>
