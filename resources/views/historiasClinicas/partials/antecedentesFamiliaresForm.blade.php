<div class="modal fade" id="addPatologiaModal" aria-labelledby="addPatologiaModal" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body px-3 py-2">
                <form method="POST" action="{{ route('patologia') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="paciente" style="color:black;">Paciente</label>
                                <select class="form-control paciente"
                                    style="width: 29.45rem; !important;" name="id_paciente">
                                    <option value=""></option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="parentesco" style="color:black;">Parentesco</label>
                                <input type="text" class="parentesco form-control" readonly>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="nombre" style="color:black;">Nombre de la Patologia</label>
                                <input type="text" class="form-control" name="nombre">
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="observaciones" style="color:black;">Observaciones</label>
                                <textarea class="form-control" name="observaciones"></textarea>
                            </fieldset>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 text-center">
                                <button type="reset" class="btn-gradient-secondary btn-sm white"
                                    data-dismiss="modal">Cerrar</button>
                            </div>
                            <div class="col-6 text-center">
                                <button type="submit"
                                    class="btn-gradient-primary btn-sm white">Registrar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>