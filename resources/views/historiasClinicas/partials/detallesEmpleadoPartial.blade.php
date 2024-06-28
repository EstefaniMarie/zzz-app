@if(isset($historiales))
    {{-- @if ($historial->empleados) --}}
        <div class="modal fade" id="verDetallesEmpleado-{{ $historial->empleados->id }}" tabindex="-1" aria-labelledby="verDetallesLabelEmpleado-{{ $historial->empleados->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verDetallesLabelEmpleado-{{ $historial->empleados->id }}">Detalles del Paciente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <h4 class="card-title mt-2 text-center">
                                {{ $historial->empleados->personas->nombres . ' ' . $historial->empleados->personas->apellidos }}
                            </h4>
                            <h6 class="card-title text-center">C.I
                                {{ $historial->empleados->personas->cedula }}
                            </h6>
                            <div class="card">
                                <div class="col-12">
                                    <h6>Antecedentes personales:</h6>
                                        @if (!count($historial->empleados->personas->antecedentesPersonales) == 0)
                                            @foreach ($historial->empleados->personas->antecedentesPersonales as $antPersonal)
                                                <p>{{ $loop->index.' - '.$antPersonal->descripcion }}</p>
                                            @endforeach
                                        @else
                                            <p>No posee</p>
                                        @endif
                                    
                                </div>
                            </div>
                            <div class="card">
                                <div class="col-12">
                                    <h6>Antecedentes familiares:</h6> 
                                        @if (!count($historial->empleados->personas->antecedentesFamiliares) == 0)
                                            @foreach ($historial->empleados->personas->antecedentesFamiliares as $antFamiliar)
                                                <p>{{ $loop->index.' - '.$antFamiliar->descripcion }}</p>
                                            @endforeach
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
    {{-- @endif --}}


@endif