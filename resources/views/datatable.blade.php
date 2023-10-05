<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <style>
        .container {
            border: 1px solid rgba(0, 0, 0, .11);
            ;
            padding: 10px;
            width: 500px
        }

        .controls-item {
            display: inline-block;
        }

        .btn {
            margin: 1px;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <div class="container ">

    </div>
    <div class="container ">
        <!-- Table structure here -->
        <table class="table table-dark" id="our-table">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>First</th>
                    <th>Last</th>
                </tr>
            </thead>
            <tbody id="table-body">

            </tbody>
        </table>
    </div>

    <div class="container ">
        <div id="pagination-wrapper"></div>
    </div>


</body>

<script>
    var tableData = [{
            'first_name': 'Russell',
            'last_name': 'Wilson',
            'rank': '1',
        },
        {
            'first_name': 'Matt',
            'last_name': 'Hasselbeck',
            'rank': '2',
        },
        {
            'first_name': 'Jim',
            'last_name': 'Zorn',
            'rank': '3',
        },
        {
            'first_name': 'Brady',
            'last_name': 'Quinn',
            'rank': '4',
        },
        {
            'first_name': 'Charly',
            'last_name': 'Whitehurst',
            'rank': '5',
        },
        {
            'first_name': 'Duane',
            'last_name': 'Devine',
            'rank': '6',
        },
        {
            'first_name': 'Tom',
            'last_name': 'Brady',
            'rank': '7',
        },
        {
            'first_name': 'Arron',
            'last_name': 'Rogers',
            'rank': '8',
        },
        {
            'first_name': 'Russell',
            'last_name': 'Wilson',
            'rank': '1',
        },
        {
            'first_name': 'Matt',
            'last_name': 'Hasselbeck',
            'rank': '2',
        },
        {
            'first_name': 'Jim',
            'last_name': 'Zorn',
            'rank': '3',
        },
        {
            'first_name': 'Brady',
            'last_name': 'Quinn',
            'rank': '4',
        },
        {
            'first_name': 'Charly',
            'last_name': 'Whitehurst',
            'rank': '5',
        },
        {
            'first_name': 'Duane',
            'last_name': 'Devine',
            'rank': '6',
        },
        {
            'first_name': 'Tom',
            'last_name': 'Brady',
            'rank': '7',
        },
        {
            'first_name': 'Arron',
            'last_name': 'Rogers',
            'rank': '8',
        },
        {
            'first_name': 'Russell',
            'last_name': 'Wilson',
            'rank': '1',
        },
        {
            'first_name': 'Matt',
            'last_name': 'Hasselbeck',
            'rank': '2',
        },
        {
            'first_name': 'Jim',
            'last_name': 'Zorn',
            'rank': '3',
        },
        {
            'first_name': 'Brady',
            'last_name': 'Quinn',
            'rank': '4',
        },
        {
            'first_name': 'Charly',
            'last_name': 'Whitehurst',
            'rank': '5',
        },
        {
            'first_name': 'Duane',
            'last_name': 'Devine',
            'rank': '6',
        },
        {
            'first_name': 'Tom',
            'last_name': 'Brady',
            'rank': '7',
        },
        {
            'first_name': 'Arron',
            'last_name': 'Rogers',
            'rank': '8',
        },
        {
            'first_name': 'Russell',
            'last_name': 'Wilson',
            'rank': '1',
        },
        {
            'first_name': 'Matt',
            'last_name': 'Hasselbeck',
            'rank': '2',
        },
        {
            'first_name': 'Jim',
            'last_name': 'Zorn',
            'rank': '3',
        },
        {
            'first_name': 'Brady',
            'last_name': 'Quinn',
            'rank': '4',
        },
        {
            'first_name': 'Charly',
            'last_name': 'Whitehurst',
            'rank': '5',
        },
        {
            'first_name': 'Duane',
            'last_name': 'Devine',
            'rank': '6',
        },
        {
            'first_name': 'Tom',
            'last_name': 'Brady',
            'rank': '7',
        },
        {
            'first_name': 'Arron',
            'last_name': 'Rogers',
            'rank': '8',
        },
    ]


    /*
    	1 - Loop Through Array & Access each value
      2 - Create Table Rows & append to table
    */


    var state = {
        'querySet': tableData,

        'page': 1,
        'rows': 5,
        'window': 5,
    }

    buildTable()

    function pagination(querySet, page, rows) {

        var trimStart = (page - 1) * rows
        var trimEnd = trimStart + rows

        var trimmedData = querySet.slice(trimStart, trimEnd)

        var pages = Math.round(querySet.length / rows);

        return {
            'querySet': trimmedData,
            'pages': pages,
        }
    }

    function pageButtons(pages) {
        var wrapper = document.getElementById('pagination-wrapper')

        wrapper.innerHTML = ``
        console.log('Pages:', pages)

        var maxLeft = (state.page - Math.floor(state.window / 2))
        var maxRight = (state.page + Math.floor(state.window / 2))

        if (maxLeft < 1) {
            maxLeft = 1
            maxRight = state.window
        }

        if (maxRight > pages) {
            maxLeft = pages - (state.window - 1)

            if (maxLeft < 1) {
                maxLeft = 1
            }
            maxRight = pages
        }



        for (var page = maxLeft; page <= maxRight; page++) {
            wrapper.innerHTML +=
                `<button value=${page} onclick="pindahHalaman(this.value)" class="page btn btn-sm btn-info">${page}</button>`
        }

        if (state.page != 1) {
            wrapper.innerHTML =
                `<button value=${1} onclick="pindahHalaman(this.value)" class="page btn btn-sm btn-info">&#171; First</button>` +
                wrapper
                .innerHTML
        }

        if (state.page != pages) {
            wrapper.innerHTML +=
                `<button value=${pages} onclick="pindahHalaman(this.value)" class="page btn btn-sm btn-info">Last &#187;</button>`
        }

    }

    function pindahHalaman(value) {
        document.getElementById('table-body').innerHTML = '';

        state.page = Number(value);

        buildTable();
    }


    function buildTable() {
        var table = document.getElementById('table-body');


        var data = pagination(state.querySet, state.page, state.rows)
        var myList = data.querySet

        for (var i = 0 in myList) {
            //Keep in mind we are using "Template Litterals to create rows"
            var row = `<tr>
                  <td>${myList[i].rank}</td>
                  <td>${myList[i].first_name}</td>
                  <td>${myList[i].last_name}</td>
                  `
            table.innerHTML += row
        }

        pageButtons(data.pages)
    }
</script>

</html>
