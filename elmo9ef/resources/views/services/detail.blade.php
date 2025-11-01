@extends('layouts')

@section('title', 'Détails du Service')

@section('content')
<div class="service-detail">
    <h1>Détails du Service : {{ $service->name }}</h1>
    <p><strong>Catégorie :</strong> {{ $category->name }}</p>
    <p><strong>Description :</strong> {{ $service->description }}</p>

    <h2>Taskers disponibles pour ce service</h2>
    @if($taskers->isEmpty())
        <p>Aucun Tasker n'est disponible pour ce service pour le moment.</p>
    @else
        <ul>
            @foreach($taskers as $tasker)
                <li>
                    <h3>{{ $tasker->nom }} {{ $tasker->prenom }}</h3>
                    <p><strong>Adresse :</strong> {{ $tasker->adresse }}</p>
                    <p><strong>Téléphone :</strong> {{ $tasker->telephone }}</p>
                    <p><strong>Catégorie :</strong> {{ $tasker->category->name ?? 'Non spécifiée' }}</p>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection