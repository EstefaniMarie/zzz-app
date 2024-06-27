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
                            <h4 class="card-title mt-2 text-center">Paciente:
                                {{ $historial->empleados->personas->nombres . ' ' . $historial->empleados->personas->apellidos }}
                            </h4>
                            <h6 class="card-title text-center">Cédula de Identidad:
                                {{ $historial->empleados->personas->cedula }}
                            </h6>
                            {{-- <div class="card">
                                <div class="col-12">
                                    <p>Antecedentes personales: 
                                        {!! 
                                            // !count($historial->empleados->personas->antecedentesPersonales) === 0?
                                            //     $historial->empleados->personas->antecedentesPersonales->descripcion  :
                                            //     'No posee'
                                                $historial->empleados->personas->antecedentesPersonales
                                        !!}
                                    </p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="col-12">
                                    <p>Antecedentes familiares: 
                                        {!! 
                                            // !count($historial->empleados->personas->antecedentesFamiliares) === 0?
                                            //     $historial->empleados->personas->antecedentesFamiliares->descripcion :
                                            //     'No posee'
                                            $historial->empleados->personas->antecedentesFamiliares
                                        !!} 
                                    </p>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- @endif --}}


@endif