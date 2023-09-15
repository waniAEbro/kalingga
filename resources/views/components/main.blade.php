<main class="w-full py-5 min-h-screen bg-[#064E3B] pr-7">
    <div class="w-full h-full bg-[#F1F5F9] rounded-[30px] pl-6 pr-0 pb-5 pt-4">
        <div class="w-[98%]">
            <div class="flex justify-between mt-3">
                <div class="text-sm text-[#739C93] font-[500] breadcrumbs">
                    <ul id="breadcrumbs"></ul>
                </div>

                <div class="flex justify-between gap-5">
                    <div class="relative">
                        <input type="text"
                            class="py-2 focus:outline-4 focus:outline focus:outline-[#C2D4D3] outline-none focus:outline-offset-0 pl-4 font-[500] pr-4 rounded-full w-52 transition-all ease-in-out focus:w-72 text-sm bg-[#DEE5ED]"
                            placeholder="Search...">
                        <span class="absolute text-xl right-3 top-2 text-slate-600"><ion-icon
                                name="search-outline"></ion-icon></span>
                    </div>
                    <div class="bg-yellow-400 rounded-full w-9 h-9"></div>
                </div>
            </div>

            <div class="my-6 border-t border-slate-200"></div>

            {{ $slot }}

        </div>
    </div>
</main>