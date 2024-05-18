@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($files as $file)
                <div class="col-4">
                    <div class="card">
                        <img src="{{ Storage::url($file->url) }}" alt="" class="img-fluid">
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('admin.files.edit', $file) }}" class="btn btn-primary">Editar</a>
                        {{-- Nombramos la clase formulario-eliminar --}}
                        <form action="{{ route('admin.files.destroy', $file) }}" class="d-inline formulario-eliminar"
                            method="POST">
                            {{-- Usamos la directiva delete para aplicar la eliminación --}}
                            @method('DELETE')
                            {{-- Usamos el TOKEN para enviar los datos del formulario --}}
                            @csrf
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $files->links() }}
    </div>
@endsection

@section('js')
    {{-- Para eliminar una imagen usando la confirmación del paquete swal --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('Eliminar') == 'Ok')
        <script>
            Swal.fire({
                title: "¡Eliminado!",
                text: "Tú imagen fue eliminada correctamente.",
                icon: "success"
            });
        </script>
    @endif
    {{-- Usamos la clase nombrada como formulario-eliminar --}}
    <script>
        $('.formulario-eliminar').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta imagen se eliminará permanentemente",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "¡Si, Eliminar!",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>
@endsection
