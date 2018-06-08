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
			<h3 class="text-center">Page d'administration des utilisateurs</h3>
		</div>
		<div class="col-12">
			<p>Nombre total d'inscrit : {{$nbUsers}}</p>
		</div>

	{{-- message de retour --}}
		@if(session('message'))
			<div class="col-12 alert alert-success">
				{{ session('message') }}
			</div>
		@endif
	{{-- message de retour --}}

		<div class="col-2">
			NOM
		</div>
		<div class="col-2">
			PRENOM
		</div>
		<div class="col-4">
			E-MAIL
		</div>
		<div class="col-1">
			ROLES
		</div>
		<div class="col-3 text-center">
			ACTIONS
		</div>

		@foreach($infosUsers as $user)
			<hr class="col-12" style="background-color:black;">
			{{-- nom de l'utilisateur --}}
			<div class="col-2">
			{{ $user->surname_user }}
			</div>
			{{-- prenom de l'utilisateur --}}
			<div class="col-2">
				{{ $user->name }}
			</div>
			{{-- mail de l'utilisateur --}}
			<div class="col-4">
				{{ $user->email }}
			</div>
			{{-- role de l'utilisateur --}}
			<div class="col-1">
				@if($user->role == 0)
					Banni
				@elseif($user->role == 1)
					Consomateur
				@elseif($user->role == 2)
					Vendeur
				@elseif($user->role == 4)
					Admin
				@endif
			</div>
			{{-- bouttons d'actions --}}
			<div class="col-3 text-center">
				{{-- boutton bannir --}}
				@if($user->role != 0)
					@if($user->role != 4)
						<a class="btn btn-warning btn-sm" href="{{ route('adminBannirUtilisateur',['id' => $user->id]) }}">Bannir</a>
					@endif
				@endif

				{{-- boutton bannir --}}
				@if($user->role == 0)
					<a class="btn btn-warning btn-sm" href="{{ route('adminDebannirUtilisateur',['id' => $user->id]) }}">Débannir</a>
				@endif

				{{-- boutton modification --}}
				<a class="btn btn-success btn-sm" href="{{ route('adminModifUtilisateur',['id' => $user->id]) }}">Modifier</a>

				{{-- boutton suppression --}}
				@if($user->role == 0)
					<a class="btn btn-danger btn-sm" href="{{ route('adminSuppresionUtilisateur',['id' => $user->id]) }}" data-toggle="modal" data-target="#confirmModale" data-id="{{ $user->id }}" data-titre="{{ $user->surname_user }} {{ $user->name }}">Supprimer</a>
				@endif

			{{-- Modal --}}
				<div class="modal" tabindex="-1" role="dialog" id="confirmModale">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">voulez vous vraiment supprimer l'utilisateur :</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p id="recipient-name"></p>
							</div>
							<div class="modal-footer">
								<a class="btn btn-primary" id="confirm">OUI</a>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
							</div>
						</div>
					</div>
				</div>

				<script type="text/javascript">
					$('#confirmModale').on('show.bs.modal', function (event) {
						var id = $(event.relatedTarget).data('id');
						var titre = $(event.relatedTarget).data('titre');

						$(this).find('.modal-title').html("voulez vous vraiment supprimer l'utilisateur :");
						$(this).find('.modal-body p').html(titre);

						$("#confirm").attr("href", "{{URL::to('/')}}/admin/supprUtilisateur/"+id);
					})
				</script>
			</div>
		@endforeach

	</section>
</main>
@endsection