@props(['type' => 'submit', 'color' => 'blue'])

<button type="{{ $type }}"
    {{ $attributes->merge(['class' => "px-4 py-2 rounded-lg text-white bg-{$color}-500 hover:bg-{$color}-700 focus:outline-none focus:ring-2 focus:ring-{$color}-500 focus:ring-opacity-50 transition ease-in-out duration-150"]) }}>
    {{ $slot }}
</button>
