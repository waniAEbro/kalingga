@props(['menuName', 'menuUrl', 'menuIcon'])

<a href="/{{ strtolower($menuUrl) }}"
    class="{{ Request::is(strtolower($menuUrl) . '*') ? 'active group' : 'pl-5 flex gap-4 w-[86px] group relative xl:w-[224px] items-center hover:bg-[#135745] py-1 mb-2 rounded-l-full' }}">
    <span class="mt-2 text-2xl"><ion-icon class="font-bold" name="{{ $menuIcon }}-outline"></ion-icon></span>
    <p class="mt-1 text-sm max-xl:hidden">{{ $menuName }}</p>
    <div
        class="opacity-0 max-xl:group-hover:opacity-100 max-xl:group-hover:left-24 transition-all absolute bg-[#064E3B] text-[#F4F7F6] py-1 px-3 rounded text-sm z-50 left-0">
        {{ $menuName }}
    </div>

</a>
