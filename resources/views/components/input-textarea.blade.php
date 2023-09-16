@props(['label', 'name', 'placeholder', 'value' => ''])

<label for="{{ $name }}" class="block text-sm">{{ $label }}</label>
<textarea id="{{ $name }}" name="{{ $name }}"
    {{ $attributes->merge(['class' => 'py-2 px-3 w-full mt-2 rounded text-sm border']) }} type="textarea" rows="4"
    cols="50" placeholder="{{ $placeholder }}">{{ $value }}</textarea>
