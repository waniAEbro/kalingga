<main class="w-full py-5 min-h-screen bg-[#064E3B] pr-7">
    <div class="w-full h-full bg-[#F1F5F9] rounded-[30px] pl-6 pr-0 pb-10 pt-4">
        <div class="w-[98%]">
            <div class="flex justify-between mt-3">
                <div class="text-sm text-[#739C93] font-[500] breadcrumbs">
                    <ul id="breadcrumbs"></ul>
                </div>

                <div x-data="{ open: false }" x-on:click="open = !open" x-cloak
                    class="font-[500] hover:cursor-pointer relative text-white">
                    <div class="bg-yellow-400 rounded-full w-9 h-9"></div>

                    <div x-show="open" x-transition:enter.duration.300ms x-transition:leave.duration.300ms
                        class="w-52 rounded-lg absolute z-10 top-12 right-0 bg-[#053E2F] hover:cursor-default">
                        <div class="p-4 border-b border-[#064e3be8]">
                            <div class="text-sm">Rasikh</div>
                            <div class="text-xs text-[#AABEB8]">rasikh@gmail.com</div>
                        </div>
                        <div class="p-2">
                            <div class="flex items-center gap-3 hover:cursor-pointer p-2 hover:bg-[#12483A] rounded">
                                <ion-icon class="text-sm text-white" name="exit-outline"></ion-icon>
                                <div class="text-sm">Logout</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-6 border-t border-slate-200"></div>

            {{ $slot }}

        </div>
    </div>
</main>

@push('script')
    <script>
        const breadcrumbs = document.querySelector('#breadcrumbs');
        let pathname = window.location.pathname;
        let pathArray = pathname.replace(/\d+/g, '').split('/').filter(item => item !== '')

        pathArray.forEach((e, i) => {
            if (i < pathArray.length - 1) {
                breadcrumbs.innerHTML += `<li><a href="/${e}">${e.charAt(0).toUpperCase() + e.slice(1)}</a></li>`
            } else {
                breadcrumbs.innerHTML += `<li>${e.charAt(0).toUpperCase() + e.slice(1)}</li>`
            }
        });
    </script>
@endpush
