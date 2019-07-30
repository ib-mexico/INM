$('form.requisitionDataForm').submit( function (e) {
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
        console.log('Error al guardar')
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

function editarDescripcion(id_cat) {
    $('.description'+id_cat).css('display', 'block')
    $('.showDescription'+id_cat).remove()
}

$('form.descriptionDataForm').submit( function (e) {
    e.preventDefault();
    var data = $(this).serializeArray();

    $.ajax({
        url: '../editarDescripcion',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json',
        data: data
    })
    .done(function(a){
        $('#descriptionUpdate'+a.id_requisition).html(a.descripcion)
    })
    .fail(function(a){
        console.log($('#descriptionUpdate'+a.id_requisition))
    })
})
