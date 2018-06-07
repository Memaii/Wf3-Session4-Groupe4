<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\listeUsersModel as ListeUsers;
use App\User as Users;
use App\listeShopsModel as ListeShops;
use App\shopModel as Shops;


class adminController extends Controller
{
    // général
	// Affiche la page admin
	public function accueil(){
		if(Auth::user()->role == 4){
			$nbUsers = Users::count();
			$nbShops = Shops::count();
		}else{
			return abort('404');
		}
	}
}
