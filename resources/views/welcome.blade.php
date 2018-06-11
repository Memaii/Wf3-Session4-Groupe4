@extends('layouts.mainlayout')

@section('title', "accueil")

@section('contenu')

<main class="container">
	<div class="row">
		<section class="col-9">
			<div class="card-deck">
        <div class="card-columns">
            @foreach($shops as $shop)
            <div class="card p-2">
                <!-- affichage de l'image-->
                <a href="{{route('boutique',['id' => $shop->id_shop])}}">
                   <img class="w-100" src="{{ asset('assets/img/uploads/featured') }}/{{ $shop->link_logo }}" alt="{{ $shop->name_shop  }}"> 
                </a>

                <div class="card-body">
                    <h2 class="card-title">
                        <a href="{{route('boutique',['id' => $shop->id_shop])}}">{{ $shop->name_shop }}</a>
                    </h2>
                    <p>{{ $shop->phone_shop }}</p>
                    <p>note: {{ $note }}</p>
                </div>
            </div>
            @endforeach
		</section>
		<aside class="col-3">
		
		</aside>
	</div>
</main>

@endsection