@extends('adminlte::page')

@section('title', 'Micromercado | Usuarios')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header bg-secondary">
                    <div class="card-title">Opciones de Busqueda</div>
                </div>
                <div class="card-body">
                    {{-- 
                {!! Form::model(Request::all(),[ 'method'=>'GET','route'=>'personal.search','class'=>'row']) !!}
                    @include('recursos-humanos.personal.partials.search') 
                {!! Form::close()!!}
                --}}
                </div>
            </div>
            <hr>
        </div>
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header bg-secondary">
                    <div class="card-title">
                        Listado de Usuarios
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('usuarios.create') }}"><span class="btn btn-sm btn-success float-right"><i class="fa fa-plus"></i>&nbsp;&nbsp;Crear</span></a>
                    </div>
                </div>
                <div class="card-body table-responsive table-striped">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>E-Mail.</th>
                                <th>Estado</th>
                                <th colspan="3">Opciones</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td class="text-justify p-1">
                                        {{ $usuario->name }}
                                    </td>
                                    <td class="text-justify p-1">
                                        {{ $usuario->email }}
                                    </td>
                                    <td class="text-center p-1 {{ $usuario->estado_color }}">
                                        {{ $usuario->estado_descripcion }}
                                    </td>
                                    <td class="text-center p-1">
                                        <a href="{{ route('usuarios.show',$usuario->id) }}" class="btn btn-sm btn-info">
                                            <span>
                                                <i class="fa fa-eye"></i>
                                            </span>
                                            &nbsp;
                                            Ver
                                        </a>
                                    </td>
                                    <td class="text-center p-1">
                                        <a href="{{ route('usuarios.edit',$usuario->id) }}" class="btn btn-sm btn-success">
                                            <span>
                                                <i class="fa fa-edit"></i>
                                            </span>
                                            &nbsp;
                                            Editar
                                        </a>
                                    </td>
                                    <td class="text-center p-1">
                                        <form action="/usuarios/delete" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">
                                            <button type="submit" class="btn btn-sm btn-danger" >
                                                <span>
                                                    <i class="fa fa-trash"></i>
                                                </span>
                                                &nbsp;
                                                Eliminar
                                            </button>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $usuarios->appends(Request::all())->links() }}
                    <p class="text-muted">Mostrando <strong>{{ $usuarios->count() }}</strong> registros de <strong>{{ $usuarios->total() }}</strong> totales</p>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    
@stop

@section('js')
    <script>
        function eliminar(id){
            Swal.fire({
            title: '¿Estas seguro que deseas eliminar el usuario?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })
        }
    </script>
@stop