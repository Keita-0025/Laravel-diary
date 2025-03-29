<x-app-layout>
    <x-slot name='header'>
        <h2 class="font-semibold text-xl text-gray-800">
            マイページ
        </h2>
    </x-slot>

    <x-container>
        <x-message :message="session('message')" />

        @foreach ($posts as $post)
            <div class="max-w-7xl mt-4 mx-auto p-5  bg-white  rounded-2xl">
                <x-post-header :title="$post->title" :url="route('post.show', $post)" />
                <hr class="w-full">
                <x-post-body :body="$post->body" />
                <x-post-footer :post="$post" :createdAt="$post->created_at" :userName="$post->user->name" :commentCount="$post->comments->count()">
                </x-post-footer>
            </div>
        @endforeach
        <div class="my-6">
            {{ $posts->links() }}
        </div>
    </x-container>
</x-app-layout>
