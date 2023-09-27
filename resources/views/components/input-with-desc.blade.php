@props(['label' => '', 'name' => '', 'placeholder' => '', 'value' => '', 'type' => 'text', 'desc' => ''])

<div>
    @if ($label)
        <label for="{{ $name }}" class="block mb-2 text-sm">{{ $label }}</label>
    @endif
    <div class="flex">
        <div class="py-2 px-3 text-sm bg-[#F1F5F9] border-l border-y rounded-l">
            {{ $desc }}
        </div>
        <input id="{{ $name }}" name="{{ $name }}" step="0.001" min="0"
            {{ $attributes->merge(['class' => 'py-2 px-3 w-full rounded-r text-sm border outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300 transition-all duration-100']) }}
            type="{{ $type }}" placeholder="{{ $placeholder }}" value="{{ $value }}">
    </div>
</div>
