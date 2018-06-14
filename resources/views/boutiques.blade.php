@extends('layouts.mainlayout')

@section('title', "boutiques")

@section('contenu')
<script src="https://maps.google.com/maps/api/js?key=AIzaSyC8E8NfMUkrVa-21RDfyaRnvZMLodBWRNM"> type="text/javascript"></script>
<script async type="text/javascript">
            var lat = {{$firstShop->lat_shop}};
            var lon = {{$firstShop->lat_shop}};
            var boutiques = {
                @foreach($allShops as $shop)
                "{{$shop->name_shop}}":{"lat": {{$shop->lat_shop}},"lon": {{$shop->lon_shop}} },
                @endforeach
            };
            console.log(boutiques);
            var carte = null;
            // Fonction d'initialisation de la carte
            function initMap() {
                carte = new google.maps.Map(document.getElementById("carte"), {
                    center: new google.maps.LatLng(lat, lon),
                    zoom: 10,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControl: true,
                    scrollwheel: false,
                    mapTypeControlOptions: {
                        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR 
                    },
                    navigationControl: true, 
                    navigationControlOptions: {
                        style: google.maps.NavigationControlStyle.ZOOM_PAN 
                    }
                });
                for(boutique in boutiques){
                    var marker = new google.maps.Marker({
                        position: {lat: boutiques[boutique].lat, lng: boutiques[boutique].lon},
                        title: boutique,
                        map: carte
                    });
                }
            }
            window.onload = function(){
                initMap(); 
            };
        </script>

<main class="container">
	<div class="row">
		<section class="col-6">
			<div class="card-deck">
                <div class="card-columns">

            {{-- affichage des boutiques --}}
                @foreach($shops as $shop)
                    <div class="card p-2">
                     {{-- affichage de l'image --}}
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
                @endforeach

            </div>
		</section>
		<aside class="col-6">
            <h5>Carte</h5>
            <div id="carte"></div>
		</aside>
	</div>
</main>

@endsection