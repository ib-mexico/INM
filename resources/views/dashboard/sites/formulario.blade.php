@extends('dashboard.components.main')

@section('titulo', 'Formulario')
@section('sub_pagina', '/ '.$sitio->name)

@section('body')

    <form action="#">
    @foreach ($requisiciones as $requisicion)

        <div class="col-md-12" id="pregunta{{ $requisicion->id_requisition_cat }}" @if ($requisicion->id_requisition_cat != 1) style="display: none" @endif >
            <div class="form-group">
                <h4>¿Requiere {{ $requisicion->name }}?</h4>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" onclick="mostrarCampos({{ $requisicion->id_requisition_cat }})" name="check{{ $requisicion->id_requisition_cat }}" id="check{{ $requisicion->id_requisition_cat }}"> Si
                    </label>
                </div>
            </div>

            <div id="contenido{{ $requisicion->id_requisition_cat }}" style="display: none; margin-bottom: 120px;" data-rows="1">
                <input type="hidden" value="{{ $requisicion->id_requisition_cat }}" name="id_empresa">
                <div class="form-group col-md-12">
                    <div class="col-md-2">
                        <label>Cantidad: </label>
                        <input class="form-control" type="number" name="cantidad{{ $requisicion->id_requisition_cat }}[]">
                    </div>
                    <div class="col-md-4">
                        <label>Numero de partes: </label>
                        <input class="form-control" type="text" name="n_partes{{ $requisicion->id_requisition_cat }}[]" autocomplete="off">
                    </div>
                    <div class="col-md-5">
                        <label>Descripci&oacute;n: </label>
                        <input class="form-control" type="text" name="descripcion{{ $requisicion->id_requisition_cat }}[]" autocomplete="off">
                    </div>
                    <div class="col-md-1" style="margin-top: 25px;">
                        <a href="javascript:void(0)" class="btn btn-default" onclick="agregarCampos({{ $requisicion->id_requisition_cat }})" >+</a>
                    </div>
                </div>
            </div>
            <a href="javascript:void(0)" class="btn btn-default anterior" onclick="anterior({{ $requisicion->id_requisition_cat }})">Anterior</a>
            <a href="javascript:void(0)" class="btn btn-default siguiente" onclick="siguiente({{ $requisicion->id_requisition_cat }})">Siguiente</a>
        </div>
    @endforeach
        
    
    <form>
@endsection

@section('js')
    <script src="{{ asset('js/site/formulario.js') }}"></script>
@endsection