@extends('layouts')
@section('title', "Become a tasker")
@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <!-- Image à gauche -->
            <div class="col-md-6 image-container">
                <img src="{{ asset('images/construction.webp') }}" alt="Tasker Image" class="img-fluid">
            </div>
    
            <!-- Formulaire à droite -->
            <div class="col-md-6 form-container">
                <h1>Become a Tasker</h1>
                <form action="{{ route('taskers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Nom Field -->
                    <div class="form-group">
                        <label for="nom">Nom :</label>
                        <input type="text" name="nom" id="nom" class="form-control" required>
                    </div>
    
                    <!-- Prénom Field -->
                    <div class="form-group">
                        <label for="prenom">Prénom :</label>
                        <input type="text" name="prenom" id="prenom" class="form-control" required>
                    </div>
    
                    <!-- ICN Field -->
                    <div class="form-group">
                        <label for="CIN">CIN :</label>
                        <input type="text" name="CIN" id="CIN" class="form-control" required>
                    </div>
    
                    <!-- Catégories Dropdown -->
                    <div class="form-group">
                        <label for="categories">Choose a Category :</label>
                        <select name="categories" id="categories" class="form-control" required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <!-- Services Dropdown -->
                    <div class="form-group">
                        <label for="services">Choose a Service :</label>
                        <select name="services" id="services" class="form-control" required>
                            <option value="">Select a service</option>
                        </select>
                    </div>
    
                    <!-- Image Upload -->
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" name="image" id="image" class="form-control custom-file-input" accept="image/*" required>
                    </div>
                    <!-- Adresse Field -->
                    <div class="form-group">
                        <label for="adresse">Adresse :</label>
                        <input type="text" name="adresse" id="adresse" class="form-control" required>
                        <button type="button" class="btn btn-sm btn-outline-secondary mt-2" onclick="getLocation()">Utiliser ma position</button>
                    </div>
                    <div class="form-group">
                        <label for="tele">Telephone :</label>
                        <input type="text" name="telephone" id="telephone" class="form-control" required>
                    </div>
    
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
                <div class="mt-4 text-center">
                    <p>Already have an account ? <a href="{{route('login')}}">Sign in</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Script pour gérer la sélection dynamique des services -->
    <script>
        $(document).ready(function() {
            $('#categories').change(function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: '/get-services/' + categoryId,
                        type: 'GET',
                        success: function(data) {
                            $('#services').empty().append('<option value="">Select a service</option>');
                            $.each(data, function(key, value) {
                                $('#services').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                            $('#services').prop('disabled', false);
                        },
                        error: function(xhr, status, error) {
                            console.error("Erreur AJAX : ", error);
                        }
                    });
                } else {
                    $('#services').empty().append('<option value="">Select a service</option>').prop('disabled', true);
                }
            });
        });
    </script>
<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(getAddressFromCoords, showError);
        } else {
            alert("La géolocalisation n'est pas supportée par ce navigateur.");
        }
    }

    function getAddressFromCoords(position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;

        // Utilisation de l'API Nominatim (OpenStreetMap)
        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`)
            .then(response => response.json())
            .then(data => {
                if (data && data.display_name) {
                    document.getElementById("adresse").value = data.display_name;
                } else {
                    alert("Impossible de trouver l'adresse exacte.");
                }
            })
            .catch(error => {
                console.error("Erreur lors du géocodage inversé :", error);
                alert("Erreur lors de la récupération de l'adresse.");
            });
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                alert("Permission refusée.");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Position non disponible.");
                break;
            case error.TIMEOUT:
                alert("Temps d’attente dépassé.");
                break;
            case error.UNKNOWN_ERROR:
                alert("Erreur inconnue.");
                break;
        }
    }
</script>    
    <!-- Include Bootstrap JS (optional but useful for interactive components) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
@endsection