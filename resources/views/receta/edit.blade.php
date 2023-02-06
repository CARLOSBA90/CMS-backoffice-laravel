@extends('adminlte::page')
  @section('css')
    @include('resources.backoffice.header')
    @include('resources.backoffice.crud.editor_header')
  @stop 

@section('content')
<div class="m-2">
    <h1 class="bg-info text-white text-center">EDITAR RECETA: {{$receta->id}}</h1>
    <span class="index-loader" id="index-loader" style="display:none;"><div class="lds-ripple"><div></div><div></div></div></span>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route ('recetas.update',$receta->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value='{{$receta->nombre}}'>
    </div>

    <div class="mb-3">
      <label for="seccion" class="form-label">Secci&oacute;n</label>
      <select class="form-select" aria-label="seccion" id="seccion" name="seccion">
        @foreach($receta->secciones as $seccion)
        <option value="{{$seccion->id}}"  @if ($seccion->id=== $receta->seccion_id) selected @endif>{{$seccion->nombre}}</option>
      @endforeach
    </select>
    </div>

      <div class="mb-3" style="display:none;" id="div-editor">
        <label for="descripcion" class="form-label">Descripci&oacute;n</label>
        <textarea class="form-control" id="editor" name="descripcion" rows="10">{{$receta->descripcion}}</textarea>
      </div>

      <div class="mb-3">
        <label for="resumen" class="form-label">Resumen</label>
        <textarea class="form-control" id="resumen" name="resumen" rows="5" maxlength="510" style="resize:none;">{{$receta->resumen}}</textarea>
      </div>
    
      <div class="mb-3">
        <label for="imagen_portada" class="form-label">Imagen Portada</label>
      @if(empty($receta->imagen_portada))
        <input type="file" name="imagen_portada" id="imagen_portada" accept="image/*" class="form-control @error('file') is-invalid @enderror">
      @else
       <span id="span_portada">
        <div style="position:relative;text-align:center;background-color:#0dcaf0; max-height:300px !important; overflow:hidden;">
             <span class="close AClass pointer" data-bs-toggle="modal" data-bs-target="#modalEliminar">
                <span>&times;</span>
              </span>
              <img src="{{ asset('images/portada/') }}/{{$receta->imagen_portada}}"/>
        </div> 
      </span>     
      @endif
    </div>
  
      
    <div class="mb-3">
      <div class="form-check form-switch">
        <label class="switch"><input type="checkbox" id="enabled" name="enabled" value="1" @if($receta->enabled==1) checked @endif><span class="slider round"></span></label>
        <label class="form-check-label" for="enabled">Activo</label>
      </div>
    </div>

      <div class="mb-3">
        <label for="published_at">Fecha Publicaci&oacute;n</label>
        <input type="datetime-local" id="published_at" name="published_at" value='{{$receta->published_at}}'>
    </div>

    <input type="hidden" name="id" id="id" value="{{$receta->id}}"/>
    <input type="hidden" name="nuevo" value="0"/>


     <button type="submit" class="btn btn-success" tabindex="4">Guardar</button>
     <a href="{{route('recetas.index')}}" class="btn btn-primary">Volver</a>
    </form>
</div>

<div class="container mt-2">
  <div class="row">
      <div class="col-md-12">
          <form action="{{ route('dropzone.store') }}" method="post" enctype="multipart/form-data" id="image-upload" class="dropzone">
              @csrf
              <div>
              </div>
          </form>
      </div>
  </div>
</div>

<?//-----------------------MODAL---------------------------/?>

<!-- Modal -->
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Aviso de confirmaci&oacuten</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span id="modal-message">Deseas eliminar la imagen de portada?</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" onclick="eliminarImagen()" data-bs-dismiss="modal">Confirmar</button>
      </div>
    </div>
  </div>
</div>
@stop

  @section('js')
    @include('resources.backoffice.footer_script')
    @include('resources.backoffice.crud.editor_footer')
    <script>


function eliminarImagen(){
  $("#index-loader").show();
const Http = new XMLHttpRequest();
const url="{{route('recetas.index')}}/elimina/portada/"+{{$receta->id}};

//-----LLAMADA AJAX -----//
  Http.open("GET", url);
  Http.send();
  Http.onreadystatechange=function(){
    if(this.readyState==4){
      if(this.status==200 && !parseInt(Http.responseText)){
        alert("Error interno al intentar eliminar portada de la receta ID "+id); /// mejorar mensaje
          }else{
             $("#span_portada").html("<input type='file' name='imagen_portada' id='imagen_portada' accept='image/*' class='form-control'>");
          }
    $("#index-loader").hide();
    }
  }

}
    </script>
  @stop