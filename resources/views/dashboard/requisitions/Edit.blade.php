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
    <div class="col-md-2">
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
    </div>
</div>

<br>
    @foreach ($data['categories'] as $category)

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="col-md-8">
                            <h5>{{ str_replace($arrayMin, $arrayMay, strtoupper($category['name'])) }}</h5>
                        </div>
                        <a href="#"><i class="fas fa-plus-circle"></i></a>
                    </div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-2">Cantidad</div>
                            <div class="col-md-2">Precio</div>
                            <div class="col-md-1">Total</div>
                            <div class="col-md-2">Num. de partes</div>
                            <div class="col-md-4">Descripci&oacute;n</div>
                            <div class="col-md-1"></div>
                        </div>

        
                            @foreach ($category['lstRequisitionData'] as $lista)
                                @php
                                    $precio = floatval($lista->price);
                                    $cantidad = floatval($lista->quantity);
                                    $total_articulo = ($cantidad * $precio);
                                @endphp
                                <div class="row">
                                    <div class="col-md-2">
                                        <input class="form-control" type="number" name="" id="" value="{{ $lista->quantity }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input class="form-control" type="number" name="" id="" value="{{ number_format($precio, 2, '.', ',') }}">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="">{{ number_format($total_articulo, 2, '.', ',') }}</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input class="form-control" type="text" name="" id="" value="{{ $lista->part_number }}">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" type="text" name="" id="" value="{{ $lista->description }}">
                                    </div>
                                    <div class="col-md-1">
                                        <a href="btn"><i class="fas fa-times-circle"></i></a>
                                    </div>
                                </div>
                                @php
                                    $subtotal = floatval($subtotal) + $total_articulo;
                                @endphp
                            @endforeach 

                    </div>
                </div>
            </div>
        </div>
    
    @endforeach

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