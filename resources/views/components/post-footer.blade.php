@props(['post', 'createdAt', 'userName', 'commentCount'])

<div class="p-4 text-sm font-semibold flex items-center justify-between">
    <div class="flex items-center">
        <p>
            {{ $createdAt }} / {{ $userName ?? 'anonymity' }}
        </p>
        <a href="{{ route('post.show', $post) }}" class="ml-4 text-gray-600">
            💬 {{ $commentCount }} 件
        </a>
    </div>
    {{ $slot }}
</div>
