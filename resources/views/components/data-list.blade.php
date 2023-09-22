@props(['heads', 'isReadOnly' => false])

<div class="flex items-center justify-between">
    @if (!$isReadOnly)
        <a href="/{{ request()->path() }}/create"
            class="py-2 px-3 text-[#FCFDFD] font-[500] bg-[#1D5E4D] text-sm rounded-md">Tambah Data Baru</a>
    @endif
    <div class="text-xs text-[#95989c] @if ($isReadOnly) ml-[400px] @endif">Showing 1 to 10 of 150
        entries</div>
    <div class="relative">
        <input type="text"
            class="py-2 px-4 text-sm bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)] rounded outline-none  w-52"
            placeholder="Search...">
        <span class="absolute text-xl right-3 top-2 text-slate-400"><ion-icon name="search-outline"></ion-icon></span>
    </div>
</div>

<table class="w-full mt-5 border-separate border-spacing-y-3">
    <thead>
        <tr class="text-center">
            @foreach ($heads as $head)
                <th class="px-4 py-5 font-[500]">{{ $head }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody class="text-center ">

        {{ $slot }}

    </tbody>
</table>
