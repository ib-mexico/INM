<!--  Modals-->
<div class="modal fade" id="modaImages" tabindex="-1" role="dialog" aria-labelledby="modalImage" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Selecciona tu imagen</h4>
            </div>
            <div class="modal-body">

                <form method="post" id="imagess" action="{{ route('sites.media') }}">
                    @csrf
                    <input type="hidden" value="" name="id_requisition" id="id_requisition">
                    <div class="form-group">
                        <input type="file" name="imagen">
                    </div>
                    <div class="form-group text-right">
                        <input type="submit" class="btn btn-success" value="Cargar">
                    </div>
                </form>
        
            </div>
            <!--div class="modal-footer">
            </div-->
        </div>
    </div>
</div>
<!-- End Modals-->