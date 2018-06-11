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
			<p>Page d'administration</p>
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
					<th class="tdhAdmin" scope="col">BOUTIQUE</th>
					<th class="tdhAdmin" scope="col">SIRET</th>
					<th class="tdhAdmin" scope="col">ADRESSE</th>
					<th class="tdhAdmin" scope="col">MAIL</th>
					<th class="tdhAdmin" scope="col">ROLE</th>
					<th class="text-center" scope="col">ACTIONS</th>
				</tr>
			</thead>
			<tbody>
				@foreach($boutiques as $boutique)
				<tr class="trAdmin">
					<td class="tdhAdmin">{{ $boutique->name_shop }}</td>
					<td class="tdhAdmin">{{ $boutique->siret }}</td>
					<td class="tdhAdmin">{{ $boutique->adress_shop }}</td>
					<td class="tdhAdmin">{{ $boutique->mail_shop }}</td>
					<td class="tdhAdmin">
						@if($boutique->statut_shop == 0)
						Banni
						@elseif($boutique->statut_shop == 1)
						En Attente
						@elseif($boutique->statut_shop == 2)
						Active
						@elseif($boutique->statut_shop == 3)
						Archivée
						@endif
					</td>
					{{-- bouttons d'actions --}}
					<td  class="text-center">
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
					{{-- Modal --}}
					</div>
				</tr>
				@endforeach
			</tbody>
		</table>
		
	</section>
</main>
@endsection