<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\File;
use Illuminate\Support\Facades\Storage; //Importamos el facade para mostrar el storage
use Intervention\Image\Facades\Image; //Importamos el paquete intervention
use Illuminate\Support\Str; //Importar el paquete Str

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::where('user_id',auth()->user()->id)->paginate(12); // Mostrar solo las imágenes que fueron subidas por el usuario registrado.
        return view('admin.files.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Intervention image
        $nombre = Str::random(10) . '_' . $request->file('file')->getClientOriginalName(); //Nombre del archivo
        $rutaConfigurada = 'imagenes/' . $nombre;
        $ruta = storage_path('app/public/' . $rutaConfigurada); //✅Ruta del archivo
        // $ruta = storage_path().'\app\public\imagenes/'.$nombre; //❎Ruta del archivo
        //Tamaño del archivo
        Image::make($request->file('file'))->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($ruta);

        File::create([
            'user_id' => auth()->user()->id, //Obtenemos el id del usuario que se logeó
            // 'url' => 'storage/public'.$ruta ❎
            'url' => $rutaConfigurada,
        ]);

        // El modo básico

        // Validar el archivo - requerido|Tipo|Tamaño
        // $request->validate([
        //     'file' => 'required|image|max:2048'
        // ]);
        // return $request->all(); //Capturar lo que enviamos.
        // return $request->file('file'); //Mostrar donde está almacenado mi archivo.
        // return $request->file('file')->store(''); //Almacenar en el storage.
        // return $request->file('file')->store('public/Imagenes'); //Redireccionar a la carpeta public

        // $imagenes = $request->file('file')->store('public/Imagenes');
        // $url = Storage::url($imagenes); //Cambiamos el public por storage.
        // return $url; //Mostrar Ubicación del archivo.

        // Almacenarlo en la BD :
        // File::create([
        //     'url' => $url
        // Nota. Tenemos que agregar la propiedad fillable para que no genere errores.
        // Agregamos en el modelo que creamos.
        // ]);

        // Al usar dropzone quitamos el redirect:
        // return redirect()->route('admin.files.index'); //Retorna al url index.
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($file) //Variable del controlador
    {
        return view('admin.files.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($file)
    {
        return view('admin.files.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file) //Recuperar el registro de esa imágen
    {
        // $file = File::where('id', $file)->first(); //Recuperar el registro de esa imágen
        // Eliminar la imágen de la carpeta storage:
        $url = str_replace('storage', 'public', $file->url);
        Storage::delete($url);
        // Eliminar del registro de la BD:
        $file->delete();
        // Retornar al index y mandamos un mensaje de sesion:
        return redirect()->route('admin.files.index')->with('Eliminar','Ok');
    }
}
