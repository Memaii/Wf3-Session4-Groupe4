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
			$listboutiques = Shops::get();
			return view('admin.boutiques', ['nbShops' => $nbShops, 'nbActiveShops' => $nbActiveShops, 'boutiques' => $listboutiques]);
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

	// Modifier une boutique
	public function adminModifBoutique($id){
		if(Auth::user()->role == 4){
			$infosShop = Shops::where('id_shop', $id)->first();
			return view('admin.modifBoutique', ['infosShop' => $infosShop]);
		}else{
			return abort('404');
		}
	}

	// Valider modification d'une boutique
	public function adminValidModifBoutique($idb, Request $donnees){
		if(Auth::user()->role == 4){
			$validatedData = $donnees->validate([
				'id' => 'required|int',
				'name' => 'required|string|min:5|max:20',
				'siret' => 'required|string|max:14',
				'mail' => 'required|string',
				'role' => 'required|int',
				'tel' => 'nullable|string|max:15',
				'addr' => 'required|string',
				'zip' => 'required|int',
				'city' => 'required|string',
				'description' => 'required|string'
			]);

			Shops::where('id_shop', $donnees['id'])->
			update(['name_shop'=> $donnees['name'],
					'siret'=> $donnees['siret'],
					'mail_shop'=> $donnees['mail'],
					'statut_shop'=> $donnees['role'],
					'phone_shop'=> $donnees['tel'],
					'adress_shop'=> $donnees['addr'],
					'zip_code'=> $donnees['zip'],
					'city_shop'=> $donnees['city'],
					'description'=> $donnees['description'],]);
			return redirect()->back()->with('message', 'Modification efféctuée');
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

	// Modifier un utilisateur
	public function adminModifUtilisateur($id){
		if(Auth::user()->role == 4){
			$infosUser = Users::where('id', $id)->first();
			return view('admin.modifUtilisateur', ['infosUser' => $infosUser]);
		}else{
			return abort('404');
		}
	}

	// Valider modification d'un utilisateur
	public function adminValidModifUtilisateur(Request $donnees){
		if(Auth::user()->role == 4){
			$validatedData = $donnees->validate([
				'id' => 'required|int',
				'surname' => 'required|string|min:5|max:20',
				'name' => 'required|string|min:5|max:20',
				'birthDate' => 'required|date',
				'mail' => 'required|string',
				'role' => 'required|int',
				'telP' => 'nullable|string|max:15',
				'telF' => 'nullable|string|max:15',
				'addr' => 'required|string',
				'zip' => 'required|int',
				'city' => 'required|string'
			]);

			Users::where('id', $donnees['id'])->
			update(['surname_user'=> $donnees['surname'],
					'name'=> $donnees['name'],
					'birth_date'=> $donnees['birthDate'],
					'email'=> $donnees['mail'],
					'role'=> $donnees['role'],
					'phone_number'=> $donnees['telP'],
					'home_phone_number'=> $donnees['telF'],
					'home_adress'=> $donnees['addr'],
					'zip_code_user'=> $donnees['zip'],
					'city_user'=> $donnees['city'],]);
			return redirect()->back()->with('message', 'Modification efféctuée');
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
