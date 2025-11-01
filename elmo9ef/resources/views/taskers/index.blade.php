@extends('layouts')
@section('title', "Become a tasker")
@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Liste des Taskers</h2>

    <!-- Vérifier s'il y a un message de succès -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach($taskers as $tasker)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $tasker->image) }}" class="card-img-top" alt="Photo de {{ $tasker->nom }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $tasker->nom }} {{ $tasker->prenom }}</h5>
                        <p class="card-text"><strong>Service:</strong> {{ $tasker->service_name }}</p>
                        <p class="card-text"><strong>Adresse:</strong> {{ $tasker->adresse }}</p>
                        <p class="card-text"><strong>Téléphone:</strong> {{ $tasker->telephone }}</p>
                        <a href="{{ route('taskers.show', $tasker->id) }}" class="btn btn-custom-info">Voir Profil</a>
                        <a href="{{ route('tasker.profeil', $tasker->id) }}" class="btn btn-custom-info">Voir Profil</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination si nécessaire -->
    {{ $taskers->links() }}
</div>
@endsection



