<div class="modal fade" id="manualBackup" data-backdrop="static" data-keyboard="false" aria-labelledby="manualBackup" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manualBackup">Sincronización manual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" method="POST" action="{{ route('sincronizacionManual') }}" enctype="multipart/form-data">
                    @csrf
                    <input class="form-control" type="file" name="BackupManual_csv" accept=".csv" required>

                    <div class="mt-3 form-check">
                        <label class="form-check-label" for="flexRadioDefault1">
                          Las tablas permitidas para importación son las siguientes: 
                          <br>Personas, Pacientes, Empleados.<br>
                          Solo se puede importar una a la vez y el archivo csv debe tener el nombre de la tabla a importar en minúsculas.
                        </label>
                    </div>

                    <button class="btn btn-success my-2 text-white" type="submit">Importar CSV</button>
                </form>
            </div>
        </div>
    </div>
</div>