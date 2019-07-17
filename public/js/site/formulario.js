function mostrarCampos(id_check){

var checkBox = document.getElementById("check"+id_check);
var text = document.getElementById("contenido"+id_check);


    if (checkBox.checked == true){
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }
}

function agregarCampos(id_requision){

    rows = parseInt($('#contenido'+id_requision).data('rows')) + 1;

    campos = '<div class="form-group col-md-12" id="campo'+rows+'">'+
                 '<div class="col-md-2"><label>Cantidad:</label><input class="form-control" type="number" name="cantidad'+id_requision+'[]"></div>'+
                '<div class="col-md-4"><label>Numero de partes: </label><input class="form-control" type="text" name="n_partes'+id_requision+'[]" autocomplete="off"></div>'+
                '<div class="col-md-5"><label>Descripción: </label><input class="form-control" type="text" name="descripcion'+id_requision+'[]" autocomplete="off"></div>'+
                '<div class="col-md-1" style="margin-top: 25px;"><a class="btn btn-danger" onclick="elimniarCampos('+rows+')" href="javascript:void(0)"><i class="fas fa-times"></i></a></div></div>';

    $('#contenido' + id_requision).append(campos);
    $('#contenido'+id_requision).data('rows', rows);
}

function elimniarCampos(id_campo){
    $('#campo'+id_campo).remove();
}


$(document).on('click', '.anterior', function(){
    anterior()
})

function verificar(){
    console.log(id_pregunta)
    if(id_pregunta == 1){
        $('.anterior').css('display', 'none');
    }
}

function anterior(id_pregunta){
    console.log(id_pregunta)
  
    if(id_pregunta == 1){
        alert('Se encuentra en la primera pregunta.');
    }else{
        $('#pregunta'+id_pregunta).css('display', 'none')
        id_pregunta -= 1;
        $('#pregunta'+id_pregunta).css('display', 'block')
    }
}

function siguiente(id_pregunta){
    numero = id_pregunta + 1;
    console.log(numero)

    var validacion = $('#pregunta'+numero)

    if(validacion == null){
        $('.anterior').css('display', 'none')
        $('.siguiente').css('display', 'none')
        alert('Se encuentra en al primera pregunta')
    }else{
        $('#pregunta'+id_pregunta).css('display', 'none')
        id_pregunta += 1;
        $('#pregunta'+id_pregunta).css('display', 'block')
    }
}