<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte de Requisición</title>
    <link rel="stylesheet" type="text/css" href="css/pdf.css" media="screen">
</head>
<body>
    @php
    function fechaCastellano ($fecha) {
        $fecha = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);

        return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
    }   
    
    $arrayMay = array('Á', 'É', 'Í', 'Ó', 'Ú');
    $arrayMin = array('á', 'é', 'í', 'ó', 'ú');
    @endphp

	<div class="container">
        <!-- Titulo -->
		<table width="100%">
			<tr>
				<td width="70%" class="tituloH2">
						REPORTE DE REQUISICIÓN
                </td>
			</tr>
        </table>

        <br>
        <br>

        <!-- Detalles del reporte -->
        <table width="100%" >
            <tr>
                <td class="tituloBoldTH4" width="20%" style="text-align:center">Sitio</td>
                <td class="tituloBoldTH4" width="20%" style="text-align:center">Usuario</td>
                <td class="tituloBoldTH4" width="20%" style="text-align:center">Fecha y hora</td>
            </tr>
            <tr>
                <td class="celdaH4" width="20%" style="text-align:center">{{ $data['name_site'] }}</td>
                <td class="celdaH4" width="20%" style="text-align:center">{{ $data['name_user'] }}</td>
                <td class="celdaH4" width="20%" style="text-align:center">{{ $data['created_at'] }}</td>
            </tr>
        </table>
        
        <br>
        <br>
    
        <!-- Categorias de requisiciones -->
        @foreach ($data['categories'] as $category)
            <table width="100%" cellpadding="2" cellspacing="0">
                <tr>
                    <td colspan="5">
                        <span class="tituloH5">{{ str_replace($arrayMin, $arrayMay, strtoupper($category['name'])) }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="tituloBoldTH5" width="10%" style="text-align:center">CANTIDAD</td>
                    <td class="tituloBoldTH5" width="10%" style="text-align:center">PRECIO</td>
                    <td class="tituloBoldTH5" width="10%" style="text-align:center">TOTAL</td>
                    <td class="tituloBoldTH5" width="20%" style="text-align:center">NUM. DE PARTE</td>
                    <td class="tituloBoldTH5" width="50%" style="text-align:center">DESCRIPCIÓN</td>
                </tr>

                @foreach ($category['lstRequisitionData'] as $lista)
                    <tr>
                        <td class="celdaH5" width="10%" style="text-align:center">{{ $lista->quantity }}</td>
                        <td class="celdaH5" width="10%" style="text-align:center">{{ $lista->price }}</td>
                        <td class="celdaH5" width="20%" style="text-align:center">{{ $lista->part_number }}</td>
                        <td class="celdaH5" width="10%" style="text-align:center">{{ $lista->quantity * $lista->price }}</td>
                        <td class="celdaH5" width="50%" style="text-align:center">{{ $lista->description }}</td>
                    </tr>
                @endforeach
                
            </table>
            <br><br>
        @endforeach

        <table width="100%">
            <tr>
                <td class="tituloH4" colspan="2" width="100%" style="text-align: right">
                    Generado: {{fechaCastellano(date('Y-m-d'))}}
                </td>
            </tr>
        </table>
	</div>

</body>
</html>