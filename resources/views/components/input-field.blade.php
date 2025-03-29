@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'type' => 'text', // 'text' または 'textarea'
])

<div class="w-full flex flex-col">
    @if ($label)
        <label for="{{ $name }}" class="font-semibold my-4">{{ $label }}</label>
    @endif
    <x-input-error :messages="$errors->get($name)" class="mt-2" />

    @if ($type === 'textarea')
        <textarea name="{{ $name }}" id="{{ $name }}" cols="30" rows="5"
            class="w-auto py-2 border border-gray-300 rounded-l"
        >{{ old($name, $value) }}</textarea>
    @else
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" 
            class="w-auto py-2 border border-gray-300 rounded-l"
            value="{{ old($name, $value) }}">
    @endif
</div>