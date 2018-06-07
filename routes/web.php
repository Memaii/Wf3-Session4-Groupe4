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
Route::prefix('admin')->group(function(){

Route::get('/', 'adminController@admin')->middleware('auth')->name('admin');
Route::get('/boutiques', 'adminboutiquesController@adminboutiques')->middleware('auth')->name('adminboutiques');
Route::get('/boutiques/{idb}', 'adminboutiqueController@adminboutique')->middleware('auth')->name('adminboutique');
Route::get('/boutiques/{idb}/profil', 'adminboutiqueController@adminprofilboutique')->middleware('auth')->name('adminprofilboutique');
Route::get('/boutiques/{idb}/profil/modif', 'adminboutiqueController@modifboutique')->middleware('auth')->name('modifboutique');

Route::get('/boutiques/{idb}/profil/validmodif', 'adminboutiqueController@validmodifboutique')->middleware('auth')->name('validmodifboutique');

Route::get('/boutiques/{idb}/produits', 'adminboutiqueController@produitsboutique')->middleware('auth')->name('prodboutique');

Route::get('/boutiques/{idb}/produits/{idp}/modification', 'adminboutiqueController@produitsmodif')->middleware('auth')->name('prodmodif');

Route::get('/boutiques/{idb}/produits/{idp}/validmodification', 'adminboutiqueController@validmodif')->middleware('auth')->name('validModif');

Route::get('/boutiques/{idb}/produits/{idp}/suppressionn', 'adminboutiqueController@produitssuppression')->middleware('auth')->name('prodsuppr');


Route::get('/utilisateurs', 'utilisateursController@utilisateurs')->middleware('auth')->name('utilisateurs');
Route::get('/utilisateur/{id}', 'adminController@utilisateur')->middleware('auth')->name('adminutilisateur');
Route::get('/utilisateur/{id}/modif', 'adminController@modifutilisateur')->middleware('auth')->name('adminmodifutilisateur');
Route::get('/utilisateur/{id}/validModif', 'adminController@valiModifutilisateur')->middleware('auth')->name('adminvalifModifutilisateur');
Route::get('/utilisateur/{id}/suppresion', 'adminController@modifutilisateur')->middleware('auth')->name('adminsuppresionutilisateur');
Route::get('/utilisateur/{id}/validDesinscription', 'adminController@validDesinscriputilisateur')->middleware('auth')->name('validDesinscription');


});
//Routes boutique

Route::get('/boutiques', 'boutiquesController@boutiques')->middleware('auth')->name('boutiques');
Route::get('/boutique{slug}', 'boutiqueController@boutique')->middleware('auth')->name('boutique');

Route::get('/boutique/ajoutCommentaire', 'boutiquecommController@boutiquecomm')->middleware('auth')->name('boutiquecomm')

//Routes gestion
Route::prefix('gestion')->group(function(){

Route::get('/boutique/{id}', 'gestionboutiqueController@gestionboutique')->middleware('auth')->name('gestboutique');
Route::get('/boutique/{id}/profil', 'profilboutiqueController@profilboutique')->middleware('auth')->name('profilboutique');
Route::get('/boutique/{id}/profil/modif', 'modifboutiqueController@modifboutique')->middleware('auth')->name('modifboutique');
Route::get('/boutique/{id}/profil/validmodif', 'validmodifboutiqueController@validmodifboutique')->middleware('auth')->name('validmodifboutique');
Route::get('/boutique/{id}/produits', 'produitsboutiqueController@produitsboutique')->middleware('auth')->name('produitsboutique');
Route::get('/boutique/{id}/produits{id}/modif', 'modifproduitsController@modifproduits')->middleware('auth')->name('modifproduits');
Route::get('/boutique/{id}/produits{id}/valid', 'validModifproduitsController@validModifproduits')->middleware('auth')->name('validodifproduits');
Route::get('/boutique/{id}/produits{id}/suppr', 'supprproduitsController@supprproduits')->middleware('auth')->name('supprproduits');
});
//Routes catégorie

Route::get('/categorie/{slug}', 'categorieController@categorie')->middleware('auth')->name('categorie');

//Routes panier

Route::get('/panier', 'panierController@panier')->middleware('auth')->name('panier');

//Routes produits
Route::prefix('produits')->group(function(){

Route::get('/', 'produitsController@produits')->middleware('auth')->name('produits');
Route::get('/{slug}', 'produitController@produit')->middleware('auth')->name('produit');
Route::get('/ajoutCommentaires', 'produitsController@ajoutCommentaires')->middleware('auth')->name('ajoutComm');
});

//Routes utilisateur

Route::prefix('utilisateur')->group(function(){

Route::get('/', 'utilisateurController@utilisateur')->middleware('auth')->name('utilisateur');
Route::get('/modif', 'utilisateurController@modif')->middleware('auth')->name('Modif');
Route::get('/validationmodif', 'utilisateurController@validationModif')->middleware('auth')->name('validModif');
Route::get('/creationboutique', 'utilisateurController@creationBoutique')->middleware('auth')->name('creationBoutique');
Route::get('/desinscription', 'utilisateurController@desinscription')->middleware('auth')->name('Desinscription');
Route::get('/validationdesinscription', 'utilisateurController@validationdesinscription')->middleware('auth')->name('ValidDesincription');
Route::get('/ajoutCommande', 'utilisateurController@ajoutCommande')->middleware('auth')->name('ajoutCommande');
Route::get('/listeCommande', 'utilisateurController@listeCommande')->middleware('auth')->name('listeCommande');
Route::get('/commande/{id}', 'utilisateurController@commande')->middleware('auth')->name('Commande');

});
//Route connexion

Route::get('/connexion', 'connecController@connexion')->middleware('auth')->name('Connexion');

//Route inscription

Route::get('/inscription', 'connecController@inscription')->middleware('auth')->name('Inscription');

//Route mentions-légales

Route::get('/mentions-légales', 'mentions-legalController@m-l')->middleware('auth')->name('m-l');

//Route vie privée

Route::get('/vie-privee', 'vie-priveeController@vie-privee')->middleware('auth')->name('vie-privee');

//Route CGVD

Route::get('/cgdv', 'cgdvController@cgdv')->middleware('auth')->name('cgdv');