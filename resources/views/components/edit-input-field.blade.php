@props(['action', 'items', 'width' => 'w-[490px]', 'sisa' => true])
@push('head')
    <style>
        .save {
            background-color: #064E3B;
        }

        .save:hover {
            background-color: #064e3be1;
        }
    </style>
@endpush
<div class="{{ $width }} h-fit relative bg-white rounded-xl px-4 pt-6 pb-20 drop-shadow-lg">
    <form method="post" action="/{{ $action }}/{{ $items->id }}">
        @csrf
        @method('put')

        {{ $slot }}
        @if (!$sisa)
            <div class="absolute flex gap-2 bottom-4 right-4">
                <a href="/{{ $action }}"
                    class="py-2 px-5 border text-[#768498] text-sm rounded-lg hover:bg-[#F7F9F9]">Back</a>
            </div>
        @else
            <div class="absolute flex gap-2 bottom-4 right-4">
                <a href="/{{ $action }}"
                    class="py-2 px-5 border text-[#768498] text-sm rounded-lg hover:bg-[#F7F9F9]">Cancel</a>
                <button type="submit" class="py-2 px-5 border text-[#F7F9F9] text-sm rounded-lg save">Save</button>
            </div>
        @endif
    </form>
</div>
