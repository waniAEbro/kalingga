@props(['icon', 'color' => '#064E3B', 'url'])

<a href="/{{ $url }}"
    class="drop-shadow bg-[#F1F5F9] hover:opacity-90 transition-all cursor-pointer hover:scale-105 h-28 rounded-xl grid grid-cols-[1.5fr_0.5fr] overflow-hidden">
    <div class="flex flex-col items-center justify-center">
        {{ $slot }}
    </div>
    <div class="flex items-center justify-center" style="background-color: {{ $color }}"><ion-icon size="large"
            class="text-white" name="{{ $icon }}"></ion-icon></div>
</a>
