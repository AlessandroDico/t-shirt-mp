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

<div id="single-edit-container">
    <div class="container">
        <div class="write-container">
            <h1 class="text-center">Attenzione!</h1>
            <p class="text-center">Puoi solo aggiungere delle nuove stampe e cambiare il nome del progetto</p>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="create-tshirt-container">
                    <div id="tshirt-container">
                        {{-- <img id="tshirt-image" src=""/> --}}
                        <img id="tshirt-image" src="{{ 'data:image/png;base64,' . $dress->image }}"/>

                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                <span id="t-shirt-palette"></span>
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

                <form action="{{ route('dress.update', ['dress' => $dress->id]) }}" method="POST" enctype="multipart/form-data" name="t-shirt-edit-form">
                    @csrf
                    @method('PUT')

                    <span class="span-title">Carica un'immagine personalizzata</span>
                    <br>
                    <input type="file" id="tshirt-custompicture"/>
                    <br>
                    <span class="span-name-project">Inserisci il nome del progetto (min. 6 caratteri)</span>
                    <br>

                    <input id="special" type="hidden" name="image" value="">
                    <input id="t-shirt-title" type="text" name="name" value="{{ old('name', $dress->name) }}" required minlength="6" maxlength="50">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br>
                    <button class="edit-form" type="button" id="form-button">Salva le modifiche</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
@endsection
