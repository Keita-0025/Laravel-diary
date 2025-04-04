<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('メールアドレスの確認が成功しました！') }}
    </div>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('メールアドレスの確認に使用したリンクは、') . now()->addDays(60)->format('Y年m月d日') . __('まで有効です。') }}
    </div>

    <div class="mt-4 flex items-center justify-between">
        <a href="{{ url('/') }}" class="inline-block px-6 py-2 text-white bg-blue-500 hover:bg-blue-700 rounded-md">
            {{ __('webページにGo!') }}
        </a>
    </div>
</x-guest-layout>
