@extends('layouts.mainlayout')

@section('title', 'Gestion boutique')

@section('contenu')

<script type="text/javascript" src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyC8E8NfMUkrVa-21RDfyaRnvZMLodBWRNM" type="text/javascript"></script>

<script type="text/javascript" src="{{ asset('assets/js/map.js') }}"></script>

<main class="container">
    <section class="row">
        <h1 class="col-12 py-4">Gestion de la boutique</h1>
        <!-- message de retour -->
        @if(session('message'))
            <div class="col-12 alert alert-success">
                {{ session('message') }}
            </div>
        @endif        
    	<div class="col-12">
    		<!-- formulaire modif boutique -->
    		<form method="post" action="{{ route('postboutique') }}" enctype="multipart/form-data">
    			{{ csrf_field() }}

    			<input type="hidden" name="edit" value="true">
    			<input type="hidden" name="idshop" value="{{ $shop->id_shop}}">
    			<div class="row">
    				<div class="col-12 col-lg-6 ">
    					<label class="form-label" for="name">Nom</label>
    					<input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : ''}}" name="name" id="name" value="{{ $shop->name_shop}}" required>
    					@if($errors->has('name'))
    					<span class="invalid-feedback">
    						<strong>
    							{{ $errors->first('name') }}
    						</strong>
    					</span>
    					@endif

    					<label class="form-label" for="description">Description</label>
    					<textarea class="form-control" name="description" id="description"> {!! $shop->description !!}</textarea>
    					<script>
    						CKEDITOR.replace('description');
    					</script>
    					@if ($errors->has('description'))
    					<span class="invalid-feedback">
    						<strong>{{ $errors->first('description') }}</strong>
    					</span>
    					@endif

    				</div>
    				<div class="col-12 col-lg-6 ">
    					<div class="row">
    						{{-- Siret de la boutique --}}
    						<div class="col-2 text-right">
    							<label class="form-label" for="siret">Siret</label>
    						</div>
    						<div class="col-10">
    							<input class="form-control{{ $errors->has('siret') ? ' is-invalid' : ''}}" type="text" name="siret" value="{{ $shop->siret }}" required >
    							@if ($errors->has('siret'))
    							<span class="invalid-feedback">
    								<strong>{{ $errors->first('siret') }}</strong>
    							</span>
    							@endif
    						</div>
    					</div>
    					<br>
    					<div class="row">
    						{{-- mail de la boutique --}}
    						<div class="col-2 text-right">
    							<label class="form-label" for="mail">e-mail</label>
    						</div>
    						<div class="col-10">
    							<input class="form-control{{ $errors->has('mail') ? ' is-invalid' : ''}}" type="mail" name="mail" value="{{ $shop->mail_shop }}" required >
    							@if($errors->has('mail'))
    							<span class="invalid-feedback">
    								<strong>
    									{{ $errors->first('mail') }}
    								</strong>
    							</span>
    							@endif
    						</div>
    					</div>
    					<br>
    					<div class="row">
    						{{-- tél de la boutique --}}
    						<div class="col-2 text-right">
    							<label class="form-label" for="tel">Tél.</label>
    						</div>
    						<div class="col-10">
    							<input class="form-control{{ $errors->has('tel') ? ' is-invalid' : ''}}" type="tel" name="tel" value="{{ $shop->phone_shop }}" >
    							@if($errors->has('tel'))
    							<span class="invalid-feedback">
    								<strong>
    									{{ $errors->first('tel') }}
    								</strong>
    							</span>
    							@endif                        
    						</div>
    					</div>
    					<br>
    					<div id="insert_adress" class="row">
    						{{-- adresse de la boutique --}}
    						<div class="col-2 text-right">
    							<label class="form-label" for="addr">Adresse</label>
    						</div>
    						<div class="col-10">
    							<input id="addr" class="gps form-control{{ $errors->has('addr') ? ' is-invalid' : ''}}" type="text" name="addr" value="{{ $shop->adress_shop }}" >
    							@if($errors->has('addr'))
    							<span class="invalid-feedback">
    								<strong>
    									{{ $errors->first('addr') }}
    								</strong>
    							</span>
    							@endif                        
    						</div>

    						{{-- code postal de la boutique --}}
    						<div class="col-2 text-right">
    							<label class="form-label" for="zip">Code postal</label>
    						</div>
    						<div class="col-10">
    							<input id="zip" class="gps form-control{{ $errors->has('zip') ? ' is-invalid' : ''}}" type="text" name="zip" value="{{ $shop->zip_code }}">
    							@if($errors->has('zip'))
    							<span class="invalid-feedback">
    								<strong>
    									{{ $errors->first('zip') }}
    								</strong>
    							</span>
    							@endif                        
    						</div>

    						{{-- ville de la boutique --}}
    						<div class="col-2 text-right">
    							<label class="form-label" for="city">Ville</label>
    						</div>
    						<div class="col-10">
    							<input id="city" class="gps form-control{{ $errors->has('city') ? ' is-invalid' : ''}}" type="text" name="city" value="{{ $shop->city_shop }}" >
    							@if($errors->has('city'))
    							<span class="invalid-feedback">
    								<strong>
    									{{ $errors->first('city') }}
    								</strong>
    							</span>
    							@endif                        
    						</div>
    						<div >
    							<input id="lat" style="display: none;" type="text" name="lat" value="{{ old('lat') }}">
    							<input id="lon" style="display: none" type="text" name="lon" value="{{ old('lon') }}">
    						</div>
    					</div>
    				</div>
    				<br>

    				<!-- logo et image--> 
    				<div class="col-12 mt-3">
           
    						<div class="form-group row justify-content-center">
    							<div class="col-4 col-lg-2">
    								<p>Logo</p>

    								<!-- affichage du logo -->
    								@if($shop->link_logo != '')
    								<img class="card-img-top w-100" src="{{ asset('assets/img/uploads/featured') }}/{{ $shop->link_logo }}">
    								<input type="hidden" name="oldlogo" value="{{ $shop->link_logo }}">
    								@endif
    							</div>                    	
    							<div class="col-8 col-lg-4">
    								<p>Pour remplacer le logo:</p>	
    								<label for="logo">Choisir un fichier</label>
    								<input type="file" name="logo" class="smallText form-control{{ $errors->has('logo')? ' is-invalid' : '' }}" value="{{old('logo')}}">
    								@if ($errors->has('logo'))
    								<span class="invalid-feedback">
    									<strong>{{ $errors->first('logo') }}</strong>
    								</span>
    								@endif
    							</div>
    							<div class="col-4 col-lg-2">
    								<p>Image</p>
    								@if($shop->link_img != '')
    								<img class="card-img-top w-100" src="{{ asset('assets/img/uploads/featured') }}/{{ $shop->link_img }}">
    								<input type="hidden" name="oldimg" value="{{ $shop->link_img }}">
    								@endif
    							</div>
    							<div class="col-8 col-lg-4">
    								<p>Pour remplacer l'image:</p>		
    								<label for="image">Choisir un fichier</label>
    								<input type="file" name="image" class="smallText form-control{{ $errors->has('image')? ' is-invalid' : '' }}" value="{{old('image')}}">
    								@if ($errors->has('image'))
    								<span class="invalid-feedback">
    									<strong>{{ $errors->first('image') }}</strong>
    								</span>
    								@endif
    							</div>
    							<div class="col-2 mt-3">
    								<button type="submit" class="btn btn-primary">Modifier</button>	
    							</div>
    						</div>
    				</div>
    			</form>
    		</div>
    	</div>

    </section>
    <section class="row">
    	<!-- affichage liste des produits-> -->

    	<div class="col-12 mt-3 bg-white text-center">
    		<h3 >Liste des produits   
    		<a class="btn btn-success btn-sm" href="{{ route('ajoutproduits', $shop->id_shop) }}"> Ajouter un produit</a>
    		</h3>
    	</div>
    	<div class="col-12 ">
    		<table>
    			<thead>
    				<tr>
    					<th class="px-2" scope="col">Produit</th>
    					<th class="px-2" scope="col">Prix</th>
    					<th class="px-2" scope="col">Stock</th>
    					<th class="px-2" scope="col">début de validité</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($products as $product)
    				<tr class="trAdmin">
    					<td class="px-2">{{ $product->name_product }}</td>
    					<td class="px-2">{{ $product->price_product }}</td> 
    					<td class="px-2">{{ $product->stock_product }}</td> 
    					<td class="px-2">{{ $product->start_sale_product }}</td>    

    					<td>
    						<a class="btn btn-primary btn-sm" href="#"> Modifier</a>
    					</td>
    				</tr>
    				@endforeach
    			</tbody>
    		</table>

    	</div>
    </section>
</main>
@endsection