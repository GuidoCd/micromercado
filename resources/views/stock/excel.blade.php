<table>
    <thead>
        <tr>
            <th><strong>Producto</strong></th>
            <th><strong>Fecha Vencimiento</strong></th>
            <th><strong>Unidad</strong></th>
            <th><strong>Total</strong></th>
        </tr>
    </thead>
    <tbody>
        @foreach($stocks  as $stock)
            <tr>
                <td class="text-justify p-1">
                    {{ $stock->producto }}
                </td>
                <td class="text-justify p-1">
                    {{ \Carbon\Carbon::parse($stock->fecha_vencimiento)->format('d/m/Y') }}
                </td>
                <td class="text-justify p-1">
                    {{ $stock->unidad }}
                </td>
                <td class="text-justify p-1">
                    {{ $stock->total }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>