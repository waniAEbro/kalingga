<nav class="w-64 bg-[#064E3B]">
    <div class="h-[300px] w-[224px] mt-10 ml-8">
        <div class="flex h-12 gap-4 ml-5">
            <img class="mt-1" src="/img/image 6 big.png" alt="">
            <div class="font-[500] mt-1 text-white white mr-4">Kalingga Keling Jati</div>
        </div>

        <div class="border-[#1A5C4A] z-10 border-t my-5 mr-4"></div>

        <div class="text-[#F4F7F6] font-[500]">

            <x-nav-menu-dashboard :menuIcon="'home'" />
            <x-nav-menu :menuName="'Components'" :menuIcon="'hardware-chip'" />
            <x-nav-menu :menuName="'Products'" :menuIcon="'cube'" />
            <x-nav-menu :menuName="'Productions'" :menuIcon="'cog'" />
            <x-nav-menu :menuName="'Suppliers'" :menuIcon="'boat'" />
            <x-nav-menu :menuName="'Customers'" :menuIcon="'person'" />
            <x-nav-menu :menuName="'Sales'"  :menuIcon="'cash'" />
            <x-nav-menu :menuName="'Purchases'" :menuIcon="'bag-check'" />

        </div>
    </div>
</nav>