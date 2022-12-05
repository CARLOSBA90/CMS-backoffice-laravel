<!DOCTYPE html>
<html>
<head>
    <link href="{{ asset('css/dropzone/dropzone.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/dropzone/dropzone.min.js') }}"></script>
</head>
<body>
   
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
   
<script type="text/javascript">
        Dropzone.options.imageUpload = {
            maxFilesize         :       1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif"
        };
</script>
   
</body>
</html>