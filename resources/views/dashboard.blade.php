@extends('layouts.layout')

@section('content')
    <div class="flex gap-5 mb-10">
        <div class="relative z-10 flex items-end justify-center w-full h-40 group">
            <div
                class="w-[90%] group-hover:scale-110 transition duration-500 h-20 bg-slate-50 shadow-[0px_3px_20px_#0000000b] rounded-xl z-0">
            </div>
            <div
                class="w-full group-hover:scale-110 transition duration-500 h-40 p-5 rounded-xl shadow-[0px_3px_20px_#0000000b] absolute -top-3 bg-white">
                <ion-icon class="text-3xl text-red-500" name="bar-chart-outline"></ion-icon>
                <h1 id="total_penjualan" class="font-bold text-2xl mt-4 text-[#1E293B]">800</h1>
                <div class="text-[#707E94] mt-2">Total Penjualan</div>
            </div>
        </div>
        <div class="relative z-10 flex items-end justify-center w-full h-40 group">
            <div
                class="w-[90%] group-hover:scale-110 transition duration-500 h-20 bg-slate-50 shadow-[0px_3px_20px_#0000000b] rounded-xl z-0">
            </div>
            <div
                class="w-full group-hover:scale-110 transition duration-500 h-40 p-5 rounded-xl shadow-[0px_3px_20px_#0000000b] absolute -top-3 bg-white">
                <ion-icon class="text-3xl text-yellow-500" name="cube-outline"></ion-icon>
                <h1 id="total produk" class="font-bold text-2xl mt-4 text-[#1E293B]">{{ $products->count() }}</h1>
                <div class="text-[#707E94] mt-2">Total Produk</div>
            </div>
        </div>
        <div class="relative z-10 flex items-end justify-center w-full h-40 group">
            <div
                class="w-[90%] group-hover:scale-110 transition duration-500 h-20 bg-slate-50 shadow-[0px_3px_20px_#0000000b] rounded-xl z-0">
            </div>
            <div
                class="w-full group-hover:scale-110 transition duration-500 h-40 p-5 rounded-xl shadow-[0px_3px_20px_#0000000b] absolute -top-3 bg-white">
                <ion-icon class="text-3xl text-green-600" name="boat-outline"></ion-icon>
                <h1 id="total supplier" class="font-bold text-2xl mt-4 text-[#1E293B]">{{ $suppliers->count() }}</h1>
                <div class="text-[#707E94] mt-2">Total Supplier</div>
            </div>
        </div>
    </div>

    <div class="flex gap-10 mt-10">
        <div class="flex-1 p-5  bg-white rounded-xl drop-shadow-[0_0_15px_rgba(0,0,0,0.05)]">
            <div class="mb-3 text-xl font-[500]">Laporan Penjualan</div>
            <canvas id="salesChart"></canvas>

            <div class="mb-3 text-xl font-[500] mt-5">Laporan Pembelian</div>
            <canvas id="purchasesChart"></canvas>
        </div>

        <div class="flex-1 p-5 bg-white rounded-xl drop-shadow-[0_0_15px_rgba(0,0,0,0.05)]">
            <div class="mb-3 text-xl font-[500]">Status Penjualan</div>
            <canvas id="salesDoughnut"></canvas>
        </div>
    </div>

    <div class="mt-10">
        <div class="text-xl font-[500]">Monitor Transaksi</div>
        <table class="w-full border-separate table-fixed border-spacing-y-3">
            <thead>
                <tr>
                    <th class="px-4 py-5 font-[500]">Kode Penjualan</th>
                    <th class="px-4 py-5 font-[500]">Pelanggan</th>
                    <th class="px-4 py-5 font-[500]">Sisa Transaksi</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach ($salesNotDone as $sale)
                    <tr
                        class="text-sm bg-white transition-all overflow-hidden drop-shadow-[0_0_15px_rgba(0,0,0,0.05)] text-center">
                        <td class="p-4 break-words rounded-l-lg">{{ $sale->code }}</td>
                        <td class="p-4 break-words">{{ $sale->customer->name }}</td>
                        <td class="p-4 break-words rounded-r-lg">{{ $sale->remain_bill }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection

@push('script')
    <script>
        const sales = {!! $sales !!}
        const purchases = {!! $purchases !!}

        const total_sales = sales.reduce((total, current) => total + current.total_bill, 0)

        document.querySelector("#total_penjualan").innerHTML = toRupiah(total_sales)

        const currentYear = Number(new Date().getFullYear())

        const salesOpen = sales.filter(sale => sale.remain_bill > 0).filter(sale => sale.sale_date.includes(currentYear))

        const salesClosed = sales.filter(sale => sale.remain_bill == 0).filter(sale => sale.sale_date.includes(
            currentYear))

        let salesPerYear = []

        let purchasesPerYear = []

        let monthsObject = {}

        Array(12).fill().map((element, index) => index + 1).forEach(month => {
            monthsObject[month] = {}
        })

        const years = Array(5).fill().map((element, index) => currentYear - 4 + index)

        years.forEach(year => {
            salesPerYear.push((sales.filter(sale => sale.sale_date.includes(year)).reduce((total, current) =>
                total +
                current.total_bill, 0)))
        })

        years.forEach(year => {
            purchasesPerYear.push((purchases.filter(purchase => purchase.purchase_date.includes(year)).reduce((
                    total, current) =>
                total +
                current.total_bill, 0)))
        })

        const salesChart = document.getElementById('salesChart');
        const purchasesChart = document.getElementById("purchasesChart")
        const salesDoughnut = document.getElementById("salesDoughnut")

        new Chart(salesDoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Open', 'Closed'],
                datasets: [{
                    label: '# of sales',
                    data: [salesOpen.length, salesClosed.length],
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(255, 99, 132)',
                        'rgba(54, 162, 235)',
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(salesChart, {
            type: 'bar',
            data: {
                labels: years,
                datasets: [{
                    label: '# rupiah',
                    data: salesPerYear,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(purchasesChart, {
            type: 'bar',
            data: {
                labels: years,
                datasets: [{
                    label: '# rupiah',
                    data: purchasesPerYear,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
