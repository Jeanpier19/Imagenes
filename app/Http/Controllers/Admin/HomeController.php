<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Solicitar autentificación
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // Ingresar desde la carpeta admin
    public function index()
    {
        return view('admin.home');
    }
}
