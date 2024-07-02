<x-slot name="css">
    <link rel="stylesheet" href="{{ asset('update/select2/css/select2.min.css') }}">
</x-slot>
    
<x-slot name="js">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('update/select2/js/select2.full.min.js') }}"></script>
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
                                <select class="form-select" style="width: 80%;" id="antecedentesPersonales"></select>
                            </div>
                        </div>
                        <div class="card">
                            <div class="col-12">
                                <h6>Antecedentes familiares:</h6>
                                <select class="form-select" style="width: 80%;" id="antecedentesFamiliares"></select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif