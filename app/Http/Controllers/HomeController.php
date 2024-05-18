<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File; // Importamos el modelo File.

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $files = File::all(); // Todos los registro almacenados en la tabla.
        $files = File::paginate(10); // Cantidad de elementos que queremos que nos recupere.
        // return $files;
        return view('welcome', compact('files')); // La vista tendrá acceso a los registros.
    }
}
