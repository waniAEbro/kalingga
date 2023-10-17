@extends('layouts.layout')

@section('content')
    <div>
        <canvas id="salesChart"></canvas>
        <canvas id="purchasesChart"></canvas>
        <canvas id="salesDoughnut"></canvas>
    </div>
    <table>
        <thead>
            <tr>
                <th>Kode Penjualan</th>
                <th>Pelanggan</th>
                <th>Sisa Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salesNotDone as $sale)
                <tr>
                    <td>{{ $sale->code }}</td>
                    <td>{{ $sale->customer->name }}</td>
                    <td>{{ $sale->remain_bill }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@push('script')
    <script>
        const sales = {!! $sales !!}

        const purchases = {!! $purchases !!}

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
