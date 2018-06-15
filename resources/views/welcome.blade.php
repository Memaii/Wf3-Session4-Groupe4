@extends('layouts.mainlayout')

@section('title', "accueil")

@section('contenu')

<main class="container">
	<div class="row">
		<section class="col-9">
            <div class="row">
                @foreach($shops as $shop)
                <div class="col-4 mt-4">
                    <div class="card p-2">
                    <!-- affichage de l'image-->
                        <a href="{{route('boutique',['id' => $shop->id_shop])}}">
                            <img class="w-100" src="{{ asset('assets/img/uploads/featured') }}/{{ $shop->link_logo }}" alt="{{ $shop->name_shop  }}"> 
                        </a>

                        <div class="card-body">
                            <h2 class="card-title">
                            <a href="{{route('boutique',['id' => $shop->id_shop])}}">{{ $shop->name_shop }}</a>
                            </h2>
                            <p>{!! strip_tags(str_limit($shop ->description, $limit=150, $end='...')) !!}</p>
                            <p>note: {{ $shop->note }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
		</section>
		<aside class="col-3">
		
		</aside>
	</div>
</main>

@endsection