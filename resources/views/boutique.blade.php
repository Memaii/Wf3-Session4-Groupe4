@extends('layouts.mainlayout')
@section('title', "boutique")
@section('contenu')
<script src="https://maps.google.com/maps/api/js?key=AIzaSyC8E8NfMUkrVa-21RDfyaRnvZMLodBWRNM"> type="text/javascript"></script>
		<script async type="text/javascript">
				// On initialise la latitude et la longitude de Paris (centre de la carte)
			var lat = {{$shop->lat_shop}};
			var lon = {{$shop->lon_shop}};
			var map = null;
			// Fonction d'initialisation de la carte
			function initMap() {
				map = new google.maps.Map(document.getElementById("map"), {
					center: new google.maps.LatLng(lat, lon), 
					zoom: 14, 
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
				var marker = new google.maps.Marker({
				position: {lat: lat, lng: lon},
				map: map
				});
			}
			window.onload = function(){
				initMap(); 
			};
		</script>

		<main class="container">
			<div class="row card-deck"">

				<div class="col-4">


					<a><img src="{{ asset('assets/img/uploads/featured') }}/{{ $shop->link_logo }}" alt="Logo" title="Logo de l'entreprise" width=150><p>{{$shop->adress_shop}}</p><p>{{$shop->zip_code}} {{$shop->city_shop}}</p><p>{{$shop->phone_shop}}</p><p>{{$shop->mail_shop}}</p></a>
				</div>
				<div class="col-8">

					<a><img src="{{ asset('assets/img/uploads/featured')}}/{{$shop->link_img}}" alt="boutique" title="boutique" width=300></a>
				</div>
			</div>
			
				
					<div >
						<h5>Note</h5>

							<p class="card-text stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></p>
							<div class="dropdown">
							<button class="btn btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Commentaire
							</button>
					</div>

					<div class="row">
						<div class="col-4">
							<h5>Carte</h5>
							<div id="map"></div>
						</div>
					</div>
				
					<div class=" col-8 card-deck">
						<div class="card-deck">	
								@foreach($products as $product)
								
								<p>{{ $product->name_product}}</p>
								 <p>{{ $product->price_product}}€</p>

										
								@endforeach
						</div>		
					</div>		
				
		</main>
@endsection