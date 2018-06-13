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

Route::get('/', 'indexController@accueil')->name('accueil');
// ne pas toucher
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

//Routes admin
Route::prefix('admin')->group(function(){

	// géréral
	Route::get('/', 'adminController@admin')->middleware('auth')->name('admin');

	// boutiques
	Route::get('/boutiques', 'adminController@adminboutiques')->middleware('auth')->name('adminboutiques');
	Route::get('/boutiques/{idb}', 'adminController@adminboutique')->middleware('auth')->name('adminboutique');
	Route::get('/boutiques/{idb}/active', 'adminController@activeboutique')->middleware('auth')->name('activeboutique');
	Route::get('/boutiques/{idb}/profil', 'adminController@adminprofilboutique')->middleware('auth')->name('adminprofilboutique');
	Route::get('/boutiques/{idb}/bannir', 'adminController@bannirBoutique')->middleware('auth')->name('bannirBoutique');
	Route::get('/boutiques/{idb}/debannir', 'adminController@debannirBoutique')->middleware('auth')->name('debannirBoutique');
	Route::get('/boutiques/{idb}/profil/modif', 'adminController@adminModifBoutique')->middleware('auth')->name('adminModifBoutique');
	Route::post('/boutiques/{idb}/profil/validmodif', 'adminController@adminValidModifBoutique')->middleware('auth')->name('adminValidModifBoutique');
	Route::get('/boutiques/{idb}/suppr', 'adminController@supprboutique')->middleware('auth')->name('supprboutique');
	Route::get('/boutiques/{idb}/produits', 'adminController@produitsboutique')->middleware('auth')->name('prodboutique');
	Route::get('/boutiques/{idb}/produits/{idp}/modification', 'adminController@produitsmodif')->middleware('auth')->name('prodmodif');
	Route::get('/boutiques/{idb}/produits/{idp}/validmodification', 'adminController@validmodif')->middleware('auth')->name('validModif');
	Route::get('/boutiques/{idb}/produits/{idp}/suppressionn', 'adminController@produitssuppression')->middleware('auth')->name('prodsuppr');

	// utilisateurs
	Route::get('/utilisateurs', 'adminController@adminUtilisateurs')->middleware('auth')->name('adminUtilisateurs');
	Route::get('/utilisateur/{id}', 'adminController@adminUtilisateur')->middleware('auth')->name('adminUtilisateur');
	Route::get('/utilisateur/{id}/modif', 'adminController@adminModifUtilisateur')->middleware('auth')->name('adminModifUtilisateur');
	Route::post('/utilisateur/{id}/validModif', 'adminController@adminValidModifUtilisateur')->middleware('auth')->name('adminValidModifUtilisateur');
	Route::get('/utilisateur/{id}/suppresion', 'adminController@adminSuppresionUtilisateur')->middleware('auth')->name('adminSuppresionUtilisateur');
	Route::get('/utilisateur/{id}/validDesinscription', 'adminController@validDesinscriptionUtilisateur')->middleware('auth')->name('validDesinscriptionUtilisateur');

	Route::get('/utilisateur/{id}/bannir', 'adminController@adminBannirUtilisateur')->middleware('auth')->name('adminBannirUtilisateur');
	Route::get('/utilisateur/{id}/debannir', 'adminController@adminDebannirUtilisateur')->middleware('auth')->name('adminDebannirUtilisateur');
});


//Routes boutique
Route::get('/boutiques', 'boutiqueController@boutiques')->middleware('auth')->name('boutiques');
Route::get('/boutique/{id}', 'boutiqueController@boutique')->middleware('auth')->name('boutique');
Route::get('/boutique/ajoutCommentaire', 'boutiqueController@boutiquecomm')->middleware('auth')->name('boutiquecomm');


//Routes gestion
Route::prefix('gestion')->group(function(){
	Route::get('/boutique/ajout', 'gestionController@ajoutboutique')->middleware('auth')->name('ajoutboutique');
	Route::post('/boutique/post', 'gestionController@postboutique')->middleware('auth')->name('postboutique');	
	Route::get('/boutique/{idb}', 'gestionController@gestionboutique')->middleware('auth')->name('gestboutique');
	Route::get('/boutique/{idb}/profil', 'gestionController@profilboutique')->middleware('auth')->name('profilboutique');
	Route::get('/boutique/{idb}/profil/modif', 'gestionController@userModifBoutique')->middleware('auth')->name('userModifBoutique');
	Route::get('/boutique/{idb}/profil/validmodif', 'gestionController@userValidModifBoutique')->middleware('auth')->name('userValidModifBoutique');
	Route::get('/boutique/{idb}/produits', 'gestionController@produitsboutique')->middleware('auth')->name('produitsboutique');
	Route::get('/boutique/{idb}/produits/{idp}/modif', 'gestionController@modifproduits')->middleware('auth')->name('modifproduits');
	Route::get('/boutique/{idb}/produits/{idp}/valid', 'gestionController@validModifproduits')->middleware('auth')->name('validodifproduits');
	Route::get('/boutique/{idb}/produits/{idp}/suppr', 'gestionController@supprproduits')->middleware('auth')->name('supprproduits');
});


//Routes catégorie
Route::get('/categorie/{slug}', 'categorieController@categorie')->middleware('auth')->name('categorie');


//Routes panier
Route::get('/panier', 'panierController@panier')->middleware('auth')->name('panier');


//Routes produits
Route::prefix('produits')->group(function(){
	Route::get('/', 'produitsController@produits')->middleware('auth')->name('produits');
	Route::get('/{slug}', 'produitsController@produit')->middleware('auth')->name('produit');
	Route::get('/ajoutCommentaires', 'produitsController@ajoutCommentaires')->middleware('auth')->name('ajoutComm');
});


//Routes utilisateur
Route::prefix('utilisateur')->group(function(){
	Route::get('/', 'utilisateurController@utilisateur')->middleware('auth')->name('utilisateur');
	Route::get('/modif', 'utilisateurController@modif')->middleware('auth')->name('Modif');
	Route::get('/validationmodif', 'utilisateurController@validationModif')->middleware('auth')->name('validModif');
	Route::get('/creationboutique', 'utilisateurController@creationBoutique')->middleware('auth')->name('creationBoutique');
	Route::get('/resetPassword', 'utilisateurController@resetPassword')->middleware('auth')->name('resetPassword');
	Route::post('/postPassword', 'utilisateurController@postPassword')->middleware('auth')->name('postPassword');
	Route::get('/desinscription', 'utilisateurController@desinscription')->middleware('auth')->name('Desinscription');
	Route::get('/validationdesinscription', 'utilisateurController@validationdesinscription')->middleware('auth')->name('ValidDesincription');
	Route::get('/ajoutCommande', 'utilisateurController@ajoutCommande')->middleware('auth')->name('ajoutCommande');
	Route::get('/listeCommande', 'utilisateurController@listeCommande')->middleware('auth')->name('listeCommande');
	Route::get('/commande/{id}', 'utilisateurController@commande')->middleware('auth')->name('Commande');
});


//Route connexion
Route::get('/connexion', 'connecController@connexion')->middleware('auth')->name('Connexion');


//Route inscription
Route::get('/inscription', 'inscriptionController@inscription')->middleware('auth')->name('Inscription');


//Route mentions-légales
Route::get('/mentions-legales', 'footerController@m-l')->middleware('auth')->name('m-l');


//Route vie privée
Route::get('/vie-privee', 'footerController@vie-privee')->middleware('auth')->name('vie-privee');


//Route CGVD
Route::get('/cgdv', 'footerController@cgdv')->middleware('auth')->name('cgdv');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');