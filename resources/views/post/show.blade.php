<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            記事編集・コメント
        </h2>
    </x-slot>
    <div class="max-w-7xl mt-4 mx-auto px-6  bg-white  rounded-2xl">
        <div class="mt-4 p-4">
            <h1 class="text-lg front-semibold p-4">
                {{ $post->title }}
            </h1>
            <hr class="w-full">
            <p class="mt-4 whitespace-pre-line">
                {{ $post->body }}
            </p>
            <div class="text-sm font-semibold flex flex-row-reverse">
                <p>{{ $post->created_at }}</p>
            </div>
            <div class="text-right flex mb-4">
                @can('update', $post)
                    <a href="{{ route('post.edit', $post) }}" class="flex-1">
                        <x-primary-button>
                            編集
                        </x-primary-button>
                    </a>
                @endcan
                @can('delete', $post)
                    <form method="post" action="{{ route('post.destroy', $post) }}" class="flex-2">
                        @csrf
                        @method('delete')
                        <x-primary-button class="bg-red-700 ml-2">
                            削除
                        </x-primary-button>
                    </form>
                @endcan
            </div>
        </div>
        <div class="mt-6 p-4 rounded-lg">
            <form method="post" action="{{ route('comment.store', $post) }}">
                @csrf
                <hr class="w-full">
                <div>
                    <div class="w-full flex flex-col">
                        <label for="content" class="font-semibold mt-4">コメント</label>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        <textarea name="content" class="w-full py-2 border border-gray-300 rounded-md" id="content" cols="30"
                            rows="5">{{ old('content') }}</textarea>
                    </div>
                </div>
                <x-primary-button class="my-4">
                    ポストする
                </x-primary-button>
                <hr class="w-full">
            </form>
            <h3 class="text-lg font-semibold my-4">コメント一覧</h3>

            @forelse ($comments as $comment)
                <div class="mb-4 p-3 bg-white rounded-lg shadow">
                    <p class="text-gray-800">
                        {{ $comment->content }}
                    </p>
                    <div class="text-sm text-gray-500 mt-2 flex justify-between">
                        {{ $comment->user->name ?? '匿名' }} - {{ $comment->created_at->format('Y-m-d H:i') }}

                        @if (auth()->check() && auth()->id() === $comment->user_id)
                            <!-- ⋯ ボタン -->
                            <button class="text-gray-600 hover:text-gray-800"
                                onclick="toggleDropdown({{ $comment->id }})">
                                ⋯
                            </button>

                            {{-- <!-- ドロップダウンメニュー -->
                            <div id="dropdown-{{ $comment->id }}"
                                class="dropdown-menu hidden absolute bg-white shadow-lg rounded-lg p-2 mt-2 right-0">
                                <a href="{{ route('comment.edit', $comment) }}"
                                    class="block text-gray-800 hover:text-gray-600 p-2">編集</a>
                                <form method="POST" action="{{ route('comment.destroy', $comment) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="block text-red-600 hover:text-red-800 p-2">削除</button>
                                </form>
                            </div> --}}
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-600">コメントはまだありません。</p>
            @endforelse
        </div>
    </div>

</x-app-layout>
