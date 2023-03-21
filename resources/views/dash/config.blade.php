@extends('adminlte::page')
@section('css')
@include('resources.backoffice.header')
@include('resources.backoffice.crud.editor_header')
@stop

@section('content_header')
    <h1>Configuraci&oacute;n WEB</h1>
@stop

@section('content')

<span class="index-loader" id="index-loader" style="display:none;"><div class="lds-ripple"><div></div><div></div></div></span>

<div class="formCenter">
    <form action="{{route('config.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        @foreach($configs as $config)
            @if(empty($config->select))
              @php  /*Si es Banner, habilita SUBIR/BORRAR*/   @endphp              
                <div class="form-group">
                    <label for="{{$config->llave}}">{{$config->llave}}</label>
                    <input type="text" class="form-control" id="{{$config->llave}}" name="{{$config->llave}}" value="{{$config->valor}}" 
                            @if($config->llave=="Banner") readonly @endif>
                    
                    @if($config->llave=="Banner")
                      <div style="text-align:right;margin:10px;" id="div_banner">
                       @if(empty($config->valor))
                          <input type="file" id="imagenbanner" accept="image/*" class="form-control @error('file') is-invalid @enderror">
                          <button type="button" class="btn btn-success" tabindex="4" id="cargar_banner">Cargar</button> 
                       @else
                          <button type="button" class="btn btn-danger" tabindex="4"  data-bs-toggle="modal" data-bs-target="#modalEliminar">Borrar</button>
                        @endif
                       </div>
                      <hr>
                    @endif
                </div>
         
             @else
                    @php
                            $selects = [];
                            $selects = explode("-",$config->select);               
                    @endphp
                    <div class="form-group">
                        <label for="{{$config->llave}}">{{$config->llave}}</label>
                        <select class="form-control" id="{{$config->llave}}" name="{{$config->llave}}">
                            @foreach($selects as $select)
                              <option value="{{$select}}">{{$select}}</option>
                            @endforeach
                        </select>
                    </div>

            @endif

         @endforeach


         
         <hr>
         <div style="text-align:center;">
                <button type="submit" class="btn btn-success" tabindex="4" >Guardar</button>
         </div>
    </form>    
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
          <span id="modal-message">¿Deseas borrar la imagen de Banner?</span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-danger" onclick="borrar_banner()" data-bs-dismiss="modal">Confirmar</button>
        </div>
      </div>
    </div>
  </div>
@stop

@section('js')
@include('resources.backoffice.footer_script')
<script>
  
  function borrar_banner(){ 
            $("#index-loader").show();
            const Http = new XMLHttpRequest();
            const url="ebanner";

            //-----LLAMADA AJAX -----//
              Http.open("GET", url);
              Http.send();
              Http.onreadystatechange=function(){
                if(this.readyState==4){
                  if(this.status==200 && (parseInt(Http.responseText)===1)){
                        $("#Banner").val("");
                        $("#div_banner").html("<input type='file' name='imagen_portada' id='imagen_portada' accept='image/*' class='form-control'><button type='button' class='btn btn-success' tabindex='4' id='cargar_banner'>Cargar</button>");
                }else{ alert("Error al intentar eliminar Banner");}
                $("#index-loader").hide();
              }          
            //---------------------///
          }
          }
</script>
@stop