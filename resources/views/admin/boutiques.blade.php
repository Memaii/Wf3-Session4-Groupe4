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
			<h3 class="text-center">Page d'administration des boutiques</h3>
		</div>
		<div class="col-12">
			<p>Nombre total de boutiques : {{$nbShops}}</p>
		</div>

		{{-- message de retour --}}
		@if(session('message'))
		<div class="col-12 alert alert-success">
			{{ session('message') }}
		</div>
		@endif
		{{-- message de retour --}}

		<table class="table">
			<thead>
				<tr>
					<th style="border-right: 3px solid; border-color: #33d4ff;" scope="col">Boutique</th>
					<th style="border-right: 3px solid; border-color: #33d4ff;" scope="col">Siret</th>
					<th style="border-right: 3px solid; border-color: #33d4ff;" scope="col">Adresse</th>
					<th style="border-right: 3px solid; border-color: #33d4ff;" scope="col">Mail</th>
					<th style="border-right: 3px solid; border-color: #33d4ff;" scope="col">Role</th>
					<th style="border-right: 3px solid; border-color: #33d4ff;" scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($boutiques as $boutique)
				<tr>
					<td style="border-right: 3px solid; border-color: #33d4ff;">{{ $boutique->name_shop }}</td>
					<td style="border-right: 3px solid; border-color: #33d4ff;">{{ $boutique->siret }}</td>
					<td style="border-right: 3px solid; border-color: #33d4ff;">{{ $boutique->adress_shop }}</td>
					<td style="border-right: 3px solid; border-color: #33d4ff;">{{ $boutique->mail_shop }}</td>
					<td style="border-right: 3px solid; border-color: #33d4ff;">
						@if($boutique->statut_shop == 0)
						Banni
						@elseif($boutique->statut_shop == 1)
						En Attente
						@elseif($boutique->statut_shop == 2)
						Active
						@elseif($boutique->statut_shop == 3)
						Archivée
					@endif</td>

					<td style="border-right: 3px solid; border-color: #33d4ff;">
						{{-- boutton bannir --}}
						@if($boutique->statut_shop != 0)
						@if($boutique->statut_shop != 4)
						<a class="btn btn-warning btn-sm" href="{{ route('adminBannirUtilisateur',['id' => $boutique->id]) }}">Bannir</a>
						@endif
						@endif

						{{-- boutton bannir --}}
						@if($boutique->statut_shop == 0)
						<a class="btn btn-warning btn-sm" href="{{ route('adminDebannirUtilisateur',['id' => $boutique->id]) }}">Débannir</a>
						@endif

						{{-- boutton modification --}}
						<a class="btn btn-success btn-sm" href="{{ route('adminModifUtilisateur',['id' => $boutique->id]) }}">Modifier</a>

						{{-- boutton suppression --}}
						@if($boutique->statut_shop == 0)
						<a class="btn btn-danger btn-sm" href="{{ route('supprboutique',['id' => $boutique->id]) }}" data-toggle="modal" data-target="#confirmModale" data-id="{{ $boutique->id }}" data-titre="{{ $boutique->name_shop }}">Supprimer</a>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>


			{{-- Modal --}}
			<div class="modal" tabindex="-1" role="dialog" id="confirmModale">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">voulez vous vraiment supprimer la boutique :</h5>
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

					$(this).find('.modal-title').html("Voulez vous vraiment supprimer la boutique :");
					$(this).find('.modal-body p').html(titre);

					$("#confirm").attr("href", "{{URL::to('/')}}/admin/boutique/"+id+"/suppr");
				})
			</script>
		</div>

	</section>
</main>
@endsection