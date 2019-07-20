@extends('dashboard.components.Main')

@section('titulo', 'Sitios')

@section('body')
<div class="col-md-12">

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-sites">
                <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Instancia</th>
                        <th class="text-center">Direcci&oacute;n</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Zona</th>
                        <th class="text-center">Fecha de entrega</th>
                        <th>Observaciones</th>
                        <th class="text-center">Formulario</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sitios as $sitio)
                        <tr class="odd gradeX" >
                            <td>{{ $sitio->code }}</td>
                            <td>{{ $sitio->instance }}</td>
                            <td>{{ $sitio->address }}</td>
                            <td class="text-center">{{ $sitio->state->name }}</td>
                            <td class="text-center">{{ $sitio->state->zone }}</td>
                            <td class="text-center">{{ $sitio->delivery_date }}</td>
                            <td>{{ $sitio->observations }}</td>
                            <td class="text-center"><a href="{{ route('sites.form', $sitio->id_site) }}" class="btn btn-default"><i class="fas fa-tasks"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
       
    </div>
        
</div>
@endsection

@section('js')
    <script src="{{ asset('js/dataTables/jquery.dataTables.js') }}"></script> 
    <script src="{{ asset('js/dataTables/dataTables.bootstrap.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-sites').dataTable();
        });
    </script>
@endsection
