<div id="fondoOscuro" class="modal-backdrop fade show" style="background-color: rgba(0,0,0,0.5); display: none;" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 1050;"></div>
<div class="modal fade w-100 mx-auto" id="{{$tipoAntecedente}}"  aria-labelledby="{{$tipoAntecedente}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$tipoAntecedente}}">Añadir antecedente {{$tipoAntecedente}}</h5>
                <button type="button" id="{{$tipoAntecedente}}Close" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formularioAñadirAntecedente{{$tipoAntecedente}}" method="post">
                    @csrf
                    <input type="hidden" name="idPersona" value="" hidden>

                    <div class="mb-3 form-row">
                        <div class="col">
                            <h6>Tipo de antecedente</h6>
                            <label for="" class="form-label">
                                <input class="form-control" type="text" name="tipo" id="tipoAntecedente{{$tipoAntecedente}}" placeholder="Tipo de antecedente" required>
                                <div class="invalid-text" id="tipoAntecedente{{$tipoAntecedente}}Error"></div>
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
                            <h6>Antecedente Familiar</h6>
                            <select name="idAntecedenteFamiliar" id="antecedenteFamiliar" required></select>
                        @endif
    
                        @if ($tipoAntecedente == 'Familiar')
                        <h6>Familiar asegurado</h6>
                            <select class="form-select" style='width: auto;' name="idOtroAsegurado" id="otroAsegurado"></select>
                        @endif
                        
                    </div>
                    <button class="btn btn-success ver-mas mx-1" id="crearAntecedente" >
                        Añadir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#{{$tipoAntecedente}}Close').on('click', ()=>{
        $('#{{$tipoAntecedente}}').modal('hide')
    })

    $('#tipoAntecedentePersonal').on('input', () => {
        validateText($('#tipoAntecedentePersonal'), /^(?=.{0,180}$)[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/, 'No se permiten número o caracteres especiales y no puede sobrepasar 180 carácteres')
    })

    $('#tipoAntecedenteFamiliar').on('input', () => {
        validateText($('#tipoAntecedenteFamiliar'), /^(?=.{0,255}$)[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/, 'No se permiten número o caracteres especiales  y no puede sobrepasar 180 carácteres')
    })
    
    
    $(document).ready(function() {
        
        $('#formularioAñadirAntecedente{{$tipoAntecedente}}').submit(function(event) {
            event.preventDefault();

            let formData = $(this).serialize();
            // var tipoAntecedente = $(this).find('input[name="tipo"]').val();
            let url = '{{ route("crearAntecedente". $tipoAntecedente ) }}';

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                success: function(data) {
                    // $('#Detalles').modal('hide');
                    detallesClinicos(data.datosPersona);
                    setTimeout(() => {
                        $('#fondoOscuro').removeClass('show');
                        $('#{{$tipoAntecedente}}').modal('hide'); 

                        $('#{{$tipoAntecedente}} input[name="tipo"]').val('');
                        $('#{{$tipoAntecedente}} textarea[name="descripcion"]').val('');  
                    }, 1500)
                    // $('#Detalles').modal('show');
                },
                error: function(xhr, status, error) {
                    alert('Por favor, revise los campos marcados en rojo');
                }
            });
        });
    });
</script>