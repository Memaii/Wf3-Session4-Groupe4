@php

 $routePrefix = Route::getCurrentRoute()->getPrefix();

@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta name="csrf-token" content="{{ csrf_token()}}">
		<meta charset="utf-8">
		<title>@yield('title') - {{ config('app.name') }}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Fichiers JS -->
		<script type="text/javascript" src="{{ asset('assets/js/jquery-3.3.1.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
		<!-- Fichiers CSS -->
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styles.css') }}">

	</head>
	<body>

		<nav class="navbar navbar-expand-md navbar-dark bgBlue pSticky py-1">
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto bgYellow">
					<li class="nav-item p-0">
						<a class="nav-link whiteFont p-1" href="#">Login <span class="sr-only">(Page active)</span></a>
					</li>
					<li class="nav-item p-0">
						<a class="nav-link whiteFont p-1" href="#">Inscription</a>
					</li>
					<li class="nav-item p-0">
						<a class="nav-link whiteFont p-1" href="#">Mon Panier</a>
					</li>
				</ul>
			</div>
		</nav>
		<!-- Blue navbar -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
		<div class="container">
		  <a class="navbar-brand" href="{{URL::to('/')}}"><img src="assets/img/logo.png" alt="Logo de l'entreprise" title="Logo de l'entreprise"> {{ config('app.name') }}</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item{{ (route::currentRouteName() == 'accueil') ? ' active': ''}}">
		        <a class="nav-link" href="{{URL::to('/')}}">Accueil <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item{{ (route::currentRouteName() == 'articles') ? ' active': ''}}">
		        <a class="nav-link" href="#">Boutiques</a>
		      </li>
		      <li class="nav-item{{ (route::currentRouteName() == 'articles') ? ' active': ''}}">
		        <a class="nav-link" href="#">Produits</a>
		      </li>		      
		    </ul>  

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @else
		    		@if (Auth::user()->role == 4)
		    		<li><a class="nav-link{{ ($routePrefix == '/admin') ? ' active': ''}}" href="{{route('admin')}}">{{ __('Admin') }}</a></li>
		    		@endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        	<a class="dropdown-item" href="{{ route('profil') }}">Profil</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
		  </div>
		</div>
		</nav>