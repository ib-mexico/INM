@extends('dashboard.components.Main')

@section('titulo', 'Requisiciones')

@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-requisitions">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Sitio</th>
                        <th class="text-center">Usuario</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($lstRequisitions as $index => $requisition)
                    <tr class="odd gradeX">
                        <td class="text-center">{{ $index+1 }}</td>
                        <td>{{ $requisition->site }}</td>
                        <td>{{ $requisition->user }}</td>
                        <td class="text-center">{{ $requisition->created_at }}</td>
                        <td class="text-center">
                            <a href="{{ URL::to('panel/requisicion/'.$requisition->id_requisition.'/pdf') }}" target="_blank" title="PDF" class="btn"><i class="fas fa-file-pdf"></i></a>
                            <a href="{{ route('requisition.edit', ['id_requisition' => $requisition->id_requisition]) }}" class="btn" title="EDITAR"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn" onclick="cargarId({{$requisition->id_requisition}})" data-toggle="modal" title="IMÁGENES" data-target="#modaImages"><i class="far fa-image"></i></a>
                            <a href="{{ route('requisition.delete', ['id' => $requisition->id_requisition]) }}" class="btn" title="ELIMINAR"><i class="fas fa-times-circle"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('dashboard.requisitions.modals.Images')
@include('dashboard.requisitions.modals.Delete')
@endsection

@section('js')
    <script src="{{ asset('js/jquery3.js') }}"></script> 
    <script src="{{ asset('js/dataTables/jquery.dataTables.js') }}"></script> 
    <script src="{{ asset('js/dataTables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('js/site/media.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-requisitions').dataTable();
        });
    </script>
@endsection