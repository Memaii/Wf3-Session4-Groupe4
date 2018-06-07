<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class indexController extends Controller
{
    public function accueil(){
    
    	$titre = "Page d'accueil HTEV";
    	return view('welcome', ['titre' => $titre]);
    }
}
