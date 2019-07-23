function cargarId(id){
    $('#id_requisition').val(id)
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