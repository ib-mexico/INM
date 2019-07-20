function mostrarCampos(id_check) {
    /**
     *      SE MUESTRAN/OCULTAN LOS CAMPOS
     *      SE CALCULAN LOS TOTALES AUTOMATICAMENTE CUANDO SE CAMBIA EL ESTADO DE LOS INPUT A DISABLE
     *      id_check = El numero de check segun la pregunta.
     */
    var num_preguntas = parseInt($('form').data('rows'))
    var checkBox = $('#check'+id_check)
    var campos = $('#contenido'+id_check)

    if (checkBox.is(':checked')) {
        campos.css('display', 'block')
        habilitarCampos(id_check)
    } else {
        campos.css('display', 'none')
        deshabilitarCampos(id_check)
        subtotalCero(id_check)
    }

    if (num_preguntas == id_check) {
        validacionBtnGuardar(id_check)
    }
}

function agregarCampos(id_requision) {
    /**
     *  SE AGREGA UNA FILA DE CAMPOS Y SE AUMENTA EL NUMERO DE FILAS EN EL data-rows
     */
    rows = parseInt($('#contenido'+id_requision).data('rows')) + 1;

    campos = '<div class="form-group col-md-12" id="campo'+rows+'">'+
        '<div class="col-md-2"><input class="form-control cantidad cantidad'+id_requision+'" min="0" type="number" name="cantidad'+id_requision+'[]"></div>'+
        '<div class="col-md-2"><input class="form-control precio precio'+id_requision+'" min="0" type="number" step="any" name="precio'+id_requision+'[]" autocomplete="off"></div>'+
        '<div class="col-md-3"><input class="form-control" type="text" name="n_partes'+id_requision+'[]" autocomplete="off"></div>'+
        '<div class="col-md-4"><input class="form-control" type="text" name="descripcion'+id_requision+'[]" autocomplete="off"></div>'+
        '<div class="col-md-1" ><a class="btn btn-danger" onclick="elimniarCampos('+rows+', '+id_requision+')" href="javascript:void(0)"><i class="fas fa-times"></i></a></div></div>';

    $('#contenido' + id_requision).append(campos);
    $('#contenido'+id_requision).data('rows', rows);
}

function elimniarCampos(id_campo) {
    /**
     *  SE ELIMINA LA FILA Y SE RECALCULAN LOS TOTALES
     */
    $('#campo'+id_campo).remove();
    calcularTotales()
}

function anterior(id_pregunta) {
    var num_preguntas = parseInt($('form').data('rows'));

    if (id_pregunta == 1) {
        alert('Se encuentra en la primera pregunta.');
    } else {
        $('#pregunta'+id_pregunta).css('display', 'none')
        id_pregunta -= 1;
        $('#pregunta'+id_pregunta).css('display', 'block')
    }
    // SI EN LA ULTIMA PREGUNTA SE DECIDE REGRESAR A LAS ANTERIORES
    if (id_pregunta != num_preguntas) {
        $('.siguiente').css('display', 'inline-block')
        $('input.guardar').remove()
    }
}

function siguiente(id_pregunta) {
    var num_preguntas = parseInt($('form').data('rows'));

    if (num_preguntas == (id_pregunta + 1)) {
        $('#pregunta'+id_pregunta).css('display', 'none')
        id_pregunta += 1;
        $('#pregunta'+id_pregunta).css('display', 'block')

        $('.siguiente').css('display', 'none')
        //SE VALIDA QUE SE TENGA DATOS PARA ENVIAR Y ASI MOSTRAR EL BOTON
        validacionBtnGuardar(num_preguntas)
    } else {
        $('#pregunta'+id_pregunta).css('display', 'none')
        id_pregunta += 1;
        $('#pregunta'+id_pregunta).css('display', 'block')
    }
}

function validacionBtnGuardar(num_preguntas) {
    /**
     *  SE VALIDA SI ES CORRECTA LA INSERCION DE BOTON GUARDAR
     */
    var checked = 0
    var btn_guardar = $('input.guardar')
    var div_final_navegacion = $('#navegacion'+num_preguntas)
    // SE VERIFICA QUE EXISTAN PREGUNTAS CON CHECK EN TRUE
    for (let index = 1; index <= num_preguntas; index++) {
        var checkBox = $('#check'+index)
        
        if (checkBox.is(':checked')) {
            checked++
        }
    }

    if (checked > 0 && btn_guardar.length < 1) {
        div_final_navegacion.append('<input class="btn btn-success guardar" type="submit" value="Guardar" >')
    }

    if (checked == 0) {
        btn_guardar.remove()
    }
}

function calcularTotales() {
    var preguntas = parseInt($('form').data('rows'))
    var total = 0
    //SE CALCULAN TODOS LOS SUBTOTALES
    for (let index = 1; index <= preguntas; index++) {
        total += calcularSubtotal(index)
    }
    // INSERCION DEL TOTAL
    $('#total').html(total.toFixed(2))
}

function calcularSubtotal(id_pregunta) {
    var subtotal = 0
    var checkBox = $('#check'+id_pregunta)
    // SI LA PREGUNTA ESTA SELECCIONADO SE REALIZA LAS OPERACIONES EN LOS INPUTS
    if (checkBox.is(':checked')) {
        var subtotales = $('.precio'+id_pregunta)
        var cantidades = $('.cantidad'+id_pregunta)
        var precio = 0
        // SOLO LOS INPUTS QUE TENGAN UN NUMERO DIFERENTE SE 0 SE USAN PARA EL CALCULO
        for (let index = 0; index < subtotales.length; index++) {

            if (subtotales[index].value == 0 || cantidades[index].value == 0) {
                precio = 0
            } else {
                precio = parseFloat(subtotales[index].value) * parseFloat(cantidades[index].value)
            }

            subtotal += precio;

            $('#subtotal'+id_pregunta).html(subtotal.toFixed(2))
        }
    }

    return subtotal
}

function subtotalCero(id_pregunta) {
    $('#subtotal'+id_pregunta).html('0.00')
}
// CUANDO SE MODIFIQUEN LAS CANTIDADES DE PRECIO Y CANTIDAD
$(document).on('change', ['.precio', '.cantidad'], function () {
    calcularTotales()   
})

/**
 * LOS CAMPOS DE CADA PREGUNTA
 */
function deshabilitarCampos(id_pregunta) {
    $('#contenido'+id_pregunta+'>div>div>input').prop('disabled', true)
}

function habilitarCampos(id_pregunta) {
    $('#contenido'+id_pregunta+'>div>div>input').prop('disabled', false)
}