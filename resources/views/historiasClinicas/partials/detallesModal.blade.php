<x-slot name="css">
    <link rel="stylesheet" href="{{ asset('update/select2/css/select2.min.css') }}">
</x-slot>
    
<x-slot name="js">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</x-slot>

@if(isset($historiales))
    <div class="modal fade" id="Detalles"  aria-labelledby="Detalles" aria-hidden="true">
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
                                <select style="width: 80%;" id="antecedentesPersonales"></select>

                                <button type="button" class="btn btn-success ver-mas mx-1"
                                    data-toggle="modal"
                                    data-target="#Personal" onclick='antecedentesPersonalesForm("Personal")'>
                                    +
                                </button>
                                @include('historiasClinicas.partials.añadirAntecedenteModal', ['tipoAntecedente' => 'Personal'])
                            </div>
                        </div>
                        <div class="card">
                            <div class="col-12">
                                <h6>Antecedentes familiares:</h6>
                                <select style="width: 80%;" id="antecedentesFamiliares"></select>

                                <button type="button" class="btn btn-success ver-mas mx-1"
                                    data-toggle="modal"
                                    data-target="#Familiar" onclick='antecedentesFamiliaresForm("Familiar")'>
                                    +
                                </button>
                                @include('historiasClinicas.partials.añadirAntecedenteModal', ['tipoAntecedente' => 'Familiar'])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif