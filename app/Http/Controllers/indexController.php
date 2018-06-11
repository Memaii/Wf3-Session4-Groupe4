<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\shopModel as Shops;
use App\opinionModel as Opinion;

class indexController extends Controller
{
    public function accueil(){
    	$shops = Shops::paginate(10);

    	$note = Opinion::where('type_opinion', '1')->avg('note_opinion');
/*
	    	$note = Opinion::whereColunm([
    						['type_opinion', '=', 1],
    						['type_id', '=', 1 ]
    					])->get();
*/
    	return view('welcome', ['shops' => $shops, 'note' => $note]);
    }
}
