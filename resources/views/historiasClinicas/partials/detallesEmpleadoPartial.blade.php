@if(isset($historiales))
    <div class="modal fade" id="Detalles" tabindex="-1" aria-labelledby="Detalles" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Detalles">Detalles del Paciente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <h4 class="card-title mt-2 text-center" id='nombreCompleto'>
                            {{-- example: Jóse Perez Marcano Silva --}}
                        </h4>
                        <h6 class="card-title text-center" id='cedula'>C.I
                            {{-- example: 12.345.678 --}}
                        </h6>
                        <div class="card">
                            <div class="col-12">
                                <h6>Antecedentes personales:</h6>
                                <ul id="antecedentesPersonales"></ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="col-12">
                                <h6>Antecedentes familiares:</h6>
                                <ul id="antecedentesFamiliares"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif