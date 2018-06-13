<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\shopModel as Shops;
use App\opinionModel as Opinion;
use App\productModel as Pruducts;

class boutiqueController extends Controller
{
    public function boutique($id){
    	// ici on récupère les données de la boutique
    	$shop = Shops::where('id_shop', $id)->first();
    	// ici on récupère les avis sur la boutique

    	// ici on récupère les produits de la boutique
    	$products = Pruducts::where('shop_id_shop', $id)->paginate(9);

    return view('boutique', ['shop' => $shop, 'products' => $products]);
	}
}
