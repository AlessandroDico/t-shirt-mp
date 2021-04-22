@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="show-container">
                    <h1 class="text-center">{{ $dress->name }}</h1>
                    <div class="show-single-card">
                        <a class="show-btn" href="{{ route('dress.index') }}">Torna alle tue T-Shirt</a>
                        <img src="{{ asset('img/projects_watermarked/'. $dress->slug . '/full.jpeg') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
