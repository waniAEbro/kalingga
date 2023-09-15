<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        ion-icon {
            --ionicon-stroke-width: 40px;
        }
    </style>
    <title>Document</title>
</head>

<body class="font-['Roboto']">
    <div class="flex">
        <x-nav />

        <main class="w-full py-5 min-h-screen bg-[#064E3B] pr-7">
            <div class="w-full h-full bg-[#F1F5F9] rounded-[30px] pl-6 pr-0 pt-4">
                <div class="w-[98%]">
                    <div class="flex justify-between mt-3">
                        <div class="text-sm text-[#739C93] font-[500] breadcrumbs">
                            <ul id="breadcrumbs">

                            </ul>
                        </div>

                        <div x-data="" x-init="console.log(window.location.pathname)" class="flex justify-between gap-5">
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

                    @yield('content')

                </div>
            </div>
        </main>
    </div>
</body>
<script>
    const breadcrumbs = document.querySelector('#breadcrumbs');
    let pathname = window.location.pathname;
    let pathArray = pathname.replace(/\d+/g, '').split('/').filter(function(item) {
        return item !== '';
    });;
    console.log(pathArray);

    pathArray.forEach(e => {
        const listItem = document.createElement('li');
        const textNode = document.createTextNode(e.charAt(0).toUpperCase() + e.slice(1));
        listItem.appendChild(textNode);
        breadcrumbs.appendChild(listItem);
    })

    const setup = () => {
        const getTheme = () => {
            if (window.localStorage.getItem('dark')) {
                return JSON.parse(window.localStorage.getItem('dark'))
            }
            return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
        }

        const setTheme = (value) => {
            window.localStorage.setItem('dark', value)
        }

        return {
            loading: true,
            isDark: getTheme(),
            toggleTheme() {
                this.isDark = !this.isDark
                setTheme(this.isDark)
            },
        }
    }

    function data() {
        return {
            sortBy: "",
            sortAsc: false,
            sortByColumn($event) {
                if (this.sortBy === $event.target.innerText) {
                    if (this.sortAsc) {
                        this.sortBy = "";
                        this.sortAsc = false;
                    } else {
                        this.sortAsc = !this.sortAsc;
                    }
                } else {
                    this.sortBy = $event.target.innerText;
                }

                let rows = this.getTableRows()
                    .sort(
                        this.sortCallback(
                            Array.from($event.target.parentNode.children).indexOf(
                                $event.target
                            )
                        )
                    )
                    .forEach((tr) => {
                        this.$refs.tbody.appendChild(tr);
                    });
            },
            getTableRows() {
                return Array.from(this.$refs.tbody.querySelectorAll("tr"));
            },
            getCellValue(row, index) {
                return row.children[index].innerText;
            },
            sortCallback(index) {
                return (a, b) =>
                    ((row1, row2) => {
                        return row1 !== "" &&
                            row2 !== "" &&
                            !isNaN(row1) &&
                            !isNaN(row2) ?
                            row1 - row2 :
                            row1.toString().localeCompare(row2);
                    })(
                        this.getCellValue(this.sortAsc ? a : b, index),
                        this.getCellValue(this.sortAsc ? b : a, index)
                    );
            }
        };
    }

    function toRupiah(number) {
        var rupiah = '';
        var numberrev = number.toString().split('').reverse().join('');
        for (var i = 0; i < numberrev.length; i++) {
            if (i % 3 == 0) rupiah += numberrev.substr(i, 3) + '.';
        }
        return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
    }
</script>

@stack('script')

</html>
