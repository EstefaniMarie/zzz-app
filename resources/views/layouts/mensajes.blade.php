@if(session('success'))
<div class="container">
  <div class="alert alert-success d-flex justify-content-center mt-3 text-center" role="alert">
    <strong class="mr-1">¡Éxito!</strong> {{ session('success') }}
  </div>
</div>
@endif
@if ($errors->any())
    <div class="container">
        <div class="alert alert-danger d-flex justify-content-center mt-3 text-center" role="alert">
          <strong class="mr-1">¡Error!</strong> {{ $errors->first() }}
        </div>
    </div>
@endif