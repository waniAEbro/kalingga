@props(['label', 'name', 'placeholder', 'value' => ''])

<label for="{{ $name }}" class="block text-sm">{{ $label }}</label>
<textarea id="{{ $name }}" name="{{ $name }}"
    {{ $attributes->merge(['class' => 'py-2 px-3 w-full mt-2 rounded text-sm border outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300 transition-all duration-100']) }}
    type="textarea" rows="4" cols="50" placeholder="{{ $placeholder }}">{{ $value }}</textarea>
