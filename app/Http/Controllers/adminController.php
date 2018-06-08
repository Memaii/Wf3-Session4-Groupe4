<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User as Users;
use App\shopModel as Shops;
use App\orderModel as Order;
use App\recap_orderModel as RecapOrder;
use App\paymentModel as Payment;
use App\deliveryModel as Delivery;

class adminController extends Controller
{
// général
	// Affiche la page admin
	public function admin(){
		if(Auth::user()->role == 4){
			$nbUsers = Users::count();
			$nbShops = Shops::count();
			$nbActiveShops = Shops::where('statut_shop', 1)->count();
			return view('admin.admin', ['nbUsers' => $nbUsers, 'nbShops' => $nbShops, 'nbActiveShops' => $nbActiveShops]);
		}else{
			return abort('404');
		}
	}

// boutiques
	// Affiche la page admin boutiques
	public function adminboutiques(){
		if(Auth::user()->role == 4){
			$nbShops = Shops::count();
			$nbActiveShops = Shops::where('statut_shop', 1)->count();
			return view('admin.boutiques', ['nbUsers' => $nbUsers, 'nbShops' => $nbShops, 'nbActiveShops' => $nbActiveShops]);
		}else{
			return abort('404');
		}
	}

// utilisateurs
	// Affiche la page admin utilisateurs
	public function adminUtilisateurs(){
		if(Auth::user()->role == 4){
			$nbUsers = Users::count();
			$infosUsers = Users::orderBy('surname_user', 'ASC')->paginate(20);
			return view('admin.utilisateurs', ['nbUsers' => $nbUsers, 'infosUsers' => $infosUsers]);
		}else{
			return abort('404');
		}
	}

	// Bannir un utilisateur
	public function adminBannirUtilisateur($id){
		if(Auth::user()->role == 4){
			Users::where('id', $id)->update(['role'=> 0,]);
			$nomUser = Users::select('surname_user','name')->where('id', $id)->first();
			return redirect()->back()->with('message', "L'utilisateur ".$nomUser['surname_user']." ".$nomUser['name']." à été banni");
		}else{
			return abort('404');
		}
	}

	// Débannir un utilisateur
	public function adminDebannirUtilisateur($id){
		if(Auth::user()->role == 4){
			Users::where('id', $id)->update(['role'=> 1,]);
			$nomUser = Users::select('surname_user','name')->where('id', $id)->first();
			return redirect()->back()->with('message', "L'utilisateur ".$nomUser['surname_user']." ".$nomUser['name']." à été débanni");
		}else{
			return abort('404');
		}
	}

	// Modifier un utilisateur // à faire plus tard
	public function adminModifUtilisateur(Request $donnees){
		if(Auth::user()->role == 4){
			return 'page à faire';
		}else{
			return abort('404');
		}
	}

	// Valider modification un utilisateur // à faire plus tard
	public function adminValidModifUtilisateur(Request $donnees){
		if(Auth::user()->role == 4){
			return 'page à faire';
		}else{
			return abort('404');
		}
	}

	// Supprime un utilisateur
	public function adminSuppresionUtilisateur($id){
		if(Auth::user()->role == 4){
			$user = Users::where('iduser', $id)->first();
			$listeart = Articles::where('users_iduser', $id)->get();

			foreach($listeart as $art){
				ArthasCateg::where('articles_idarticle', $art->idarticle)->delete();// suppression des liens entre l'article et les catégories
				ArthasMots::where('articles_idarticle', $art->idarticle)->delete();// suppression des liens entre l'article et les mots clés
				Commentaires::where('articles_idarticle', $art->idarticle)->delete();// suppression des commentaires de l'article
				if(!empty($art->featuredimage)){
					$fichier = public_path('/assets/img/uploads/featured/').$art->featuredimage;
					if(file_exists($fichier)){
						unlink($fichier);// suppression de l'image de l'article
					}else{
						echo 'file not found';
					}
				}
				Article::where('idarticle', $art->idarticle)->delete();// suppression de l'article
			}

			Users::destroy($id);// suppression de l'utilisateur

			return redirect()->back()->with('message', 'Suppréssion efféctuée');
		}else{
			return abort('404');
		}
	}
}
