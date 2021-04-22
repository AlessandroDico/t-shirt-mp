@extends('layouts.app')
@section('content')
    {{-- messaggi di errore compilazione form --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<div id="main-container-create">
    <div id="chose-t-shirt-container" class="chose-t-shirt-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="chose-genre-img">
                        <div class="img-container">
                            <img alt="male_tshirt" src="{{ asset('img/male_choice_img.jpg') }}" id="is-t-shirt-male" onclick="selectMale()" />
                        </div>
                        <div class="">
                            <span>Uomo</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="chose-genre-img">
                        <div class="img-container">
                            <img alt="male_tshirt" src="{{ asset('img/female_choice_img.jpg') }}" id="is-t-shirt-female" onclick="selectFemale()" />
                        </div>
                        <div>
                            <span>Donna</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="after-choice">
        <div class="container">
            <h1 class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</h1>
            <div class="row">
                <div class="col-lg-6">
                    <div class="create-tshirt-container">
                        <div id="tshirt-container">
                            {{-- immagine con t-shirt in trasparenza, così basterà cambiare il background per cambiare il colore della t-shirt --}}
                            <img id="tshirt-image" src=""/>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            {{-- nomi stabiliti da Fabric JS per creare la "tela"--}}
                            <div id="drawingArea" class="drawing-area">
                                <div class="canvas-container">
                                    <canvas id="tshirt-canvas" width="200" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                        <p>Per eliminare una stampa selezionala e digita <kbd>DEL/CANC</kbd> key.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- select per selezionare il colore della maglia -->
                    <div class="div-t-shirt-palette">
                        <span class="span-title">Scegli un colore</span>
                        <ul id="t-shirt-palette">
                            <li class="default-color-palette li-white" value="#fff"></li>
                            <li class="default-color-palette li-black" value="#000"></li>
                            <li class="default-color-palette li-red" value="#f00"></li>
                            <li class="default-color-palette li-brown" value="#563232"></li>
                            <li class="default-color-palette li-green" value="#5b7344"></li>
                            <li class="default-color-palette li-blue" value="#2368ce"></li>
                            <li class="default-color-palette li-purple" value="#781f8e"></li>
                            <li class="default-color-palette li-yellow" value="#d5d831"></li>
                        </ul>
                    </div>
                    <div class="div-default-prints-list">
                        {{-- lista nostre stampe --}}
                        <span class="span-title">Scegli una delle nostre stampe</span>
                        <ul id="default-prints-list">
                            <li class="default-prints" value="{{ asset('img/our_prints/our_prints_1.png') }}">
                                <img  src="{{ asset('img/our_prints/our_prints_1.png') }}" alt="batman" >
                            </li>
                            <li class="default-prints" value="{{ asset('img/our_prints/our_prints_2.png') }}">
                                <img  src="{{ asset('img/our_prints/our_prints_2.png') }}" alt="batman" >
                            </li>
                            <li class="default-prints" value="{{ asset('img/our_prints/our_prints_3.png') }}">
                                <img  src="{{ asset('img/our_prints/our_prints_3.png') }}" alt="batman" >
                            </li>
                            <li class="default-prints" value="{{ asset('img/our_prints/our_prints_4.png') }}">
                                <img  src="{{ asset('img/our_prints/our_prints_4.png') }}" alt="batman" >
                            </li>
                            <li class="default-prints" value="{{ asset('img/our_prints/our_prints_5.png') }}">
                                <img  src="{{ asset('img/our_prints/our_prints_5.png') }}" alt="batman" >
                            </li>
                            <li class="default-prints" value="{{ asset('img/our_prints/our_prints_6.png') }}">
                                <img  src="{{ asset('img/our_prints/our_prints_6.png') }}" alt="batman" >
                            </li>
                            <li class="default-prints" value="{{ asset('img/our_prints/our_prints_7.png') }}">
                                <img  src="{{ asset('img/our_prints/our_prints_7.png') }}" alt="batman" >
                            </li>
                            <li class="default-prints" value="{{ asset('img/our_prints/our_prints_8.png') }}">
                                <img  src="{{ asset('img/our_prints/our_prints_8.png') }}" alt="batman" >
                            </li>
                            <li class="default-prints" value="{{ asset('img/our_prints/our_prints_9.png') }}">
                                <img  src="{{ asset('img/our_prints/our_prints_9.png') }}" alt="batman" >
                            </li>
                            <li class="default-prints" value="{{ asset('img/our_prints/our_prints_10.png') }}">
                                <img  src="{{ asset('img/our_prints/our_prints_10.png') }}" alt="batman" >
                            </li>
                        </ul>
                    </div>
                    <form action="{{ route('dress.store') }}" method="POST" enctype="multipart/form-data" name="t-shirt-form">
                        @csrf
                        <span class="span-title">Carica un'immagine personalizzata</span>
                        <br>
                        <input type="file" id="tshirt-custompicture"/>
                        <br>
                        <span class="span-name-project">Inserisci il nome del progetto (min. 6 caratteri)</span>
                        <br>
                        <input id="t-shirt-title" type="text" name="name" value="{{ old('name') }}" minlength="6" maxlength="50" placeholder="inserisci il nome del progetto" required/>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input id="special" type="hidden" name="image" value="">
                        <br>
                        <button class="create-form" type="button" id="form-button">Salva</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
    function selectMale() {
        if (document.getElementById("is-t-shirt-male").src == "{{ asset('img/male_choice_img.jpg') }}") {
            document.getElementById("tshirt-image").src = "{{ asset('img/background_tshirt.png') }}";

            document.getElementById("chose-t-shirt-container").style.display = 'none';
            document.getElementById("after-choice").style.display = 'block';
            document.getElementById("main-container-create").style.backgroundColor = '#fff';
        }
    }
    function selectFemale() {
        if (document.getElementById("is-t-shirt-female").src == "{{ asset('img/female_choice_img.jpg') }}") {
            document.getElementById("tshirt-image").src = "{{ asset('img/background_tshirt-female2.png') }}";

            document.getElementById("chose-t-shirt-container").style.display = 'none';
            document.getElementById("after-choice").style.display = 'block';
            document.getElementById("main-container-create").style.backgroundColor = '#fff';

        }
    }
</script>
@endsection
