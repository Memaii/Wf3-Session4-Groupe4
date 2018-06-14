<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User as Users;
use App\shopModel as Shops;

class utilisateurController extends Controller
{
	// Affiche la page profil d'un utilisateur
	public function utilisateur(){
		if(Auth::user()->role == 0){
			return '<h1 class="text-center">Désoler '.Auth::user()->name.' mais votre compte à été banni pour une durée indéterminer.</h1>';

		}elseif (Auth::user()->role != 0) {
			$infosUser = Users::where('id', Auth::user()->id)->first();
			$infosShop = Shops::where('user_id', Auth::user()->id)->first();
			return view('utilisateur', ['infosUser' => $infosUser, 'infosShop' => $infosShop]);

		}else{
			return abort('404');
		}
	}

	// Page de modification du mot de passe d'un utilisateur
	public function resetPassword(){
		if (Auth::user()->role != 0) {
			$infosUser = Users::where('id', Auth::user()->id)->first();
			return view('resetPassword', ['infosUser' => $infosUser]);
		}else{
			return abort('404');
		}
	}

	// Modification du mot de passe d'un utilisateur
	public function postPassword(Request $donnees){
		if (Auth::user()->role != 0) {
			$infosUser = Users::where('id', Auth::user()->id)->first();
			if(password_verify($donnees['oldPass'], $infosUser->password)){
				Users::where('id', Auth::user()->id)->update(['password'=> Hash::make($donnees['newPass'])]);
				return redirect()->route('utilisateur')->with('message', 'votre mot de passe a été modifié avec succès');
			}else{
				return redirect()->back()->with('message', 'votre ancien mot de passe est incorrect');
			}
		}else{
			return abort('404');
		}
	}
}
