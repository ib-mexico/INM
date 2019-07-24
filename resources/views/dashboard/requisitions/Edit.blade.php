@extends('dashboard.components.Main')

@section('titulo', 'Requisiciones')

@section('sub_pagina', '/ Editar')

@php
    $arrayMay = array('Á', 'É', 'Í', 'Ó', 'Ú');
    $arrayMin = array('á', 'é', 'í', 'ó', 'ú');
    $total_articulo = 0;
    $subtotal = 0;
    $total = 0;
@endphp

@section('body')
<div class="row">
    <div class="col-md-8">
        <h4>{{ $data['name_site'] . " - " .$data['name_user']  }}</h4>
    </div>
    <!--div class="col-md-2">
        <select class="form-control">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </div>
    <div class="col-md-2">
        <a href="#" class="btn">Agregar</a>
    </div-->
</div>

<br>
    @foreach ($data['categories'] as $category)

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>{{ str_replace($arrayMin, $arrayMay, strtoupper($category['name'])) }}</h5>
                    </div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-1 text-center"><label>#</label></div>
                            <div class="col-md-2 text-right"><label>Precio</label></div>
                            <div class="col-md-2 text-right"><label>Total</label></div>
                            <div class="col-md-2"><label>Num. de partes</label></div>
                            <div class="col-md-4"><label>Descripci&oacute;n</label></div>
                            <div class="col-md-1"></div>
                        </div>
        
                        @foreach ($category['lstRequisitionData'] as $lista)
                            @php
                                $precio = floatval($lista->price);
                                $cantidad = floatval($lista->quantity);
                                $total_articulo = ($cantidad * $precio);
                            @endphp

                            <div class="row" id="{{ $lista->id_requisition_data }}">
                                <div class="col-md-1 text-center">{{ $lista->quantity }}</div>
                                <div class="col-md-2 text-right">$ {{ number_format($precio, 2, '.', ',') }}</div>
                                <div class="col-md-2 text-right">$ {{ number_format($total_articulo, 2, '.', ',') }}</div>
                                <div class="col-md-2">{{ $lista->part_number }}</div>
                                <div class="col-md-4">{{ $lista->description }}</div>
                                <div class="col-md-1">
                                    <a href="#" class="btn" onclick="eliminarItem({{ $lista->id_requisition_data }})"><i class="fas fa-times-circle"></i></a>
                                </div>
                            </div>

                            @php
                                $subtotal = floatval($subtotal) + $total_articulo;
                            @endphp
                        @endforeach 
                        <div id="cat{{ $category['id_requisition_cat'] }}" ></div>
                        <hr>
                        <div class="row">
                            {!! Form::open(['route' => 'add-requisition', 'method' => 'POST' , 'id' => 'requisitionDataForm']) !!}
                                <input type="hidden" name="id_requisition" value="{{ $data['id_requisition'] }}">
                                <input type="hidden" name="id_requisition_cat" value="{{ $category['id_requisition_cat'] }}">
                                <div class="col-md-2">
                                    <input class="form-control" type="number" name="cantidad" required  requiered autocomplete="off" placeholder="Cantidad">
                                </div>
                                <div class="col-md-2">
                                    <input class="form-control" type="number" name="precio" step="any" required  requiered autocomplete="off" placeholder="Precio">
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" type="text" name="n_partes" required requiered autocomplete="off" placeholder="Num. de partes">
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" type="text" name="descripcion" requiered autocomplete="off" placeholder="Descripci&oacute;n">
                                </div>
                                <div class="col-md-1">
                                    <input type="submit" value="+" class="btn">
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                                        
                </div>
            </div>
        </div>
        <br><br>
    @endforeach
    
@endsection

@section('js')
    <script src="{{ asset('js/jquery3.js') }}"></script> 
    {{--<script src="{{ asset('js/dataTables/jquery.dataTables.js') }}"></script> 
    <script src="{{ asset('js/dataTables/dataTables.bootstrap.js') }}"></script>--}}
    <script src="{{ asset('js/requisition/edit.js') }}"></script>
    <script>
        $(document).ready(function () {
            //$('#dataTables-requisitions').dataTable();
        });
    </script>
@endsection