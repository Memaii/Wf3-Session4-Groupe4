<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



//Routes admin

//Routes boutique
Route::get('/boutiques', 'boutiquesController@boutiques')->middleware('auth')->name('boutiques');
Route::get('/boutique{slug}', 'boutiqueController@boutique')->middleware('auth')->name('boutique');

Route::get('/boutique/ajoutCommentaire', 'boutiquecommController@boutiquecomm')->middleware('auth')->name('boutiquecomm')

//Routes gestion

Route::get('/gestion/boutique{id}', 'gestionboutiqueController@gestionboutique')->middleware('auth')->name('gestboutique');

Route::get('/gestion/boutique{id}/profil', 'profilboutiqueController@profilboutique')->middleware('auth')->name('profilboutique');

//Routes catégorie

Route::get('/categorie{slug}', 'categorieController@categorie')->middleware('auth')->name('categorie');

//Routes panier

Route::get('/panier', 'panierController@panier')->middleware('auth')->name('panier');

//Routes produits

Route::get('/produits', 'produitsController@produits')->middleware('auth')->name('produits');
Route::get('/produit{slug}', 'produitController@produit')->middleware('auth')->name('produit');
Route::get('/produits/ajoutCommentaires', 'produitsController@ajoutCommentaires')->middleware('auth')->name('ajoutComm');

//Routes utilisateur

Route::get('/utilisateur', 'utilisateurController@utilisateur')->middleware('auth')->name('utilisateur');
Route::get('/utilisateur/modif', 'utilisateurController@modif')->middleware('auth')->name('Modif');
Route::get('/utilisateur/validationmodif', 'utilisateurController@validationModif')->middleware('auth')->name('validModif');
Route::get('/utilisateur/creationboutique', 'utilisateurController@creationBoutique')->middleware('auth')->name('creationBoutique');
Route::get('/utilisateur/desinscription', 'utilisateurController@desinscription')->middleware('auth')->name('Desinscription');
Route::get('/utilisateur/validationdesinscription', 'utilisateurController@validationdesinscription')->middleware('auth')->name('ValidDesincription');
Route::get('/utilisateur/ajoutCommande', 'utilisateurController@ajoutCommande')->middleware('auth')->name('ajoutCommande');
Route::get('/utilisateur/listeCommande', 'utilisateurController@listeCommande')->middleware('auth')->name('listeCommande');
Route::get('/utilisateur/commande/{id}', 'utilisateurController@commande')->middleware('auth')->name('Commande');
//Route connexion
Route::get('/connexion', 'connecController@connexion')->middleware('auth')->name('Connexion');
//Route inscription
Route::get('/inscription', 'connecController@inscription')->middleware('auth')->name('Inscription');