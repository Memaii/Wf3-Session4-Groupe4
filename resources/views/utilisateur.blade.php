@extends('layouts.adminlayout')

@section('title', 'profil')

@section('contenu')
<main class="container">
	<header class="row">
		<div class="col-12">
			<h1 class="text-center">Bienvenue sur votre profil {{$infosUser->name}}</h1>
		</div>
	</header>
	<section class="row">
		<div class="col-4">
			<p>E-mail : {{$infosUser->email}}</p>
			<p>Tel. portable : {{$infosUser->phone_number}}</p>
			<p>Tel. fixe : {{$infosUser->home_phone_number}}</p>
			<p>Adresse : {{$infosUser->home_adress}} {{$infosUser->zip_code_user}} {{$infosUser->city_user}}</p>
			<p>Date de naissance : {{$infosUser->birth_date}}</p>
			<p>Compte crée le : {{$infosUser->created_at}}</p>
		</div>
		<div class="col-4 text-center">
			<h5>{{$infosUser->surname_user}} {{$infosUser->name}}</h5>
			<h5>
				Rang : {{ ($infosUser->role == 1) ? 'utilisateur': ''}}
						{{ ($infosUser->role == 2) ? 'vender': ''}}
						{{ ($infosUser->role == 4) ? 'administrateur': ''}}
			</h5>
		</div>
		<div class="col-4 text-right">
			<p><a type="button" class="btn bgBlue whiteFont" href="{{ route('Modif') }}">modifier profil</a></p>
			<p><a type="button" class="btn bgBlue whiteFont" href="{{ route('listeCommande') }}">historique des commandes</a></p>
			@if(Auth::user()->role == 1)
				<p><a type="button" class="btn bgBlue whiteFont" href="{{ route('ajoutboutique') }}">création d'une boutique</a></p>
			@elseif(Auth::user()->role == 2)
				<p><a type="button" class="btn bgBlue whiteFont" href="{{ route('gestboutique',['slug' => $infosShop->slug_shop])}}">gestion de la boutique</a></p>
			@endif
			<p><a type="button" class="btn bgBlue whiteFont" href="{{ route('resetPassword') }}">changement du mot de passe</a></p>
			<p><a type="button" class="btn btn-danger" href="{{ route('Desinscription') }}">désinscription</a></p>
		</div>

	{{-- message de retour --}}
		@if(session('message'))
			<div class="col-12 alert alert-success">
				{{ session('message') }}
			</div>
		@endif
	{{-- message de retour --}}


	</section>
</main>
@endsection