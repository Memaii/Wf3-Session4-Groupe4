@extends('layouts.mainlayout')

@section('title', "boutiques")

@section('content')

<main class="container">
	<div class="row">
		<section class="col-9">
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
                        <p>note:</p>
                        <input type="hidden" name="note" id="note" value="{!! floor(strip_tags($shop ->note)) !!}">
                        <div style="display: flex;">
                          <p><i class="fas fa-star" id="star_1" value="1"></i></p>
                          <p><i class="fas fa-star" id="star_2" value="2"></i></p>
                          <p><i class="fas fa-star" id="star_3" value="3"></i></p>
                          <p><i class="fas fa-star" id="star_4" value="4"></i></p>
                          <p><i class="fas fa-star" id="star_5" value="5"></i></p>
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