<!doctype html>
<html lang="es">
  <head>
@include('resources.backoffice.header')
@include('resources.backoffice.crud.datatable_css')
  </head>

  <style>
img {
  width: 100%;
  height: auto;
}
div   { overflow:hidden; }
    </style>
<div class="container-fluid">
@foreach($recetas as $receta)
<div class="card">
    <h5 class="card-header">{{$receta->seccion}}</h5>
    <div class="card-body">
      <h5 class="card-title">{{$receta->nombre}}</h5>
      <div class="card-text" style="  padding: 5px;
      max-height: 600px;
      max-width: 90%;  display: flex; /*added*/
      flex-direction: column; /*added*/">
        {!! $receta->descripcion !!}
      </div>
    </div>
  </div>
<br><hr><br>
@endforeach

</div>

<?//--------------------------------------------------------/?>
@include('resources.backoffice.footer_script')
@include('resources.backoffice.crud.datatable_script')
</body>
</html>
