<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\listeboutiquesModel as Shops;
use App\shopModel as Shop;
use App\opinionModel as Opinion;
use App\productModel as Products;

class boutiqueController extends Controller
{
	public function boutiques(){
		// ici on récupère les données des boutiques
		$shops = Shops::where('statut_shop',2)->orderby('name_shop')->paginate(9);

	return view('boutiques', ['shops' => $shops,]);
	}

	public function boutique($id){
		// ici on récupère les données de la boutique
		$shop = Shops::where('id_shop', $id)->first();

		// ici on récupère les produits de la boutique
		$products = Products::where('shop_id_shop', $id)->paginate(9);

	return view('boutique', ['shop' => $shop, 'products' => $products]);
	}
}
