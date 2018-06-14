<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\listeboutiquesModel as Shops;


class indexController extends Controller
{
    public function accueil(){
    	$shops = Shops::where('statut_shop',2)->paginate(10);

    	return view('welcome', ['shops' => $shops]);
    }
}
