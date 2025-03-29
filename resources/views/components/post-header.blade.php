@props(['title', 'url' => null])

<div class="post-header">
    <h1 class="p-4 text-lg font-semibold">
        タイトル：
        @if ($url)
            <a href="{{ $url }}" class="text-blue-600">
                {{ $title }}
            </a>
        @else
            {{ $title }}
        @endif
    </h1>
</div>
