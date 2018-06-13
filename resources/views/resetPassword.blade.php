@extends('layouts.adminlayout')

@section('title', 'profil')

@section('contenu')
<main class="container">
	<header class="row">
		<div class="col-12">
			<h1 class="text-center">Réinisialisation de votre mot de passe {{Auth::user()->name}}</h1>
		</div>
	</header>
	<section class="row">
		<div class="col-12">
			<form method="post" action="{{ route('postPassword') }}" enctype="multipart/form-data">
				{{-- création d'un token --}}
				{{ csrf_field() }}

				{{-- ancien mot de passe --}}
				<div class="text-center">
					<label class="form-label" for="oldPass">Ancien mot de passe</label>
				</div>
				<div class="text-center">
					<input type="text" name="oldPass" required>
				</div>

				{{-- nouveau mot de passe --}}
				<div class="text-center">
					<label class="form-label" for="newPass">Nouveau mot de passe</label>
				</div>
				<div class="text-center">
					<input type="text" name="newPass" required>
				</div>

				{{-- nouveau mot de passe bis --}}
				<div class="text-center">
					<label class="form-label" for="newPassBis">Nouveau mot de passe bis</label>
				</div>
				<div class="text-center">
					<input type="text" name="newPassBis" required>
				</div>

				{{-- boutton de validation --}}
				<br>
				<div class="text-center">
					<button class="btn btn-primary" type="submit">Valider</button>
					<a class="btn btn-link" href="{{URL::to('/')}}/utilisateur">Retour</a>
				</div>
			</form>
		</div>
	</section>
	{{-- message de retour --}}
		@if(session('message'))
			<div class="col-12 alert alert-success">
				{{ session('message') }}
			</div>
		@endif
	{{-- message de retour --}}
</main>
@endsection