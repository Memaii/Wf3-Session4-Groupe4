@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        @if(session('message'))
                        <div class="alert alert-success text-center">
                            {{ session('message') }}
                        </div>
                        @endif
                        {{$errors}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">*{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="surname_user" class="col-md-4 col-form-label text-md-right">*{{ __('Surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname_user" type="text" class="form-control{{ $errors->has('surname_user') ? ' is-invalid' : '' }}" name="surname_user" value="{{ old('surname_user') }}" required>

                                @if ($errors->has('surname_user'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('surname_user') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">*{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">*{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">*{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}">

                                @if ($errors->has('phone_number'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="delivery_adress" class="col-md-4 col-form-label text-md-right">{{ __('Delivery Adress') }}</label>

                            <div class="col-md-6">
                                <input id="delivery_adress" type="text" class="form-control{{ $errors->has('delivery_adress') ? ' is-invalid' : '' }}" name="delivery_adress" value="{{ old('delivery_adress') }}">

                                @if ($errors->has('delivery_adress'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('delivery_adress') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="home_adress" class="col-md-4 col-form-label text-md-right">*{{ __('Home Adress') }}</label>

                            <div class="col-md-6">
                                <input id="home_adress" type="text" class="form-control{{ $errors->has('home_adresse') ? ' is-invalid' : '' }}" name="home_adress" value="{{ old('home_adress') }}" required>

                                @if ($errors->has('home_adress'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('home_adress') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="zip_code_user" class="col-md-4 col-form-label text-md-right">*{{ __('Zip Code') }}</label>

                            <div class="col-md-6">
                                <input id="zip_code_user" type="text" class="form-control{{ $errors->has('zip_code_user') ? ' is-invalid' : '' }}" name="zip_code_user" value="{{ old('zip_code_user') }}" required>

                                @if ($errors->has('zip_code_user'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('zip_code_user') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city_user" class="col-md-4 col-form-label text-md-right">*{{ __('City') }}</label>

                            <div class="col-md-6">
                                <input id="city_user" type="text" class="form-control{{ $errors->has('city_user') ? ' is-invalid' : '' }}" name="city_user" value="{{ old('city_user') }}" required>

                                @if ($errors->has('city_user'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('city_user') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="birth_date" class="col-md-4 col-form-label text-md-right">*{{ __('Birth Date') }}</label>

                            <div class="col-md-6">
                                <input id="birth_date" type="date" class="form-control{{ $errors->has('birth_date') ? ' is-invalid' : '' }}" name="birth_date" value="{{ old('birth_date') }}" required>

                                @if ($errors->has('birth_date'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('birth_date') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        <p class="mt-2">Les Champs précédés d'un * sont OBLIGATOIRES.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
