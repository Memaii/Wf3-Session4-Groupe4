@extends('layouts.adminlayout')

@section('title', 'Administration du site')

@section('contenu')
<div class="container">
	<section class="row">
		<div class="col-12">
			<h1>Administration du site</h1>
		</div>
	</section>
</div>
<main class="container">
	<section class="row">
		<div class="col-12">
			<h3 class="text-center">Page d'administration de la boutique :</h3>
			<h3 class="text-center">{{ $infosShop->name_shop }}</h3>
		</div>

	{{-- message de retour --}}
		@if(session('message'))
			<div class="col-12 alert alert-success">
				{{ session('message') }}
			</div>
		@endif
	{{-- message de retour --}}
	</section>
	<section class="row">
		<div class="col-12">
			<form method="post" action="{{ route('adminValidModifBoutique',['idb' => $infosShop->id_shop]) }}" enctype="multipart/form-data">
				{{-- création d'un token --}}
				{{ csrf_field() }}

				<input type="hidden" name="id" value="{{ $infosShop->id_shop }}">

				<div class="row">
					{{-- Nom de la boutique --}}
					<div class="col-2 text-right">
						<label class="form-label" for="name">Nom</label>
					</div>
					<div class="col-10">
						<input class="form-control" type="text" name="name" required value="{{ $infosShop->name_shop }}">
					</div>
				</div>

				<br>

				<div class="row">
					{{-- Siret de la boutique --}}
					<div class="col-2 text-right">
						<label class="form-label" for="siret">Siret</label>
					</div>
					<div class="col-10">
						<input class="form-control" type="text" name="siret" required value="{{ $infosShop->siret }}">
					</div>
				</div>

				<br>

				<div class="row">
					{{-- mail de la boutique --}}
					<div class="col-2 text-right">
						<label class="form-label" for="mail">e-mail</label>
					</div>
					<div class="col-10">
						<input class="form-control" type="mail" name="mail" required value="{{ $infosShop->mail_shop }}">
					</div>
				</div>

				<br>

				<div class="row">
					{{-- choix du role de la boutique --}}
					<div class="col-2 text-right">
						<label class="form-label" for="role">Rôle</label>
					</div>
					<div class="col-10">
						<select class="form-control" name="role" id="role">
							<option value="0"{{ ($infosShop->statut_shop == 0) ? ' selected' : '' }}>Banni</option> 
							<option value="1"{{ ($infosShop->statut_shop == 1) ? ' selected' : '' }}>En Attente</option>
							<option value="2"{{ ($infosShop->statut_shop == 2) ? ' selected' : '' }}>Active</option>
							<option value="3"{{ ($infosShop->statut_shop == 3) ? ' selected' : '' }}>Archivée</option>
						</select>
					</div>
				</div>

				<br>

				<div class="row">
					{{-- tél de la boutique --}}
					<div class="col-2 text-right">
						<label class="form-label" for="tel">Tél.</label>
					</div>
					<div class="col-10">
						<input class="form-control" type="tel" name="tel" value="{{ $infosShop->phone_shop }}">
					</div>
				</div>

				<br>

				<div class="row">
					{{-- adresse de la boutique --}}
					<div class="col-2 text-right">
						<label class="form-label" for="addr">Adresse</label>
					</div>
					<div class="col-10">
						<input class="form-control" type="text" name="addr" value="{{ $infosShop->adress_shop }}">
					</div>

					{{-- code postal de la boutique --}}
					<div class="col-2 text-right">
						<label class="form-label" for="zip">Code postal</label>
					</div>
					<div class="col-10">
						<input class="form-control" type="text" name="zip" value="{{ $infosShop->zip_code }}">
					</div>

					{{-- ville de la boutique --}}
					<div class="col-2 text-right">
						<label class="form-label" for="city">Ville</label>
					</div>
					<div class="col-10">
						<input class="form-control" type="text" name="city" value="{{ $infosShop->city_shop }}">
					</div>
				</div>

				<br>

				<div class="row">
					{{-- Déscription de la boutique --}}
					<div class="col-2 text-right">
						<label class="form-label" for="description">Déscription</label>
					</div>
					<div class="col-10">
						<textarea class="form-control" type="text" name="description" required value="{{ $infosShop->description }}">{{ $infosShop->description }}</textarea>
					</div>
				</div>

				{{-- boutton de validation --}}
				<br>
				<div class="text-center">
					<button class="btn btn-primary" type="submit">Valider</button>
					<a class="btn btn-link" href="{{URL::to('/')}}/admin/boutiques">Retour</a>
				</div>
			</form>
		</div>
	</section>
	<section class="row">
		<div class="col-12">
			<p>date de création : {{ $infosShop->created_at }}</p>
			<p>dernière modification : {{ $infosShop->updated_at }}</p>
		</div>
	</section>
</main>
@endsection