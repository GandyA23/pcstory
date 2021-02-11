<div class="modal os-modal" id="os-modal-add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-title">Nuevo sistema operativo</h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="add-os" enctype="multipart/form-data" action="{{route('store-os')}}" role="form">
                    @csrf
                    <div class="form-group">
                        <label for="os-name-add" class="control-label">Nombre</label>
                        <div class="col">
                            <input type="text" name="name" required class="form-control" id="os-name-add" placeholder="Nombre">
                        </div>

                        <label for="os-description-add" class="control-label">Descripción</label>
                        <div class="col">
                            <textarea type="text" name="description" required class="form-control" id="os-description-add" placeholder="Descripción"></textarea>
                        </div>

                        <label for="os-logo-add" class="control-label">Logo</label>
                        <div class="col">
                            <input type="file" name="logo" required class="form-control-file" id="os-logo-add">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="add-os-button" class="submit-form btn btn-primary">Agregar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
