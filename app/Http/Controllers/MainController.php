<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Helpers
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{

    public function index()
    {

        // verifica dei dati degli utenti loggati
        // dd([
        //     'utente-loggato' => Auth::user(),
        //     'id-utente-loggato' => Auth::id(),
        //     'verifica-utente-loggato' => Auth::check(),
        // ]);

        return view('welcome');
    }

}
