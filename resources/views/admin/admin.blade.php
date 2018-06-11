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

		<div class="card-columns">
			{{-- nombre d'utilisateurs --}}
			<section class="card">
				<div class="card-body" style="background-color: #eee;">
					{{-- titre --}}
					<h5 class="card-title">Utilisateurs</h5>
					{{-- nombre --}}
					<p>Total : {{$nbUsers}}</p>
				</div>
				<div class="card-footer" style="background-color: #ccc;">
					{{-- Liens --}}
					<p>
						<a href="{{URL::to('/')}}/admin/utilisateurs">Administrer</a>
					</p>
				</div>
			</section>

			{{-- nombre de boutiques --}}
			<section class="card">
				<div class="card-body" style="background-color: #eee;">
					{{-- titre --}}
					<h5 class="card-title">Boutiques</h5>
					{{-- nombres --}}
					<p>Total : {{$nbShops}}</p>
					<p>En attente : {{$nbActiveShops}}</p>
				</div>
				<div class="card-footer" style="background-color: #ccc;">
					{{-- Liens --}}
					<p>
						<a href="{{URL::to('/')}}/admin/boutiques">Administrer</a>
					</p>
				</div>
			</section>

		</div>
	</section>
</main>
@endsection