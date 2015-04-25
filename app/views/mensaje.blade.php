@section('modulo')
<div class="modal active" id="modal1">
  <div class="content">
    <div class="row">
      <div class="ten columns centered text-left">
        <h2>{{ $encabezado }}</h2>
        @foreach($cuerpo as $mensaje)
        <p>{{ $mensaje }}</p>
        @endforeach
        <p class="btn primary medium">
          <a href="javascript: history.go(-1)">Regresar</a>
        </p>
      </div>
    </div>
  </div>
</div>
@stop