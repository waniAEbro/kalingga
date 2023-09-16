@props(['action', 'items'])

<div class="w-[490px] h-96 relative bg-white rounded-xl px-4 py-6 drop-shadow-lg">
    <form method="post" action="/{{ $action }}/{{ $items->id }}">
        @csrf
        @method('put')

        {{ $slot }}

        <div class="flex gap-2 absolute bottom-4 right-4">
            <a href="/{{ $action }}"
                class="py-2 px-5 border text-[#768498] text-sm rounded-lg hover:bg-[#F7F9F9]">Cancel</a>
            <button type="submit"
                class="py-2 px-5 border text-[#F7F9F9] text-sm rounded-lg bg-[#064E3B] hover:bg-[#064e3be1]">Save</button>
        </div>
    </form>
</div>
