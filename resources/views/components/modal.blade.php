@props(['name', 'title' => 'Formulario', 'route'])

<div class="modal fade" id="{{ $name }}" tabindex="-1" style="display: none; z-index:100000" aria-labelledby="{{ $name }}"
    aria-hidden="true" focusable>
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$name}}Title">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body px-3 py-2">
                <form action="{{ $route }}" method="post">
                    @csrf
                    {{ $slot }}

                    <div class="row mt-2">
                        <div class="col-6 text-center">
                            {{-- <a class="btn-gradient-secondary btn-sm white">Cerrar</a> --}}
                            <button type="reset" class="btn-gradient-secondary btn-sm white" data-dismiss="modal">Cerrar</button>
                        </div>
                        <div class="col-6 text-center">
                            <button type="submit" class="btn-gradient-primary btn-sm white">Registrar</button>
                        </div>
                        {{-- <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
