<div class="modal fade" id="confirmar" data-backdrop="static" data-keyboard="false" aria-labelledby="confirmar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmar">Sincronización automática</h5>
                
            </div>
            <div class="modal-body">

                <div class="text-center">
                    ¿Está seguro de sincronizar la base de datos?<br><br>
                    Procure hacer un backup de la base de datos antes de ejecutar esta acción
                </div>

                <div class="row">
                    <div class="col-2 m-auto ">
                        <div class="btn-group m-auto">
                            <a href="{{route('sincronizacionAuto')}}" class="btn btn-success btn-sm text-white">
                                Si
                            </a>
            
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">
                                No
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>