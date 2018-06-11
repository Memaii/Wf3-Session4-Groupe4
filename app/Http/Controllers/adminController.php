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
			$listboutiques = Shops::get();
			$nbActiveShops = Shops::where('statut_shop', 1)->count();
			return view('admin.boutiques', [ 'nbShops' => $nbShops, 'nbActiveShops' => $nbActiveShops, 'boutiques' => $listboutiques]);
		}else{
			return abort('404');
		}
	}

	// Active une boutique

	public function activeboutique($idb){
		if(Auth::user()->role == 4){
			Shops::where('id_shop', $idb)->update(['statut_shop'=> 2,]);
			$boutique = Shops::select('name_shop')->where('id_shop', $idb)->first();
			return redirect()->back()->with('message', "La boutique ".$boutique['name_shop']." à été activée");
		}else{
			return abort('404');
		}
	}

		// Bannir une boutique
	public function bannirboutique($idb){
		if(Auth::user()->role == 4){
			Shops::where('id_shop', $idb)->update(['statut_shop'=> 0,]);
			$boutique = Shops::select('name_shop')->where('id_shop', $idb)->first();
			return redirect()->back()->with('message', "La boutique ".$boutique['name_shop']." à été bannie");
		}else{
			return abort('404');
		}
	}

		// debannir une boutique
	public function debannirBoutique($idb){
		if(Auth::user()->role == 4){
			Shops::where('id_shop', $idb)->update(['statut_shop'=> 2,]);
			$boutique = Shops::select('name_shop')->where('id_shop', $idb)->first();
			return redirect()->back()->with('message', "La boutique ".$boutique['name_shop']." à été débannie");
		}else{
			return abort('404');
		}
	}

		// Supprime une boutique
	public function supprboutique($idb){
		if(Auth::user()->role == 4){
			$boutique = Shops::where('id_shop', $idb)->first();

			if(!empty($boutique->link_logo)){
				$fichier = public_path('/assets/img/uploads/featured/'.$boutique->link_logo);
				if(file_exists($fichier)){
					unlink($fichier);// suppression du logo de la boutique
				}else{
					echo 'file not found';
				}
			}

			if(!empty($boutique->link_img)){
				$fichier = public_path('/assets/img/uploads/featured/'.$boutique->link_img);
				if(file_exists($fichier)){
					unlink($fichier);// suppression de l'image de la boutique
				}else{
					echo 'file not found';
				}
			}

			if(!empty($boutique->link_min_img)){
				$fichier = public_path('/assets/img/uploads/featured/'.$boutique->link_min_img);
				if(file_exists($fichier)){
					unlink($fichier);// suppression de la miniature de l'image de la boutique
				}else{
					echo 'file not found';
				}
			}

			Shops::destroy($idb);

			return redirect()->back()->with('message', 'Suppression effectuée');
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
			$user = Users::where('id', $id)->first();
			$listeorder = Order::where('client_account_id', $id)->get();

			foreach($listeorder as $order){
				Delivery::where('id', $order->id)->delete();
				Payment::where('id', $order->id)->delete();
				RecapOrder::where('order_id', $order->id)->delete();
				Order::where('id', $order->id)->delete();
			}
			Users::destroy($id);

			return redirect()->back()->with('message', 'Suppréssion efféctuée');
		}else{
			return abort('404');
		}
	}

}
