<main class="w-full py-5 min-h-screen bg-[#064E3B] pr-7">
    <div class="w-full h-full bg-[#F1F5F9] rounded-[30px] pl-6 pr-0 pb-10 pt-4">
        <div class="w-[98%]">
            <div class="flex justify-between mt-3">
                <div class="text-sm text-[#739C93] font-[500] breadcrumbs">
                    <ul id="breadcrumbs"></ul>
                </div>

                <div class="flex justify-between gap-5">
                    <div class="bg-yellow-400 rounded-full w-9 h-9"></div>
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
