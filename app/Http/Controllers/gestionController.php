<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\shopModel as Shops;
use App\productModel as Product;
use App\link_productModel as LinkProduct;
use App\categoryModel as Cat;
use App\sub_categoryModel as Sub_cat;

class gestionController extends Controller
{
// formulaire ajout d'un produit	
	public function ajoutproduits($idb){
		if(Auth::user()->role == 2){
			$cat = Cat::get();
			$sub_cat = Sub_cat::get();
			return view('gestion.ajoutarticle', ['idb' => $idb, 'cats' => $cat, 'sub_cats' => $sub_cat]);
		}else{
			return abort('404');
		}
	}
// Création d'un produit
	public function postproduits(Request $donnees, $idb){

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
			$produit->shop_id_shop = $idb;
			$produit->sub_category_id_sub_category = $donnees['subcat'];
			$produit->stock_product = $donnees['stock'];
			$produit->save();

			$productid = $produit->id;

			$link = new LinkProduct();
			$link->product_id = $productid;
			$link->link_img_product = $imagePath;
			$link->save();

			
			return redirect()->back()->with('message', 'Produit '.$productid.' créé');
			
		}else{
			return abort('404');
		}
	}

// Gestion boutique
	public function gestionboutique($id){
		if(Auth::user()->role ==2){        
			$shop = Shops::where('user_id', Auth::user()->id)->first();

			// ici on récupère les produits de la boutique
			$products = Product::where('shop_id_shop', $shop->id_shop)->paginate(9);

			return view('gestion.gestion', ['shop' => $shop, 'products' => $products]);
			return view('gestion.gestion');
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

		if (isset($donnees['edit']) && $donnees['edit'] == "true") {
			//
			if(Auth::user()->role != 0){
				$validatedData = $donnees->validate([
					'name' => 'required|string|min:1|max:100',
					'siret' => 'required|digits:14|',
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
					if (isset($donnees['oldlogo'])) {
						unlink(public_path('/assets/img/uploads/featured/').$donnees['oldlogo']);
					}	            	
					$logoPath = time().'.'.$donnees->logo->getClientOriginalExtension();
					$donnees->logo->move(public_path('/assets/img/uploads/featured'), $logoPath);
				}
				if($donnees->hasFile('image')){
					if (isset($donnees['oldimg'])) {
						unlink(public_path('/assets/img/uploads/featured/').$donnees['oldimg']);
					}	            	
					$imagePath = time().'i.'.$donnees->image->getClientOriginalExtension();
					$donnees->image->move(public_path('/assets/img/uploads/featured'), $imagePath);
				}            
				$idshop = $donnees['idshop'];
				$shop = Shops::find($idshop);
				$shop->name_shop = $donnees['name'];
				$shop->slug_shop = str_slug($donnees['name'],'-');
				$shop->siret = $donnees['siret'];
				$shop->mail_shop = $donnees['mail'];
				$shop->phone_shop = $donnees['tel'];
				$shop->adress_shop = $donnees['addr'];
				$shop->zip_code = $donnees['zip'];
				$shop->city_shop = $donnees['city'];
				$shop->description = $donnees['description'];
				$shop->link_logo = (isset($logoPath)) ? $logoPath : $donnees['oldlogo'];
				$shop->link_img = (isset($imagePath)) ? $imagePath : $donnees['oldimg'];
				$shop->lat_shop = $donnees['lat'];
				$shop->lon_shop = $donnees['lon'];
				$shop->update();
				$boutique = $shop->name_shop;
				
				return redirect()->back()->with('message', 'Boutique '.$boutique.' modifiée');
				
			}else{
				return abort('404');
			}			
		}else{	
			if(Auth::user()->role != 0){
				$validatedData = $donnees->validate([
					'name' => 'required|string|min:1|max:100',
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
}
