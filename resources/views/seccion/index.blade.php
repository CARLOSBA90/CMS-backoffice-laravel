@extends('adminlte::page')

    @section('css')
     @include('resources.backoffice.header')
     @include('resources.backoffice.crud.datatable_css')
    @stop 

@section('content')
<div class="container-fluid">
<h1 class="bg-info text-white text-center">SECCIONES</h1>

<span class="index-loader" id="index-loader" style="display:none;"><div class="lds-ripple"><div></div><div></div></div></span>

<div class="m-2">
<a onclick="sModal('0');" class="btn btn-success">Nuevo</a>
</div>

<table id="secciones" class="table table-striped table-bordered shadow-lg dt-responsive" style="width:100%">
  <thead class="bg-primary text-white">
    <tr>
      <th scope="col" class="text-center">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col" class="text-center">Estado</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($secciones as $seccion)
      <tr class="pointer" onclick="sModal('{{$seccion->id}}');"> 
           <td class="text-center">{{$seccion->id}}</td>
           <td id="titulo-{{$seccion->id}}">{{$seccion->nombre}}</td>
           <td class="text-center" onclick=" event.stopPropagation();"><label class="switch"><input class="enable_button" id="estado-{{$seccion->id}}" type="checkbox" value="1" onchange="enable('{{$seccion->id}}')" @if($seccion->enabled==1) checked @endif><span class="slider round"></span></label></td>
           <td class="text-center" onclick="event.stopPropagation();">
            <form action="{{ route ('seccion.destroy',$seccion->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" style="display:none;" id="borrar-{{$seccion->id}}"></button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar" data-bs-whatever="{{$seccion->id}}">
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
        <button type="button" class="btn btn-danger" onclick="borrar_seccion()">Confirmar</button>
        <input type="hidden" id="valor_modalEliminar" value="" />
      </div>
    </div>
  </div>
</div>
<?//--------------------------------------------------------/?>


<?//-----------------------MODAL-EDITAR---------------------------/?>
<!-- Modal -->
<div class="modal fade" id="modalA" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Actualizar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <span id="modal-message">
          <form  id="form_seccion" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="">
            </div>


              <div class="mb-3">
                <div class="form-check form-switch">
                  <label class="switch"><input type="checkbox" id="enabled" name="enabled" value="1"><span class="slider round"></span></label>
                  <label class="form-check-label" for="enabled">Estado</label>
                </div>
              </div>
              
              <input type="hidden" name="id" id="id_a" value="" />
        </form>
         </span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary"  onclick="guardar_seccion()">Actualizar</button>
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

        function borrar_seccion(){ $("#borrar-"+$("#valor_modalEliminar").val()).click(); }

        const modalEliminar = document.getElementById('modalEliminar');
              modalEliminar.addEventListener('show.bs.modal', event => {
              const button = event.relatedTarget;
              const idSeccion = button.getAttribute('data-bs-whatever');
              $("#valor_modalEliminar").val(idSeccion);
              $("#modal-message").text("¿Deseas eliminar la sección con titulo '"+$("#titulo-"+idSeccion).text()+"'?");
            })

        function enable(id){ 
          $(".enable_button").prop('disabled', true);
          $("#index-loader").show();

          const Http = new XMLHttpRequest();
          const url="seccion/enable/"+id;

          //-----LLAMADA AJAX -----//
            Http.open("GET", url);
            Http.send();
            Http.onreadystatechange=function(){
              if(this.readyState==4){
                if(this.status==200 && !parseInt(Http.responseText)){

                  alert("Error al intentar cambiar el estado de la seccion ID "+id); /// mejorar mensaje

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

        function sModal(id){
           if(id=='0') {
               oModal(null);
            return false;
          }

          const xmlhttp = new XMLHttpRequest();
          const url="seccion/"+id+"/edit";
          
          //-----LLAMADA AJAX -----//
          xmlhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                      var response = JSON.parse(this.responseText);
                          oModal(response);
                  }
              };
            xmlhttp.open("GET", url, true);
            xmlhttp.send();     
        }


        function oModal(response){

          $("#nombre").val()!=""?            $("#nombre").val("")                 : null;
          $("#id_a").val()!=""?              $("#id_a").val("")                   : null;
          $("#enabled").is(":checked")?      $("#enabled").prop("checked", false ): null;

           if(typeof response === "object" && response !== null){
                 $("#nombre").val(response.nombre);
                 $("#id_a").val(response.id);
                 if(parseInt(response.enabled)){
                    $("#enabled").prop("checked", true );
                 }else{
                  $("#enabled").prop("checked", false ); 
                 }

           }

           var myModal = new bootstrap.Modal(document.getElementById('modalA'), {
            keyboard: false
          })

           myModal.show();
        }


        function guardar_seccion(){
        
          const id = $("#id_a").val()==""?  0 : $("#id_a").val(); 

          const url = "/seccion/"+id;

                 /// si es editar se coloca PUT, caso contrario, nada

        $.ajaxSetup({
     headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
 });
 
    $.ajax({
    type:'post',
    url:url,
    data:$("#form_seccion").serializeArray(),
    success:function(data){
      if(parseInt(data)===1){
              location.reload();
           }else{
         alert(data);
      }
      }

});

}

  </script>
@stop



