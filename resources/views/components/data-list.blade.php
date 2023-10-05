@props(['isReadOnly' => false])

<div class="flex items-center justify-between">
    @if (!$isReadOnly)
        <a href="/{{ request()->path() }}/create"
            class="py-2 px-3 text-[#FCFDFD] font-[500] bg-[#1D5E4D] text-sm rounded-md">Tambah Data Baru</a>
    @endif
    <div id="info-pagination" class="text-xs text-[#95989c] @if ($isReadOnly) ml-[400px] @endif"></div>
    <div class="relative">
        <input type="text"
            class="py-2 focus:outline-4 focus:outline focus:outline-[#C2D4D3] outline-none focus:outline-offset-0 pl-4 font-[500] pr-4 rounded-full w-52 transition-all ease-in-out focus:w-72 text-sm bg-[#DEE5ED]"
            placeholder="Search..." oninput="search(this.value)">
        <span class="absolute text-xl right-3.5 top-2 text-slate-600"><ion-icon name="search-outline"></ion-icon></span>
    </div>
</div>
{{ $slot }}
