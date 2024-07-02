<div class="modal fade" id="{{$tipoAntecedente}}"  aria-labelledby="{{$tipoAntecedente}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$tipoAntecedente}}">Añadir antecedente {{$tipoAntecedente}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="añadirAntecedente{{$tipoAntecedente}}" method="post">
                    <input type="hidden" name="idPersona" value="" hidden>

                    <div class="mb-3 form-row">
                        <div class="col">
                            <h6>Tipo de antecedente</h6>
                            <label for="" class="form-label">
                                <input class="form-control" type="text" name="tipo" placeholder="Tipo de antecedente" required>
                            </label>
                        </div>

                        <div class="col">
                            <h6>Descripción</h6>
                            <label for="" class="form-label">
                                <textarea class="form-control" type="text" name="descripcion" placeholder="Descripcion" required></textarea>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        @if ($tipoAntecedente == 'Personal')
                            <input type="hidden" name="idHistorialClinico" value="{{$historial->id}}" hidden>
                            <select name="idAntecedenteFamiliar" id="antecedenteFamiliar" required></select>
                        @endif
    
                        @if ($tipoAntecedente == 'Familiar')
                            <select name="idOtroAsegurado" id="otroAsegurado"></select>
                        @endif
                        
                    </div>
                    <button type="submit" class="btn btn-success ver-mas mx-1">
                        Añadir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>