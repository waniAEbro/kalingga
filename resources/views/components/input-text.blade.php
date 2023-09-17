@props(['label', 'name', 'placeholder', 'value' => '', 'type' => 'text'])

<label for="{{ $name }}" class="block text-sm">{{ $label }}</label>
<input id="{{ $name }}" name="{{ $name }}"
    {{ $attributes->merge(['class' => 'py-2 px-3 w-full mt-2 rounded text-sm border outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300 transition-all duration-100']) }}
    type="{{ $type }}" placeholder="{{ $placeholder }}" value="{{ $value }}">
