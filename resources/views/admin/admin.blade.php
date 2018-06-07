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
			{{-- nombre d'articles --}}
			<section class="card">
				<div class="card-body" style="background-color: #eee;">
					{{-- titre --}}
					<h5 class="card-title">Articles</h5>
					{{-- nombre --}}
					<p>{{$nbarticles}}</p>
				</div>
				<div class="card-footer" style="background-color: #ccc;">
					{{-- Liens --}}
					<p>
						<a href="{{URL::to('/')}}/admin/articles">Administrer</a>
						 - 
						<a href="{{route('creeArticle')}}">Ajouter</a>
					</p>
				</div>
			</section>

			{{-- nombre de commentaires --}}
			<section class="card">
				<div class="card-body" style="background-color: #eee;">
					{{-- titre --}}
					<h5 class="card-title">Commentaires</h5>
					{{-- nombres --}}
					<p>Total : {{$nbcommentaires}}</p>
					<p>Actifs : {{$nbcommActifs}}</p>
					<p>Inactifs : {{$nbcommentaires-$nbcommActifs}}</p>
				</div>
				<div class="card-footer" style="background-color: #ccc;">
					{{-- Liens --}}
					<p>
						<a href="{{URL::to('/')}}/admin/commentaires">Administrer</a>
					</p>
				</div>
			</section>

			{{-- nombre de catégories --}}
			<section class="card">
				<div class="card-body" style="background-color: #eee;">
					{{-- titre --}}
					<h5 class="card-title">Catégories</h5>
					{{-- nombre --}}
					<p>{{$nbcategories}}</p>
				</div>
				<div class="card-footer" style="background-color: #ccc;">
					{{-- Liens --}}
					<p>
						<a href="{{URL::to('/')}}/admin/categories">Administrer</a>
					</p>
				</div>
			</section>

			{{-- nombre d'utilisateurs --}}
			<section class="card">
				<div class="card-body" style="background-color: #eee;">
					{{-- titre --}}
					<h5 class="card-title">Utilisateurs</h5>
					{{-- nombre --}}
					<p>{{$nbusers}}</p>  
				</div>
				<div class="card-footer" style="background-color: #ccc;">
					{{-- Liens --}}
					<p>
						<a href="{{URL::to('/')}}/admin/utilisateurs">Administrer</a>
					</p>
				</div>
			</section>

		</div>
	</section>
</main>
@endsection