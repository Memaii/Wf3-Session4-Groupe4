@extends('layouts.mainlayout')

@section('title', 'Gestion boutique')

@section('contenu')

<script type="text/javascript" src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyC8E8NfMUkrVa-21RDfyaRnvZMLodBWRNM" type="text/javascript"></script>


<script type="text/javascript" src="{{ asset('assets/js/map.js') }}"></script>

<main class="container">
    <section class="row">
        <h1 class="col-12 py-4">Gestion boutique</h1>
        <!-- message de retour -->
        @if(session('message'))
            <div class="col-12 alert alert-success">
                {{ session('message') }}
            </div>
        @endif

    </section>
    <section class="row">    
        <div class="col-12">
            <h2>Créer votre boutique</h2>
            <!-- formulaire ajout boutique -->
            <form method="post" action="{{ route('postboutique') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <br>                
                <label class="form-label" for="name">Nom</label>
                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : ''}}" name="name" id="name" value="{{ old('name') }}" required>
                @if($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>
                            {{ $errors->first('name') }}
                        </strong>
                    </span>
                @endif
                
                <label class="form-label" for="description">Description</label>
                <textarea class="form-control" name="description" id="description"> {{ old('description') }}</textarea>
                <script>
                    CKEDITOR.replace('description');
                </script>
                       @if ($errors->has('description'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif

                <div class="row">
                    {{-- Siret de la boutique --}}
                    <div class="col-2 text-right">
                        <label class="form-label" for="siret">Siret</label>
                    </div>
                    <div class="col-10">
                        <input class="form-control{{ $errors->has('siret') ? ' is-invalid' : ''}}" type="text" name="siret" value="{{ old('siret') }}" required >
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
                        <input class="form-control{{ $errors->has('mail') ? ' is-invalid' : ''}}" type="mail" name="mail" value="{{ old('mail') }}" required >
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
                        <input class="form-control{{ $errors->has('tel') ? ' is-invalid' : ''}}" type="tel" name="tel" value="{{ old('tel') }}" >
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
                        <input id="addr" class="gps form-control{{ $errors->has('addr') ? ' is-invalid' : ''}}" type="text" name="addr" value="{{ old('addr') }}" >
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
                        <input id="zip" class="gps form-control{{ $errors->has('zip') ? ' is-invalid' : ''}}" type="text" name="zip" value="{{ old('zip') }}">
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
                        <input id="city" class="gps form-control{{ $errors->has('city') ? ' is-invalid' : ''}}" type="text" name="city" value="{{ old('city') }}" >
                        @if($errors->has('city'))
                            <span class="invalid-feedback">
                                <strong>
                                    {{ $errors->first('city') }}
                                </strong>
                            </span>
                        @endif                        
                    </div>
                    <div>
                        <input id="lat" type="text" style="display: none;" name="lat" value="{{ old('lat') }}">
                        <input id="lon" type="text" style="display: none;"" name="lon" value="{{ old('lon') }}">
                    </div>
                </div>

                <br>

                <!-- logo et image--> 
                <div class="form-group row justify-content-center">
                    <div class="col-6">
                        <h2>Logo</h2>
                        <hr>
                        <label for="logo">Choisir un fichier</label>
                        <input type="file" name="logo" class="form-control{{ $errors->has('logo')? ' is-invalid' : '' }}" value="{{old('logo')}}">
                        @if ($errors->has('logo'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('logo') }}</strong>
                                </span>
                        @endif
                    </div>
                    <div class="col-6">
                        <h2>Image</h2>
                        <hr>
                        <label for="image">Choisir un fichier</label>
                        <input type="file" name="image" class="form-control{{ $errors->has('image')? ' is-invalid' : '' }}" value="{{old('image')}}">
                        @if ($errors->has('image'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Créer</button>
            </form>
        </div>
             
            

        </div>


    </section>
</main>

@endsection
