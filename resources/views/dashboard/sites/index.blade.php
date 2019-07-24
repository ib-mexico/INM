@extends('dashboard.components.Main')

@section('titulo', 'Sitios')

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

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
                            <td class="text-center">
                                @php
                                    $btnAgregarFecha = '<a class="btn" data-toggle="modal" onclick="cargarFecha('.$sitio->id_site.')" data-target="#modalDate"><i class="far fa-calendar-plus"></i></a>';
                                    (($sitio->delivery_date == null)? print($btnAgregarFecha) : print($sitio->delivery_date));
                                @endphp
                            </td>
                            <td class="text-center">
                                {{--@php
                                    $btnAgregarComentario = '<a class="btn" data-toggle="modal" onclick="cargarComentario('.$sitio->id_site.')" data-target="#modalDescription"><i class="fas fa-keyboard"></i></a>';
                                    (($sitio->description == null)? print($btnAgregarComentario) : print($sitio->description));
                                @endphp --}}
                            </td>
                            <td class="text-center"><a href="{{ route('sites.form', $sitio->id_site) }}" class="btn"><i class="fas fa-tasks"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
       
    </div>
        
</div>
@include('dashboard.sites.modals.Date')
@include('dashboard.sites.modals.Description')
@endsection

@section('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/dataTables/jquery.dataTables.js') }}"></script> 
    <script src="{{ asset('js/dataTables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('js/site/date.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#dataTables-sites').dataTable()
            $( "#datepicker" ).datepicker()
        });
    </script>
@endsection
