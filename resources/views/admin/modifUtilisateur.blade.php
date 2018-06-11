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
			<h3 class="text-center">Page d'administration de l'utilisateur :</h3>
			<h3 class="text-center">{{ $infosUser->name }} {{ $infosUser->surname_user }}</h3>
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
			<form method="post" action="{{ route('adminValidModifUtilisateur',['id' => $infosUser->id]) }}" enctype="multipart/form-data">
				{{-- création d'un token --}}
				{{ csrf_field() }}

				<input type="hidden" name="id" value="{{ $infosUser->id }}">

				<div class="row">
					{{-- Nom de l'utilisateur --}}
					<div class="col-2 text-right">
						<label class="form-label" for="surname">Nom</label>
					</div>
					<div class="col-10">
						<input class="form-control" type="text" name="surname" required value="{{ $infosUser->surname_user }}">
					</div>

					{{-- Prenom de l'utilisateur --}}
					<div class="col-2 text-right">
						<label class="form-label" for="name">Prenom</label>
					</div>
					<div class="col-10">
						<input class="form-control" type="text" name="name" required value="{{ $infosUser->name }}">
					</div>

					{{-- Date de naissance de l'utilisateur --}}
					<div class="col-2 text-right">
						<label class="form-label" for="birthDate">Date de naissance</label>
					</div>
					<div class="col-10">
						<input class="form-control" type="date" name="birthDate" required value="{{ $infosUser->birth_date }}">
					</div>
				</div>

				<br>

				<div class="row">
					{{-- mail de l'utilisateur --}}
					<div class="col-2 text-right">
						<label class="form-label" for="mail">e-mail</label>
					</div>
					<div class="col-10">
						<input class="form-control" type="mail" name="mail" required value="{{ $infosUser->email }}">
					</div>
				</div>

				<br>

				<div class="row">
					{{-- choix du role de l'utilisateur --}}
					<div class="col-2 text-right">
						<label class="form-label" for="role">Rôle</label>
					</div>
					<div class="col-10">
						<select class="form-control" name="role" id="role">
							<option value="0"{{ ($infosUser->role == 0) ? ' selected' : '' }}>Banni</option> 
							<option value="1"{{ ($infosUser->role == 1) ? ' selected' : '' }}>Consomateur</option>
							<option value="2"{{ ($infosUser->role == 2) ? ' selected' : '' }}>Vendeur</option>
							<option value="4"{{ ($infosUser->role == 4) ? ' selected' : '' }}>Admin</option>
						</select>
					</div>
				</div>

				<br>

				<div class="row">
					{{-- tél portable de l'utilisateur --}}
					<div class="col-2 text-right">
						<label class="form-label" for="telP">Tél. portable</label>
					</div>
					<div class="col-10">
						<input class="form-control" type="tel" name="telP" value="{{ $infosUser->phone_number }}">
					</div>
					{{-- tél fixe de l'utilisateur --}}
					<div class="col-2 text-right">
						<label class="form-label" for="telF">Tél. fixe</label>
					</div>
					<div class="col-10">
						<input class="form-control" type="tel" name="telF" value="{{ $infosUser->home_phone_number }}">
					</div>
				</div>

				<br>

				<div class="row">
					{{-- adresse de l'utilisateur --}}
					<div class="col-2 text-right">
						<label class="form-label" for="addr">Adresse</label>
					</div>
					<div class="col-10">
						<input class="form-control" type="text" name="addr" value="{{ $infosUser->home_adress }}">
					</div>

					{{-- code postal de l'utilisateur --}}
					<div class="col-2 text-right">
						<label class="form-label" for="zip">Code postal</label>
					</div>
					<div class="col-10">
						<input class="form-control" type="text" name="zip" value="{{ $infosUser->zip_code_user }}">
					</div>

					{{-- ville de l'utilisateur --}}
					<div class="col-2 text-right">
						<label class="form-label" for="city">Ville</label>
					</div>
					<div class="col-10">
						<input class="form-control" type="text" name="city" value="{{ $infosUser->city_user }}">
					</div>
				</div>

				{{-- boutton de validation --}}
				<br>
				<div class="text-center">
					<button class="btn btn-primary" type="submit">Valider</button>
					<a class="btn btn-link" href="{{URL::to('/')}}/admin/utilisateurs">Retour</a>
				</div>
			</form>
		</div>
	</section>
	<section class="row">
		<div class="col-12">
			<p>date de création : {{ $infosUser->created_at }}</p>
			<p>dernière modification : {{ $infosUser->updated_at }}</p>
		</div>
	</section>
</main>
@endsection