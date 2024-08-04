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
                    <input class="form-control" type="file" name="BackupManual_csv" accept=".csv">
                    <button class="btn btn-success my-2" type="submit">Importar CSV</button>
                </form>
            </div>
        </div>
    </div>
</div>