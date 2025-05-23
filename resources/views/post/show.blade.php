<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            記事編集・コメント
        </h2>
    </x-slot>
    <x-container>
        <x-message :message="session('message')" class=" max-w-7xl mx-auto px-6" />
        <div class="max-w-7xl mt-4 mx-auto p-5  bg-white  rounded-2xl">
            <x-post-header :title="$post->title" />
            <hr class="w-full">
            <x-post-body :body="$post->body" />
            <x-post-footer :post="$post" :createdAt="$post->created_at" :userName="$post->user->name" :commentCount="$post->comments->count()">
                <div class="text-right flex mb-4">
                    @can('update', $post)
                        <a href="{{ route('post.edit', $post) }}" class="flex-1">
                            <x-button class="bg-green-500 hover:bg-green-700 ml-2">
                                編集
                            </x-button>
                        </a>
                    @endcan
                    @can('delete', $post)
                        <form method="post" action="{{ route('post.destroy', $post) }}" class="flex-2">
                            @csrf
                            @method('delete')
                            <x-button class="bg-red-500 hover:bg-red-700 ml-2">
                                削除
                            </x-button>
                        </form>
                    @endcan
                </div>
            </x-post-footer>
        </div>

        <div class="max-w-7xl mt-6 mx-auto  rounded-lg">
            <form method="post" action="{{ route('comment.store', $post) }}">
                @csrf
                <hr class="w-full">
                <x-input-field name="content" label="コメント" type="textarea" />
                <x-button class="my-4">
                    ポストする
                </x-button>
                <hr class="w-full">
            </form>
        </div>
        <div class="max-w-7xl mt-6 mx-auto  rounded-lg">
            <h3 class="text-lg font-semibold my-4">コメント一覧</h3>

            @forelse ($comments as $comment)
                <div class="mb-4 p-4 bg-white rounded-lg shadow">
                    <p class="text-gray-800">
                        {{ $comment->content }}
                    </p>
                    <div class="text-sm text-gray-500 mt-2 flex justify-between">
                        {{ $comment->user->name ?? '匿名' }} - {{ $comment->created_at->format('Y-m-d H:i') }}

                        @if (auth()->check() && auth()->id() === $comment->user_id)
                            <div class="relative">
                                <button class="js-button text-gray-600 hover:text-gray-800"
                                    data-comment-id="{{ $comment->id }}">
                                    ⋯
                                </button>
                                <!-- オーバーレイ（透明な背景） -->
                                <div id="overlay" class="hidden fixed inset-0 bg-black opacity-5 z-40"></div>
                                <!-- ドロップダウンメニュー -->
                                <div id="dropdown-{{ $comment->id }}"
                                    class="js-dropdown-menu hidden absolute bg-white shadow-lg rounded-lg p-2 mt-2 right-0 w-48 z-50">
                                    <a href="{{ route('comments.edit', $comment) }}"
                                        class="block text-gray-800 hover:text-gray-600 p-2">編集</a>
                                    <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="block text-red-600 hover:text-red-800 p-2">削除</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-600">コメントはまだありません。</p>
            @endforelse
            @push('scripts')
                <script src="{{ asset('js/commentDropdown.js') }}"></script>
            @endpush
        </div>
    </x-container>
</x-app-layout>
