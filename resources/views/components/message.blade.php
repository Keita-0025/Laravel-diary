@props(['message'])
@if ($message)
    <!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
    <div class="p-4 m-2 rounded bg-green-100">
        {{ $message }}
    </div>
@endif
