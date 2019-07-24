<!--  Modals-->
<div class="modal fade" id="modalDescription" tabindex="-1" role="dialog" aria-labelledby="modalDate" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Agregar un comentario</h4>
                </div>
                <div class="modal-body">
    
                    <form method="post" action="{{ route('sites.date') }}">
                        @csrf
                        <input type="hidden" value="" name="id_site" id="id_site">
                        <div class="form-group">
                            <label>Precio: </label>
                            <textarea class="form-control" rows="3" name="descripcion" style="width: 435px; height: 89px;"></textarea>
                        </div>
    
                        <div class="form-group text-right">
                            <input type="submit" class="btn btn-success" value="Guardar">
                        </div>
    
                    </form>
            
                </div>
                <!--div class="modal-footer">
                </div-->
            </div>
        </div>
    </div>
    <!-- End Modals-->