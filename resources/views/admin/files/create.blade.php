@extends('layouts.app')

{{-- Para incluir los cdn del plugin dropzone --}}
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"
        integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Subir Imágenes</h1>
                {{-- <div class="card"> --}}
                    {{-- <div class="card-body"> --}}
                        {{-- enctype: Enviar imágenes --}}
                        {{-- <form action="{{ route('admin.files.store') }}" method="POST" enctype="multipart/form-data"> --}}
                            {{-- Tokken: Mandar formularios --}}
                            {{-- @csrf --}}
                            {{-- <div class="form-group"> --}}
                                {{-- Solo acepte imágenes --}}
                                {{-- <input type="file" name="file" id="" accept="image/*">
                                <br>
                                @error('file')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror --}}
                            {{-- </div> --}}
                            {{-- <button type="submit" class="btn btn-primary">Subir Imágen</button> --}}
                        {{-- </form> --}}
                    {{-- </div> --}}
                {{-- </div> --}}
                
                {{-- Usando dropZone (Ajax) --}}
                <form action="{{ route('admin.files.store') }}"
                    method="POST"
                    class="dropzone"
                    id="my-awesome-dropzone">
                </form>
            </div>
        </div>
    </div>
@endsection

{{-- Para incluir los cdn del plugin dropzone --}}
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    {{-- Modificar el dropzone --}}
    <script>
        Dropzone.options.myAwesomeDropzone = {
            // Para mandar algo adicional dentro del form:
            headers: {
                'X-CSRF-TOKEN' : "{{csrf_token()}}"
            },
            // Mostrar mensaje:
            dictDefaultMessage: '<img src="{{asset('img/uploadImages.png')}}" style="height: 60px;">'
                                +'<h4>Arrastre una imagen al recuadro para subirlo.</h4>'
                                +'<p>No hay un archivo seleccionado.</p>',
            acceptedFiles: "image/*", // Tipo de archivo.
            // maxFilesize: 2, // Tamaño
            maxFiles: 30, // Cantidad
            // paraName: 'picture' //Nombre del name del input
        };
    </script>
@endsection
