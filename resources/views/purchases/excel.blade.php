<table>
    <thead>
        <tr>
            <th rowspan="3" colspan="2"><img src="{{ public_path('img/image 6.png') }}" alt=""></th>
            <th>
                Jl. Citrosumo No. 11 RT.017 RW.006
            </th>
        </tr>
        <tr>
            <th>Senenan, tahunan - Jepara - Jawa Tengah
            </th>
        </tr>
        <tr>
            <th>Fax. : (0291) 597784 - Telp. : (0291) 595628, 591637</th>
        </tr>
        <tr>
            <th>
                #
            </th>
            <th>
                Name
            </th>
            <th>
                Quantity
            </th>
            <th>
                Unit
            </th>
            <th>
                Price
            </th>
            <th>
                SubTotal
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($purchase->components as $index => $component)
            <tr>
                <td>
                    {{ $index + 1 }}
                </td>
                <td>
                    {{ $component->name }}
                </td>
                <td>
                    {{ $component->pivot->quantity }}
                </td>
                <td>
                    {{ $component->unit }}
                </td>
                <td>
                    {{ $component->suppliers->find($purchase->supplier_id)->pivot->price_per_unit }}
                </td>
                <td>
                    {{ $component->pivot->quantity * $component->suppliers->find($purchase->supplier_id)->pivot->price_per_unit }}
                </td>
            </tr>
        @endforeach
    </tbody>

    <thead>
        <tr>
            <th>
                #
            </th>
            <th>
                Name
            </th>
            <th>
                Quantity
            </th>
            <th>
                Price
            </th>
            <th>
                SubTotal
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($purchase->products as $index => $product)
            <tr>
                <td>
                    {{ $index + 1 }}
                </td>
                <td>
                    {{ $product->name }}
                </td>
                <td>
                    {{ $product->pivot->quantity }}
                </td>
                <td>
                    {{ $product->suppliers->find($purchase->supplier_id)->pivot->price_per_unit }}
                </td>
                <td>
                    {{ $product->pivot->quantity * $product->suppliers->find($purchase->supplier_id)->pivot->price_per_unit }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
