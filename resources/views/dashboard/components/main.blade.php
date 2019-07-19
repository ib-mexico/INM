<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>INM - @yield('titulo')</title>

        @include('dashboard.components.Css')
        @section('css')
            
        @show
</head>
<body>

<div id="wrapper">
    <!-- /. NAV TOP  -->
    @include('dashboard.components.Nav-top')
    

    <!-- /. NAV SIDE  -->
    @include('dashboard.components.Nav-side')


    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row page-header">
                <div class="col-md-9">
                    <h1>
                        @yield('titulo') <small>@yield('sub_pagina')</small>
                    </h1>
                </div>
                <div class="col-md-3">
                    @section('encabezado')
                    
                    @show
                </div>
            </div> 

            <div class="row">
                @section('body')
                    
                @show
            </div>


            <!-- /. ROW  -->
            <footer><p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez</a></p></footer>
        </div>
            <!-- /. PAGE INNER  -->
    </div>
        <!-- /. PAGE WRAPPER  -->
</div>
    
@include('dashboard.components.Js')

@section('js')
    
@show
</body>
</html>
