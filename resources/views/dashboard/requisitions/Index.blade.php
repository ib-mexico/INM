@extends('dashboard.components.Main')

@section('titulo', 'Requisiciones')

@section('body')
<div class="row">
    <div class="col-md-12">
        {{-- dd($lstRequisitions) --}}
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Sitio</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th>Reporte</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lstRequisitions as $requisition)
                        <tr class="odd gradeX">
                            <td>{{ $requisition->site }}</td>
                            <td>{{ $requisition->user }}</td>
                            <td>{{ $requisition->created_at }}</td>
                            <td><a href="{{ URL::to('panel/requisicion/'.$requisition->id_requisition.'/pdf') }}" class="btn btn-default"><i class="fas fa-file-pdf"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>
@endsection