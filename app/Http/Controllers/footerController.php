<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class footerController extends Controller
{
	// Affiche la page des mentions légales
	public function m_l(){
		return view('m_l');
	}

	// Affiche la page de la vie privée
	public function vie_privee(){
		return view('vie_privee');
	}

	// Affiche la page de la CGVD
	public function cgdv(){
		return view('cgdv');
	}
}
