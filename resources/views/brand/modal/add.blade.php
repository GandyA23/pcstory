<div class="modal brand-modal" id="brand-modal-add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-title">Nueva Marca</h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="add-brand" enctype="multipart/form-data" action="{{route('store-brand')}}" role="form">
                    @csrf
                    <div class="form-group">
                        <label for="brand-name-add" class="control-label">Nombre</label>
                        <div class="col">
                            <input type="text" name="name" required class="form-control" id="brand-name-add" placeholder="Nombre">
                        </div>

                        <label for="brand-description-add" class="control-label">Descripción</label>
                        <div class="col">
                            <textarea type="text" name="description" required class="form-control" id="brand-description-add" placeholder="Descripción"></textarea>
                        </div>

                        <label for="brand-logo-add" class="control-label">Logo</label>
                        <div class="col">
                            <input type="file" name="logo" required class="form-control-file" id="brand-logo-add">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="add-brand-button" class="submit-form btn btn-primary">Agregar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
