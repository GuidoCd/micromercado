<table class=" table table-striped table-hover table-bordered">
    <thead>
            <tr>
                <th class="text-center">Tipo de Movimiento</th>
                <th class="text-center">Codigo</th>
                <th class="text-center">Empleado</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Estado</th>
                <th class="text-center"colspan="3">Acciones</th>
            </tr>
    </thead>
    <tbody>
            @foreach($notas  as $nota)
                <tr>
                    <td class="text-justify p-1">
                        {{ $nota->tipo_movimiento_descripcion }}
                        <span class="{{ $nota->tipo_movimiento_color }}">
                            {{ $nota->tipo_movimiento_icono }}
                        </span>
                   </td>
                   <td class="text-justify p-1">
                       {{ $nota->codigo }}
                   </td>
                    <td class="text-justify p-1">
                         {{ $nota->user != null ? $nota->user->name : 'N/A' }}
                    </td>
                    <td class="text-justify p-1">
                         {{$nota->fecha_formateada}}
                    </td>
                    <td class="text-center p-1">
                        <span class="{{ $nota->estado_color }}">
                            {{ $nota->estado_descripcion }}
                        </span>
                    </td>
                </tr>
            @endforeach
    </tbody>
</table>