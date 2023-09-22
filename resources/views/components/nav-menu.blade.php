@props(['menuName', 'menuUrl', 'menuIcon'])

<a href="/{{ strtolower($menuUrl) }}"
    class="{{ Request::is(strtolower($menuUrl) . '*') ? 'active' : 'pl-5 flex gap-4 items-center hover:bg-[#135745] py-1 mb-2 rounded-l-full' }}">
    <span class="mt-2 text-2xl"><ion-icon class="font-bold" name="{{ $menuIcon }}-outline"></ion-icon></span>
    <p class="mt-1 text-sm">{{ $menuName }}</p>
</a>
