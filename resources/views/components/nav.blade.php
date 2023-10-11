<nav class="w-[118px] transition-all xl:w-64 bg-[#064E3B]">
    <div class="w-[138px] xl:w-[224px] mt-10 ml-8">
        <a href="/" class="flex h-12 gap-4 ml-3">
            <img class="mt-1" src="/img/image 6 big.png" alt="">
            <div class="font-[500] mt-1 text-white white mr-4 max-xl:hidden">Kalingga Keling Jati</div>
        </a>

        <div class="border-[#1A5C4A] z-10 border-t max-xl:w-[67px] xl:w-52 my-5"></div>

        <div class="text-[#F4F7F6] font-[500]">

            <x-nav-menu :menuName="'Dashboard'" :menuUrl="'Dashboard'" :menuIcon="'home'" />
            <x-nav-menu :menuName="'Komponen'" :menuUrl="'Components'" :menuIcon="'hardware-chip'" />
            <x-nav-menu :menuName="'Produk'" :menuUrl="'Products'" :menuIcon="'cube'" />
            <x-nav-menu :menuName="'Produksi'" :menuUrl="'Productions'" :menuIcon="'cog'" />
            <x-nav-menu :menuName="'Pemasok'" :menuUrl="'Suppliers'" :menuIcon="'boat'" />
            <x-nav-menu :menuName="'Pelanggan'" :menuUrl="'Customers'" :menuIcon="'person'" />
            <x-nav-menu :menuName="'Penjualan'" :menuUrl="'Sales'" :menuIcon="'cash'" />
            <x-nav-menu :menuName="'Pembelian'" :menuUrl="'Purchases'" :menuIcon="'bag-check'" />
            <x-nav-menu :menuName="'Gudang'" :menuUrl="'Warehouse'" :menuIcon="'grid'" />

        </div>
    </div>
</nav>
