<div class="modal computer-modal" id="computer-modal-add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-title">Nueva Computadora</h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="add-computer" enctype="multipart/form-data" action="{{route('store-computer')}}" role="form">
                    @csrf
                    <div class="form-group">
                        <label for="computer-model-add" class="control-label">Modelo</label>
                        <div class="col">
                            <input type="text" name="model" required class="form-control" id="computer-model-add" placeholder="Modelo">
                        </div>

                        <label for="computer-description-add" class="control-label">Descripción</label>
                        <div class="col">
                            <textarea type="text" name="description" required class="form-control" id="computer-description-add" placeholder="Descripción"></textarea>
                        </div>

                        <label for="computer-brand_id-add" class="control-label">Marca</label>
                        <div class="col">
                            <select required class="custom-select" name="brand_id">
                                <option selected>Selecciona una marca</option>
                                @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="computer-os_id-add" class="control-label">Sistema Operativo</label>
                        <div class="col">
                            <select required class="custom-select" name="os_id">
                                <option selected>Seleccione un sistema Operativo</option>
                                @foreach ($oses as $os)
                                    <option value="{{$os->id}}">{{$os->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="computer-logo-add" class="control-label">Imagen</label>
                        <div class="col">
                            <input type="file" name="logo" required class="form-control-file" id="computer-logo-add">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="add-computer-button" class="submit-form btn btn-primary">Agregar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
