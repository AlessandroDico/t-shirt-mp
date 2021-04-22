@extends('layouts.app')
@section('content')
    <section class="hero-cta">
        <div class="cta-img-container">
            <h1 class="text-uppercase text-center">Lorem ipsum dolor sit amet</h1>
            <a href="{{ route('dress.create') }}">
                <button class="cta-btn-hero" type="button">Crea la tua T-Shirt</button>
            </a>
        </div>
    </section>
    <section class="adv-container">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="home-adv home-adv-first">
                        <div class="adv-img-container">
                            <img src="{{ asset('img/ext_img/tshirt_bowie.jpg') }}" alt="tshirt_bowie">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="home-adv-p home-adv-first">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="adv-container">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="home-adv-p home-adv-second">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="home-adv home-adv-second">
                        <div class="adv-img-container-second">
                            <img src="{{ asset('img/ext_img/tshirt_pet.jpg') }}" alt="tshirt_nasa">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="adv-container">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="home-adv home-adv-first">
                        <div class="adv-img-container">
                            <img src="{{ asset('img/ext_img/tshirt_vangogh.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="home-adv-p home-adv-first">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="prefooter">
        <div class="prefooter-cta-img-container">
            <div class="prefooter-cta">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <a href="{{ route('dress.create') }}">
                    <button class="btn-prefooter" type="button">
                        Crea la tua t-shirt
                    </button>
                </a>
            </div>
        </div>
    </section>
@endsection
