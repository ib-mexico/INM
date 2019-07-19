@extends('dashboard.components.Main')

@section('titulo', 'Sitios')

@section('body')
<div class="col-md-12">
    
    <div class="panel panel-default">
        <div class="panel-heading">
            Ver formulario
        </div>
        <div class="panel-body">
            <div class="list-group">

                @foreach ($sitios as $sitio)
                    <a href="{{ route('sites.form', $sitio->id_site) }}" class="list-group-item">
                        <i class="fa fa-fw fa-circle"></i> {{ $sitio->name }}
                    </a>
                @endforeach
                
            </div>
        </div>
    </div>
        
</div>
@endsection
