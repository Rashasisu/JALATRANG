<?php
namespace App\Http\Controllers;

class BerandaController extends Controller
{
    public function index() { return redirect()->route('berita.index'); } // sementara
}