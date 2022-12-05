@extends('adminlte::page')

  @section('css')
    @include('resources.backoffice.header')
    @include('resources.backoffice.crud.datatable_css')
  @stop 

@section('content')
  <div class="container-fluid">
  <h1 class="bg-info text-white text-center">RECETAS</h1>

  <span class="index-loader" id="index-loader" style="display:none;"><div class="lds-ripple"><div></div><div></div></div></span>

  <div class="m-2">
  <a href="recetas/create" class="btn btn-success">Nuevo </a>
  </div>

  <table id="recetas" class="table table-striped table-bordered shadow-lg dt-responsive" style="width:100%">
    <thead class="bg-primary text-white">
      <tr>
        <th scope="col" class="text-center">ID</th>
        <th scope="col">Titulo</th>
        <th scope="col" class="text-center">Secci&oacute;n</th>
        <th scope="col" class="text-center">Fecha Publicaci&oacute;n</th>
        <th scope="col" class="text-center">Estado</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($recetas as $receta)
        <tr>
            <td class="text-center">{{$receta->id}}</td>
            <td id="titulo-{{$receta->id}}">{{$receta->nombre}}</td>
            <td class="text-center">{{$receta->seccion}}</td>
            <td class="text-center">{{$receta->published_at}}</td>
            <td class="text-center"><label class="switch"><input class="enable_button" id="estado-{{$receta->id}}" type="checkbox" value="1" onchange="enable('{{$receta->id}}')" @if($receta->enabled==1) checked @endif><span class="slider round"></span></label></td>
            <td class="text-center"><a class="btn btn-primary" href="/recetas/{{$receta->id}}/edit"> Editar</a></td>

            <td class="text-center">
              <form action="{{ route ('recetas.destroy',$receta->id)}}" method="POST"> <? /*onsubmit="return confirm('Confirma que desea borrar la receta con titulo {{$receta->nombre}}');" enctype="multipart/form-data"*/?>
              @csrf
              @method('DELETE')
              <button type="submit" style="display:none;" id="borrar-{{$receta->id}}"></button>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar" data-bs-whatever="{{$receta->id}}">
                Eliminar
              </button>
              </form>
            </td>
        </tr>

      @endforeach
    </tbody>
  </table>
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
          <button type="button" class="btn btn-danger" onclick="borrar_receta()">Confirmar</button>
          <input type="hidden" id="valor_modalEliminar" value="" />
        </div>
      </div>
    </div>
  </div>
@stop

@section('js')
  @include('resources.backoffice.footer_script')
  @include('resources.backoffice.crud.datatable_script')

  <script>
    $(document).ready(function () {
              $('#recetas').DataTable({
              "lengthMenu": [[25,50,100,-1], [25,50,100,"Todos"]],
              "responsive": true,
              "autoWidth": true,
              "ordering":false,
                //  "processing": true,
                //  "serverSide": true,
                // "columns": [],
                      "language": {
                      "emptyTable":			"<i>No hay datos disponibles en la tabla.</i>",
                      "info":		   		"Del _START_ al _END_ de _TOTAL_ ",
                      "infoEmpty":			"Mostrando 0 registros de un total de 0.",
                      "infoFiltered":			"(filtrados de un total de _MAX_ registros)",
                      "infoPostFix":			"",
                      "lengthMenu":			"Mostrar _MENU_ registros",
                      "loadingRecords":		"Cargando...",
                      "processing":			"Procesando...",
                      "search":			"<span style='font-size:15px;'>Buscar:</span>",
                      "searchPlaceholder":		"Datos a buscar",
                      "zeroRecords":			"No se han encontrado coincidencias.",
                      "paginate": {
                          "first":			"Primera",
                          "last":				"Última",
                          "next":				"Siguiente",
                          "previous":			"Anterior"
                      },
                      "aria": {
                          "sortAscending":	"Ordenación ascendente",
                          "sortDescending":	"Ordenación descendente"
                      }
                  },
            } );
          });

          function borrar_receta(){ $("#borrar-"+$("#valor_modalEliminar").val()).click(); }

          const modalEliminar = document.getElementById('modalEliminar');
                modalEliminar.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const idReceta = button.getAttribute('data-bs-whatever');
                $("#valor_modalEliminar").val(idReceta);
                $("#modal-message").text("¿Deseas eliminar la receta con titulo '"+$("#titulo-"+idReceta).text()+"'?");
              })

          function enable(id){ 
            $(".enable_button").prop('disabled', true);
            $("#index-loader").show();

            const Http = new XMLHttpRequest();
            const url="recetas/enable/"+id;

            //-----LLAMADA AJAX -----//
              Http.open("GET", url);
              Http.send();
              Http.onreadystatechange=function(){
                if(this.readyState==4){
                  if(this.status==200 && !parseInt(Http.responseText)){

                    alert("Error al intentar cambiar el estado de la receta ID "+id); /// mejorar mensaje

                    if($("#estado-"+id).is(":checked")) 
                        $("#estado-"+id).prop("checked", false );
                    else $("#estado-"+id).prop("checked", true );
                      }

                $(".enable_button").prop('disabled', false);
                $("#index-loader").hide();
                }
              }

          
            //---------------------///
          }
    </script>
@stop