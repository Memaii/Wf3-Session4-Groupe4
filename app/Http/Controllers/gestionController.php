<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\shopModel as Shops;
use App\productModel as Product;
use App\link_productModel as Link_product;

class gestionController extends Controller
{
    public function ajoutproduits(){
        if(Auth::user()->role == 2){        

    	   return view('gestion.ajoutarticle');
        }else{
            return abort('404');
        }
    }
    public function ajoutboutique(){
        if(Auth::user()->role == 2){        

    	   return view('gestion.ajoutboutique');
        }else{
            return abort('404');
        }
    }

	// Création d'une boutique
	public function postboutique(Request $donnees){
		$logoPath = "";
		$imagePath = "";
		if(Auth::user()->role == 2){
			$validatedData = $donnees->validate([
				'name' => 'required|string|min:5|max:100',
				'siret' => 'required|digits:14',
				'mail' => 'required|email',
				'tel' => 'required|string|max:15',
				'addr' => 'required|string',
				'zip' => 'required|string|max:5',
				'city' => 'required|string',
				'description' => 'required|string',
				'logo' => 'required_unless:edit,true|image|max:500',
			//	'image' => 'required_unless:edit,true|image|max:500'
			]);
            if($donnees->hasFile('logo')){
                $logoPath = time().'.'.$donnees->logo->getClientOriginalExtension();
                $donnees->logo->move(public_path('/assets/img/uploads/featured'), $logoPath);
            }
            if($donnees->hasFile('image')){
                $imagePath = time().'.'.$donnees->image->getClientOriginalExtension();
                $donnees->image->move(public_path('/assets/img/uploads/featured'), $logoPath);
            }            
			$shop = new Shops();
			$shop->name_shop = $donnees['name'];
			$shop->siret = $donnees['siret'];
			$shop->mail_shop = $donnees['mail'];
			$shop->statut_shop = 1;
			$shop->phone_shop = $donnees['tel'];
			$shop->adress_shop = $donnees['addr'];
			$shop->zip_code = $donnees['zip'];
			$shop->city_shop = $donnees['city'];
			$shop->description = $donnees['description'];
			$shop->link_logo = $logoPath;
			$shop->link_img = $imagePath;
			$shop->lat_shop = $donnees['lat'];
			$shop->lon_shop = $donnees['lng'];
			$shop->user_id = Auth::user()->id;
			$shop->save();
			$shopid = $shop->id_shop;
			
			return redirect()->back()->with('message', 'Boutique '.$shopid.' créée');
		}else{
			return abort('404');
		}
	}
}
