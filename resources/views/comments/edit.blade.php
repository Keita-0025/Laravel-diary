<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            コメント編集
        </h2>
    </x-slot>

    <x-container>
        <form action="{{ route('comments.update', $comment) }}" method="POST">
            @csrf
            @method('PUT')

            <x-input-field name="content" label="コメント" type="textarea" :value="$comment->content" />
                <x-button class="mt-4">ポストする</x-button>
        </form>
    </x-container>
</x-app-layout>
