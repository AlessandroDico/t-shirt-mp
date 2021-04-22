@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="your-projects-container">
                    @if (count($dresses) === 0)
                        <div class="if-no-projects-container">
                            <h1 class="text-center">Non hai nessun progetto salvato</h1>
                            <a id="index-link-create" href="{{ route('dress.create') }}">Crea un nuovo progetto</a>
                        </div>
                    @else
                        {{-- messaggi di successo/errore all'invio del form --}}
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('errors'))
                            <div class="alert alert-danger">
                                {{ session('errors') }}
                            </div>
                        @endif
                        <h1 class="text-center">Tutte le tue t-shirt</h1>
                        <a id="index-link-create" href="{{ route('dress.create') }}">Crea un nuovo progetto</a>
                        <div class="project-cards">
                            @foreach ($dresses as $dress)
                                <div class="single-card">
                                    <a href="{{ route('dress.show', ['dress' => $dress->id]) }}">
                                        <img src="{{ asset('img/projects_watermarked/'. $dress->slug . '/thumbnail.jpeg') }}">
                                    </a>
                                    <div class="card-body">
                                        <p class="text-center">{{ $dress->name }}</p>
                                        <form action="{{ route('dress.destroy', ['dress' => $dress->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('dress.edit', ['dress' => $dress->id ]) }}" class="btn">Modifica</a>
                                            <button type="submit" class="btn">
                                                Elimina
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
