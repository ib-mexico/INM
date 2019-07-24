$('form').submit( function (e) {
    e.preventDefault();

    var data = $(this).serializeArray();

    $.ajax({
        url: 'store',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json',
        data: data
    })
    .done(function(a){

        if (a.return) {
            $('#cat'+a.id_cat).append(a.data)
        }else{
            alert('no se pudo guardar')
        }
    })
    .fail(function(a){
        console.log('No se puede eliminar')
    })
})


function eliminarItem(id_requisition_data) {
    $.ajax({
        url: '../deleteData',
        type: 'GET',
        data: 'id_data='+id_requisition_data
    })
    .done(function(a){

        if (a.delete) {
            $('#'+a.id_requisition_data).remove()
        } else {
            alert('No se pudo eliminar')
        }
    })
    .fail(function(a){
        console.log('Error al cargar la fotos.')
    })
}