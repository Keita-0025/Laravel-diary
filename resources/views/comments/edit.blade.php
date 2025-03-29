<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            コメント編集
        </h2>
    </x-slot>

    <div class="max-w-7xl mt-4 mx-auto p-5 bg-white rounded-2xl">
        <form action="{{ route('comments.update', $comment) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">コメント</label>
                <textarea id="content" name="content" rows="4" class="mt-2 w-full p-2 border rounded-md">{{ $comment->content }}</textarea>
            </div>

            <div class="flex justify-end">
                <x-primary-button>更新</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>