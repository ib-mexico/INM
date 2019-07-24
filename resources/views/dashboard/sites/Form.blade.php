@extends('dashboard.components.Main')

@section('titulo', 'Formulario')
@section('sub_pagina', '/ '.$sitio->instance)

@section('encabezado')
    <h4>Total: $ <span id="total">0.00</span></h4>
@endsection

@section('body')
    {!! Form::open(['route' => 'new-requisition', 'method' => 'POST' , 'id' => 'requisitionForm', 'data-rows' => $num_requisiciones]) !!}
        <input type="hidden" value="{{ $sitio->id_site }}" name="id_site">
        @foreach ($requisiciones as $requisicion)

            <div class="col-md-12" id="pregunta{{ $requisicion->id_requisition_cat }}" @if ($requisicion->id_requisition_cat != 1) style="display: none" @endif >
                <div class="col-md-9">
                    <div class="form-group">
                        <h4>¿Requiere {{ $requisicion->name }}?</h4>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" onclick="mostrarCampos({{ $requisicion->id_requisition_cat }})" name="check{{ $requisicion->id_requisition_cat }}" value="true" id="check{{ $requisicion->id_requisition_cat }}"> Si
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <h5>Subtotal: $ <span id="subtotal{{ $requisicion->id_requisition_cat }}">0.00</span></h5>
                </div>
                <div id="contenido{{ $requisicion->id_requisition_cat }}" style="display: none" data-rows="1">
                    <div class="form-group col-md-12">
                        <div class="col-md-2">
                            <label>Cantidad: </label>
                            <input class="form-control cantidad cantidad{{ $requisicion->id_requisition_cat }}" type="number" min="0" name="cantidad{{ $requisicion->id_requisition_cat }}[]">
                        </div>
                        <div class="col-md-2">
                            <label>Precio: </label>
                            <input class="form-control precio{{ $requisicion->id_requisition_cat }} precio" min="0" value="" type="number" step="any" name="precio{{ $requisicion->id_requisition_cat }}[]" autocomplete="off">
                        </div>
                        <div class="col-md-3">
                            <label>Numero de partes: </label>
                            <input class="form-control n_partes{{ $requisicion->id_requisition_cat }}" type="text" name="n_partes{{ $requisicion->id_requisition_cat }}[]" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label>Descripci&oacute;n: </label>
                            <input class="form-control descripcion{{ $requisicion->id_requisition_cat }}" type="text" name="descripcion{{ $requisicion->id_requisition_cat }}[]" autocomplete="off">
                        </div>
                        <div class="col-md-1" style="margin-top: 25px;">
                            <a href="javascript:void(0)" class="btn btn-default" onclick="agregarCampos({{ $requisicion->id_requisition_cat }})" >+</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-11">
                    <div class="form-group">
                        <h4>Descripci&oacute;n</h4>
                        <input type="text" name="description_requisition{{ $requisicion->id_requisition_cat }}" class="form-control" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-12 btn_navegacion text-right" id="navegacion{{ $requisicion->id_requisition_cat }}">
                    <a href="javascript:void(0)" class="btn btn-default anterior" onclick="anterior({{ $requisicion->id_requisition_cat }})">Anterior</a>
                    <a href="javascript:void(0)" class="btn btn-default siguiente" onclick="siguiente({{ $requisicion->id_requisition_cat }})">Siguiente</a>
                </div>
            </div>

        @endforeach

        
    {!! Form::close() !!}
@endsection

@section('js')
    <script src="{{ asset('js/site/formulario.js') }}"></script>
@endsection