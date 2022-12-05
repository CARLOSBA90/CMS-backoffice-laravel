@extends('adminlte::page')

    @section('css')
      @include('resources.backoffice.header')
      @include('resources.backoffice.crud.editor_header')
    @stop 


@section('content')
  <div class="m-2">
      <h1 class="bg-info text-white text-center">NUEVA RECETA</h1>
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  <form action="/recetas" method="POST">
      @csrf
      <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="{{ old('nombre') }}">
      </div>

      <div class="mb-3">
        <label for="seccion" class="form-label">Secci&oacute;n</label>
        <select class="form-select" aria-label="seccion" id="seccion" name="seccion">
          @foreach($response->secciones as $seccion)
          <option value="{{$seccion->id}}" >{{$seccion->nombre}}</option>
        @endforeach
      </select>
      </div>

        <div class="mb-3" id="div-editor">
          <label for="descripcion" class="form-label">Descripci&oacute;n</label>
          <textarea class="form-control" id="editor" name="descripcion" rows="10">{{ old('descripcion') }}</textarea>
        </div>
      

      <div class="mb-3">
        <div class="form-check form-switch">
          <label class="switch"><input type="checkbox" id="enabled" name="enabled" value="1"><span class="slider round"></span></label>
          <label class="form-check-label" for="enabled">Activo</label>
        </div>
      </div>

        <div class="mb-3">
          <label for="published_at">Fecha Publicaci&oacute;n</label>
          <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at') }}">
      </div>
    
      <input type="hidden" name="id" id="id" value="{{$response->randomID}}"/>
      <input type="hidden" name="nuevo" value="1"/>

      <button type="submit" class="btn btn-success" tabindex="4">Guardar</button>
      <a href="/recetas" class="btn btn-primary">Volver</a>
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

@stop

  @section('js')
    @include('resources.backoffice.footer_script')
    @include('resources.backoffice.crud.editor_footer')
  @stop


