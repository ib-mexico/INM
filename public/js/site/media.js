function cargarId(id){
    $('#id_requisition').val(id)

    $.ajax({
        url: 'requisicion/getmedia',
        type: 'GET',
        dataType: 'json',
        data: 'id_requisicion='+id
    })
    .done(function(a){
        $('#fotos').html(a.fotos)
    })
    .fail(function(a){
        console.log('Error al cargar la fotos.')
    })
}

function limpiarFotos(){
    $('#fotos').html('')
}

$('form#images').submit(function(e){

    e.preventDefault();
    var data = $(this).serializeArray();
    alert('envio del form')
    $.ajax({
        url: 'requisicion/media',
        type: 'POST',
        dataType: 'json',
        data: data
    })
    .fail(function(a){
        console.log(a)
    })
    .success(function(){
        console.log('success')
    })
})