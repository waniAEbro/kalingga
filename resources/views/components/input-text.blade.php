@props(['label', 'name', 'placeholder', 'value' => '', 'type' => 'number'])

<label for="{{ $name }}" class="block text-sm">{{ $label }}</label>
<input id="{{ $name }}" name="{{ $name }}"
    {{ $attributes->merge(['class' => 'py-2 px-3 w-full mt-2 rounded text-sm border']) }} type="{{ $type }}"
    placeholder="{{ $placeholder }}" value="{{ $value }}">
