@extends('layouts')
@section('title', "Become a tasker")
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Modifier le Profil de {{ $tasker->nom }} {{ $tasker->prenom }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('taskers.update', $tasker->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" id="nom" class="form-control" value="{{ $tasker->nom }}" required>
                        </div>

                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ $tasker->prenom }}" required>
                        </div>

                        <!-- Autres champs pour CIN, adresse, téléphone, etc. -->

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <img src="{{ asset('storage/' . $tasker->image) }}" alt="Image actuelle" class="img-fluid mt-2" style="max-width: 150px;">
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



