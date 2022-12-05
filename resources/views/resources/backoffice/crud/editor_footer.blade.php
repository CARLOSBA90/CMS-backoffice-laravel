<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script> 
  let neditor = null;
ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
                   neditor = editor;
               })
        .catch( error => {
            console.error( error );
        } );
$("#div-editor").fadeIn();

Dropzone.options.imageUpload = {
            maxFilesize         :       1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif"
        };


    function insertarImagen(ele){
    var descripcion  = $(ele).find('span.nombreImagen').text();
    var nombre       = $(ele).find('input.filename').val(); 
    const Http = new XMLHttpRequest();
    const id   = $("#id").val();

    const url  = "/recetas/imagen/"+id+"/"+nombre+"/"+descripcion;
          //-----LLAMADA AJAX -----//
            Http.open("GET", url);
            Http.send();
            Http.onreadystatechange=function(){
              if(this.readyState==4){
                if(this.status==200 && !parseInt(Http.responseText)){
                  alert("Error al intentar insertar los campos en la BBDD "+id); /// mejorar mensaje
              }
            }
        }

    neditor.execute( 'insertImage', { source: path+'/'+nombre  } );
    $(ele).prop("onclick", null).off("click"); ///T0D0 check
    }


    var path = "{{ asset('images') }}";

</script>
