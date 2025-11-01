@extends('layouts')
@section('title', "Become a tasker")
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Profil Tasker Card -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Congratulation {{ $tasker->nom }} {{ $tasker->prenom }} you become a Tasker </h4>
                </div>
                <div class="card-body">
                    <!-- Tasker Image -->
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $tasker->image) }}" alt="Photo de {{ $tasker->nom }}" class="img-fluid rounded-circle" style="max-width: 200px;">
                    </div>

                    <!-- Informations sur le Tasker -->
                    <div class="mt-4">
                        <h5><strong>Nom:</strong> {{ $tasker->nom }} {{ $tasker->prenom }}</h5>
                        <h5><strong>Service:</strong> {{ $tasker->service_name }}</h5>
                        <h5><strong>Adresse:</strong> {{ $tasker->adresse }}</h5>
                        <h5><strong>Téléphone:</strong> {{ $tasker->telephone }}</h5>
                        <h5><strong>CIN:</strong> {{ $tasker->CIN }}</h5>
                    </div>
                    <!-- Buttons -->
                    <div class="mt-4">
                        <a href="{{ route('taskers.index') }}" class="btn btn-secondary">Retour à la liste des Taskers</a>
                        <a href="{{ route('taskers.edit', $tasker->id) }}" class="btn btn-warning">Modifier le profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



