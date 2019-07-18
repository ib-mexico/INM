function mostrarCampos(id_check){

    var checkBox = $('#check'+id_check)
    var text = $('#contenido'+id_check)

    if (checkBox.is(':checked')){
        text.css('display', 'block')
        calcularSubtotal(id_check)
        calcularTotal(id_check)
        habilitarCampos(id_check)
    } else {
        deshabilitarCampos(id_check)
        text.css('display', 'none')
        SubtotalCero(id_check)
        calcularTotal(id_check)
    }
}

function agregarCampos(id_requision){

    rows = parseInt($('#contenido'+id_requision).data('rows')) + 1;

    campos = '<div class="form-group col-md-12" id="campo'+rows+'">'+
        '<div class="col-md-2"><input class="form-control" min="0" type="number" name="cantidad'+id_requision+'[]"></div>'+
        '<div class="col-md-2"><input class="form-control precio precio'+id_requision+'" min="0" type="number" name="precio'+id_requision+'[]" autocomplete="off"></div>'+
        '<div class="col-md-3"><input class="form-control" type="text" name="n_partes'+id_requision+'[]" autocomplete="off"></div>'+
        '<div class="col-md-4"><input class="form-control" type="text" name="descripcion'+id_requision+'[]" autocomplete="off"></div>'+
        '<div class="col-md-1" ><a class="btn btn-danger" onclick="elimniarCampos('+rows+', '+id_requision+')" href="javascript:void(0)"><i class="fas fa-times"></i></a></div></div>';

    $('#contenido' + id_requision).append(campos);
    $('#contenido'+id_requision).data('rows', rows);
}

function elimniarCampos(id_campo, id_pregunta){
    $('#campo'+id_campo).remove();

    calcularTotal()
    calcularSubtotal(id_pregunta)
}

function anterior(id_pregunta){
    var num_preguntas = parseInt($('form').data('rows'));

    if(id_pregunta == 1){
        alert('Se encuentra en la primera pregunta.');
    }else{
        $('#pregunta'+id_pregunta).css('display', 'none')
        id_pregunta -= 1;
        $('#pregunta'+id_pregunta).css('display', 'block')
    }

    if(id_pregunta != num_preguntas){
        $('.siguiente').css('display', 'inline-block')
        $('.guardar').css('display', 'none')
    }
}

function siguiente(id_pregunta){
    var num_preguntas = parseInt($('form').data('rows'));

    if(num_preguntas == (id_pregunta + 1)){
        $('#pregunta'+id_pregunta).css('display', 'none')
        id_pregunta += 1;
        $('#pregunta'+id_pregunta).css('display', 'block')

        $('.siguiente').css('display', 'none')

        $('.btn_navegacion').append('<button class="btn btn-success guardar" type="submit" >Guardar</button>')
    }else{
        $('#pregunta'+id_pregunta).css('display', 'none')
        id_pregunta += 1;
        $('#pregunta'+id_pregunta).css('display', 'block')
    }
}

function calcularTotal(){

    var preguntas = parseInt($('form').data('rows'))
    var total = 0

    for (let index = 1; index <= preguntas; index++) {
        calcularSubtotal(index)

        total += calcularSubtotal(index)
    }

    $('#total').html(total)
}

function calcularSubtotal(id_pregunta){
    var subtotales = $('.precio'+id_pregunta)
    var precio = 0
    var subtotal = 0
    var checkBox = $('#check'+id_pregunta)

    if (checkBox.is(':checked')){

        for (let index = 0; index < subtotales.length; index++) {

            if (subtotales[index].value == 0) {
                precio = 0
            }else{
                precio = parseInt(subtotales[index].value)
            }

            subtotal += precio;

            $('#subtotal'+id_pregunta).html(subtotal)
        }
    }

    return subtotal
}

function SubtotalCero(id_pregunta){
    var subtotales = $('.precio'+id_pregunta)
        
    $('#subtotal'+id_pregunta).html('0')
}

$(document).on('change', '.precio', function (){

    var preguntas = parseInt($('form').data('rows'))
    var total = 0

    for (let index = 1; index <= preguntas; index++) {
        calcularSubtotal(index)

        total += calcularSubtotal(index)
    }

    calcularTotal()   
})

function deshabilitarCampos(id_pregunta){
    $('#contenido'+id_pregunta+'>div>div>input').prop('disabled', true)
}


function habilitarCampos(id_pregunta){
    $('#contenido'+id_pregunta+'>div>div>input').prop('disabled', false)
}