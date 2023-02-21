@extends('adminlte::page')

@section('css')
@include('resources.backoffice.header')
@include('resources.backoffice.crud.editor_header')
@stop

@section('content_header')
    <h1>Configuraci&oacute;n WEB</h1>
@stop

@section('content')
<div class="formCenter">
    <form action="{{route('config.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        @foreach($configs as $config)
            @if(empty($config->select))
              @php  /*Si es Banner, habilita SUBIR/BORRAR*/   @endphp              
                <div class="form-group">
                    <label for="{{$config->llave}}">{{$config->llave}}</label>
                    <input type="text" class="form-control" id="{{$config->llave}}" name="{{$config->llave}}" value="{{$config->valor}}">
                    
                    @if($config->llave=="Banner")
                        <div style="text-align:right;margin:10px;">
                            <button type="button" class="btn btn-danger" tabindex="4"  data-bs-toggle="modal" data-bs-target="#modalEliminar">Borrar</button>
                            <button type="button" class="btn btn-success" tabindex="4" >Cargar</button>
                            <hr>
                        </div>
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
          <span id="modal-message"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-danger" onclick="borrar_banner()">Confirmar</button>
        </div>
      </div>
    </div>
  </div>
@stop

@section('js')
<script>

</script>
@stop