<nav>
    <div class="flex w-full items-center">
        {{-- 左端に表示中の情報 --}}
        <div class="ml-4">
            <span>表示中： {{ $paginator->firstItem() }} から {{ $paginator->lastItem() }} 件目 / 全：
                {{ $paginator->total() }} 件</span>
        </div>

        {{-- 中央にページ番号を配置 --}}
        <ul class="pagination absolute left-1/2 transform -translate-x-1/2 flex space-x-2">
            {{-- Previous Page Link（1ページ目なら非表示） --}}
            @if ($paginator->currentPage() > 1)
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- ページ番号表示 --}}
            @if ($paginator->lastPage() > 1)
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                    @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="bg-blue-500 text-white rounded h-full px-2 flex items-center justify-center">
                                    <span>{{ $page }}</span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}"
                                        class="h-full flex items-center justify-center rounded hover:bg-gray-200 px-2">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @else
                {{-- 1ページしかない場合でも「1」を表示 --}}
                <li class="bg-blue-500 text-white rounded h-full px-2 flex items-center justify-center">
                    <span>1</span>
                </li>
            @endif

            {{-- Next Page Link（最後のページなら非表示） --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
