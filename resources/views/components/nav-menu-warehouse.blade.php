@props(['menuName', 'menuIcon', 'menuUrl'])

<a id="warehouse" href="/{{ strtolower($menuUrl) }}"
    class="{{ Request::is(strtolower($menuUrl) . '*') ? 'active-warehouse group' : 'pl-5 w-[86px] group relative xl:w-[224px] flex gap-4 items-center hover:bg-[#135745] py-1 mb-2 rounded-l-full' }}">
    <span class="mt-2 text-2xl"><ion-icon class="font-bold" name="{{ $menuIcon }}-outline"></ion-icon></span>
    <p class="mt-1 text-sm max-xl:hidden">{{ $menuName }}</p>
    <div
        class="opacity-0 max-xl:group-hover:opacity-100 max-xl:group-hover:left-24 transition-all text-[#F4F7F6] absolute bg-[#064E3B] py-1 px-3 rounded text-sm z-10 left-0">
        {{ $menuName }}
    </div>
</a>

@push('script')
    <script>
        let warehouse = document.querySelector('#warehouse');
        if (warehouse.classList.contains('active-warehouse') && (document.documentElement.scrollHeight > 687)) {
            warehouse.classList.remove('active-warehouse');
            warehouse.classList.add('active');
            console.log('scroll height > 687')
        }
    </script>
@endpush
