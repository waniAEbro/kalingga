@props(['menuIcon'])

<a href="/" data-tip="Dashboard"
    class="{{ '/' == request()->path() ? 'active group' : 'pl-5 flex w-[86px] group relative xl:w-[224px] gap-4 items-center hover:bg-[#135745] py-1 mb-2 rounded-l-full' }}">
    <span class="mt-2 text-2xl"><ion-icon class="font-bold" name="{{ $menuIcon }}-outline"></ion-icon></span>
    <p class="mt-1 text-sm max-xl:hidden">Dashboard</p>
    <div
        class="opacity-0 max-xl:group-hover:opacity-100 max-xl:group-hover:left-24 transition-all absolute bg-[#064E3B] text-[#F4F7F6] py-1 px-3 rounded text-sm z-10 left-0">
        Dashboard
    </div>
</a>
