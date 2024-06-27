<div class="modal fade" id="verDetallesAsegurado-{{ $historial->otrosAsegurados->id }}" tabindex="-1" aria-labelledby="verDetallesLabelAsegurado-{{ $historial->otrosAsegurados->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verDetallesLabelAsegurado-{{ $historial->otrosAsegurados->id }}">Detalles del Paciente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <h4 class="card-title mt-2 text-center">Paciente:
                        {{ $historial->otrosAsegurados->personas->nombres . ' ' . $historial->otrosAsegurados->personas->apellidos }}
                    </h4>
                    <h6 class="card-title text-center">Cédula de Identidad:
                        {{ $historial->otrosAsegurados->personas->cedula }}
                    </h6>
                    <div class="card">
                        <div class="col-12">
                            <h6>Antecedentes personales:</h6>
                                @if (!count($historial->otrosAsegurados->personas->antecedentesPersonales) == 0)
                                    @foreach ($historial->otrosAsegurados->personas->antecedentesPersonales as $antPersonal)
                                        <p>{{ $loop->index.'-'.$antPersonal->descripcion }}</p>
                                    @endforeach
                                @else
                                    <p>'No posee'</p>
                                @endif
                            
                        </div>
                    </div>
                    <div class="card">
                        <div class="col-12">
                            <h6>Antecedentes familiares:</h6> 
                                @if (!count($historial->otrosAsegurados->personas->antecedentesPersonales) == 0)
                                    @foreach ($historial->otrosAsegurados->personas->antecedentesPersonales as $antPersonal)
                                        @foreach ($antPersonal->antecedentesFamiliares as $antFamiliar)
                                            <p>{{ $loop->index.'-'.$antFamiliar->descripcion }}</p>
                                        @endforeach
                                    @endforeach
                                    <p>{{$historial->otrosAsegurados->personas->antecedentesPersonales}}</p>
                                @else
                                    <p>No posee</p>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>