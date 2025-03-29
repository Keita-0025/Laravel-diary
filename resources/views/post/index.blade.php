<x-app-layout>
    <x-slot name='header'>
        <h2 class="font-semibold text-xl text-gray-800">
            一覧表示
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        <x-message :message="session('message')" />

        @foreach ($posts as $post)
            <div class="max-w-7xl mt-4 mx-auto p-5  bg-white  rounded-2xl">
                <h1 class="p-4 text-lg font-semibold">
                    件名：
                    <a href="{{ route('post.show', $post) }}" class="text-blue-600">
                        {{ $post->title }}
                    </a>
                </h1>
                <hr class="w-full">
                <p class="mt-4 p-4">
                    {{ $post->body }}
                </p>
                <div class="p-4 text-sm font-semibold flex items-center justify-between">
                    <div class="flex items-center">
                        <p>
                            {{ $post->created_at }} / {{ $post->user->name ?? 'anonymity' }}
                        </p>
                        <a href="{{ route('post.show', $post) }}" class="ml-4 text-gray-600">
                            💬 {{ $post->comments->count() }} 件
                        </a>
                    </div>
                    <form action="{{ route('login') }}" method="GET">
                        <x-button type="submit">
                            <a href="{{ route('comment.create', $post) }}">
                            コメントする
                            </a>
                        </x-button>
                    </form>
                </div>
            </div>
        @endforeach
        <div class="my-6">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
