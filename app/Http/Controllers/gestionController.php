<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\shopModel as Shops;
use App\productModel as Product;
use App\link_productModel as LinkProduct;

class gestionController extends Controller
{
    public function ajoutproduits(){
        if(Auth::user()->role == 2){        

    	   return view('gestion.ajoutarticle');
        }else{
            return abort('404');
        }
    }
// Création d'un produit
	public function postproduits(Request $donnees){

		if(Auth::user()->role == 2){
			$validatedData = $donnees->validate([
				'name' => 'required|string|min:5|max:100',
				'description' => 'required|string',
				'image' => 'image|max:500'
			]);

            if($donnees->hasFile('image')){
                $imagePath = time().'i.'.$donnees->image->getClientOriginalExtension();
                $donnees->image->move(public_path('/assets/img/uploads/featured'), $imagePath);
            }            
			$produit = new Product();
			$produit->name_product = $donnees['name'];
			$produit->slug_product = str_slug($donnees['name'],'-');
			$produit->description = $donnees['description'];
			$produit->price_product = $donnees['prix'];
			$produit->statut_product = 0;
			$produit->link_img = $imagePath;
			$produit->save();
			
			$productid = $produit->id;
			
			return redirect()->back()->with('message', 'Produit '.$productid.' créé');
			
		}else{
			return abort('404');
		}
	}

    // formulaire ajout boutique
    public function ajoutboutique(){
        if(Auth::user()->role !=0){        

    	   return view('gestion.ajoutboutique');
        }else{
            return abort('404');
        }
    }

	// Création d'une boutique
	public function postboutique(Request $donnees){
		$logoPath = "";
		$imagePath = "";
		if(Auth::user()->role != 0){
			$validatedData = $donnees->validate([
				'name' => 'required|string|min:5|max:100',
				'siret' => 'required|digits:14|unique:shop,siret',
				'mail' => 'required|email',
				'tel' => 'required|string|max:15',
				'addr' => 'required|string',
				'zip' => 'required|string|max:5',
				'city' => 'required|string',
				'description' => 'required|string',
				'logo' => 'image|max:500',
				'image' => 'image|max:500'
			]);

            if($donnees->hasFile('logo')){
                $logoPath = time().'.'.$donnees->logo->getClientOriginalExtension();
                $donnees->logo->move(public_path('/assets/img/uploads/featured'), $logoPath);
            }
            if($donnees->hasFile('image')){
                $imagePath = time().'i.'.$donnees->image->getClientOriginalExtension();
                $donnees->image->move(public_path('/assets/img/uploads/featured'), $imagePath);
            }            
			$shop = new Shops();
			$shop->name_shop = $donnees['name'];
			$shop->slug_shop = str_slug($donnees['name'],'-');
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
			$shop->lon_shop = $donnees['lon'];
			$shop->user_id = Auth::user()->id;
			$shop->save();
			$shopid = $shop->id_shop;
			
			return redirect()->back()->with('message', 'Boutique '.$shopid.' en attente de validation');
			
			}else{
				return abort('404');
			}
		
	}
}
