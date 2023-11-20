@props([
    'label' => '',
    'labelClass' => '',
    'name' => '',
    'placeholder' => '',
    'value' => '',
    'type' => 'text',
    'inputParentClass' => '',
    'step' => '0.001',
    'min' => '0',
])

<div class="{{ $inputParentClass }}">
    <label for="{{ $name }}" class="block text-sm {{ $labelClass }}">{{ $label }}</label>
    <input id="{{ $name }}" name="{{ $name }}" step="{{ $step }}" min="{{ $min }}"
        {{ $attributes->merge(['class' => 'w-full px-3 py-2 mt-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300']) }}
        type="{{ $type }}" placeholder="{{ $placeholder }}" value="{{ $value }}">
    @error($name)
        <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
    @enderror
</div>
