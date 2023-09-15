@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Create Component</h1>

    <div class="w-[490px] h-96 relative bg-white rounded-xl px-4 py-6 drop-shadow-lg">
        <form method="POST" action="/components">
            @csrf
            <label for="name" class="block text-sm">Component Name</label>
            <input id="name" name="name" class="py-2 px-3 w-full mt-2 rounded text-sm border" type="text"
                placeholder="kayu">

            <label for="unit" class="block text-sm mt-3">Component Unit</label>
            <input id="unit" name="unit" class="py-2 px-3 w-full mt-2 rounded text-sm border" type="text"
                placeholder="m">

            <label for="price_per_unit" class="block text-sm mt-3">Component Price</label>
            <input id="price_per_unit" name="price_per_unit" class="py-2 px-3 w-full mt-2 rounded text-sm border"
                type="text" placeholder="1000">

            <div class="flex gap-2 absolute bottom-4 right-4">
                <a href="/components"
                    class="py-2 px-5 border text-[#768498] text-sm rounded-lg hover:bg-[#F7F9F9]">Cancel</a>
                <button type="submit"
                    class="py-2 px-5 border text-[#F7F9F9] text-sm rounded-lg bg-[#064E3B] hover:bg-[#064e3be1]">Save</button>
            </div>
        </form>
    </div>
@endsection
