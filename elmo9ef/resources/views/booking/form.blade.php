@extends('layouts')
@section('title', 'Réserver un service')
@section('content')

<div class="container py-5">
    <div class="form-container">
        <!-- Indicateur d'étapes -->
        <div class="step-indicator">
            <div class="step step-active" data-step="1">
                <div class="step-circle">1</div>
                <div class="step-name">Localisation</div>
            </div>
            
            <div class="step step-inactive" data-step="2">
                <div class="step-circle">2</div>
                <div class="step-name">Taille de tâche</div>
            </div>
            
            <div class="step step-inactive" data-step="3">
                <div class="step-circle">3</div>
                <div class="step-name">Taskers</div>
            </div>
            
            <!-- Lignes de connexion -->
            <div class="step-connector">
                <div class="connector connector-incomplete"></div>
                <div class="connector connector-incomplete"></div>
            </div>
        </div>
        
        @if($category && $service)
            <h1>Réservation pour {{ $service->name }} dans la catégorie {{ $category->name }}</h1>
        @else
            <p>La catégorie ou le service demandé est introuvable.</p>
        @endif

        <!-- Formulaire étape 1: Localisation -->
        <div class="form-step active" id="step1">
            <h2 class="mb-4">Informations de localisation</h2>
            
            <div class="row g-3">
                <div class="col-md-12 mb-3">
                    <label for="localisation" class="form-label">Localisation</label>
                    <input type="text" class="form-control" id="localisation" name="localisation" placeholder="Entrez votre adresse" required>
                    <button type="button" class="btn btn-sm btn-outline-secondary mt-2" onclick="getLocation()">Utiliser ma position</button>
                    <div class="invalid-feedback">La localisation est requise</div>
                </div>
                
                <div class="col-md-12">
                    <label for="etage" class="form-label">Étage et N° appartement</label>
                    <input type="text" class="form-control" id="etage" name="etage" placeholder="etage :  ,  Nr :" required>
                    <div class="invalid-feedback">L'étage et le numéro d'appartement sont requis</div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end mt-4">
                <button type="button" class="btn btn-primary next-btn" data-next="2">Continuer</button>
            </div>
        </div>
        
        <!-- Formulaire étape 2: Taille de la tâche -->
        <div class="form-step" id="step2">
            <h2 class="mb-4">Quelle est la taille de votre tâche?</h2>
            
            <div class="mb-4">
                <div class="form-check mb-3 p-3 border rounded">
                    <input class="form-check-input" type="radio" name="taskSize" id="small" value="small" checked>
                    <label class="form-check-label d-block" for="small">
                        <strong>Small - Est. 1 hr</strong>
                        <p class="text-muted mb-0 mt-1">Tâches simples et rapides</p>
                    </label>
                </div>
                
                <div class="form-check mb-3 p-3 border rounded">
                    <input class="form-check-input" type="radio" name="taskSize" id="medium" value="medium">
                    <label class="form-check-label d-block" for="medium">
                        <strong>Medium - Est. 2-3 hrs</strong>
                        <p class="text-muted mb-0 mt-1">Tâches de complexité moyenne</p>
                    </label>
                </div>
                
                <div class="form-check p-3 border rounded">
                    <input class="form-check-input" type="radio" name="taskSize" id="large" value="large">
                    <label class="form-check-label d-block" for="large">
                        <strong>Large - Est. 4+ hrs</strong>
                        <p class="text-muted mb-0 mt-1">Tâches complexes ou de longue durée</p>
                    </label>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="taskDescription" class="form-label">Description de la tâche</label>
                <textarea class="form-control" id="taskDescription" name="taskDescription" rows="3" placeholder="Décrivez votre tâche en détail..."></textarea>
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-outline-secondary prev-btn" data-prev="1">Retour</button>
                <button type="button" class="btn btn-primary next-btn" data-next="3">Continuer</button>
            </div>
        </div>
        
        <!-- Formulaire étape 3: Taskers disponibles -->
        <div class="form-step" id="step3">
            <h2 class="mb-4">Taskers disponibles pour le service : {{ ucfirst($service->name) }}</h2>
            
            <div id="taskers-container">
                @forelse ($taskers as $tasker)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">{{ $tasker->nom }} {{ $tasker->prenom }}</h5>
                                <span class="badge bg-success">CIN: {{ $tasker->CIN }}</span>
                            </div>
                            <p class="card-text">Adresse : {{ $tasker->adresse }}</p>
                            <p class="card-text">Téléphone : {{ $tasker->telephone }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <img src="{{ asset('storage/' . $tasker->image) }}" alt="Image de {{ $tasker->nom }}" class="img-thumbnail" style="width: 100px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="selectedTasker" id="tasker{{ $tasker->id }}" value="{{ $tasker->id }}">
                                    <label class="form-check-label" for="tasker{{ $tasker->id }}">
                                        Sélectionner
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Aucun tasker disponible pour ce service.</p>
                @endforelse
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-outline-secondary prev-btn" data-prev="2">Retour</button>
                <button type="button" class="btn btn-primary" id="submitBtn">Réserver maintenant</button>
            </div>
        </div>
        
        <!-- Message de succès -->
        <div class="form-step" id="success">
            <div class="success-message">
                <div class="success-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <h2 class="mb-2">Réservation confirmée!</h2>
                <p class="text-muted mb-4">
                    Votre demande a été envoyée avec succès. Vous recevrez bientôt une confirmation de votre tasker.
                </p>
                <button type="button" class="btn btn-primary" onclick="window.location.href='/'">
                    Retour à l'accueil
                </button>
            </div>
        </div>
    </div>
</div>

<a href="{{ route('booking.show', ['service' => 'painter']) }}" class="btn btn-primary">Réserver un peintre</a>

<input type="hidden" id="serviceId" value="{{ $service->id }}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialisation
        updateStepIndicator(1);
        showStep(1);
        
        // Gestionnaires d'événements pour les boutons suivant/précédent
        document.querySelectorAll('.next-btn').forEach(button => {
            button.addEventListener('click', function() {
                const currentStep = parseInt(this.getAttribute('data-next')) - 1;
                const nextStep = parseInt(this.getAttribute('data-next'));
                
                if (validateStep(currentStep)) {
                    showStep(nextStep);
                    updateStepIndicator(nextStep);
                }
            });
        });
        
        document.querySelectorAll('.prev-btn').forEach(button => {
            button.addEventListener('click', function() {
                const prevStep = parseInt(this.getAttribute('data-prev'));
                showStep(prevStep);
                updateStepIndicator(prevStep);
            });
        });
        
        // Gestionnaire pour le bouton de soumission
        document.getElementById('submitBtn').addEventListener('click', function() {
            if (validateStep(3)) {
                // Collecter les données du formulaire
                const formData = collectFormData();
                
                // Vous pouvez envoyer les données via AJAX ici
                // Exemple:
                /*
                fetch('/api/reservation', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    showStep(4);
                    document.querySelector('.step-indicator').style.display = 'none';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Une erreur est survenue. Veuillez réessayer.');
                });
                */
                
                // Pour l'instant, on simule juste la soumission
                console.log('Formulaire soumis:', formData);
                
                // Afficher le message de succès
                showStep(4);
                
                // Cacher l'indicateur d'étapes
                document.querySelector('.step-indicator').style.display = 'none';
            }
        });
    });
    
    // Afficher l'étape spécifiée
    function showStep(stepNumber) {
        document.querySelectorAll('.form-step').forEach(step => {
            step.classList.remove('active');
        });
        
        const stepToShow = document.getElementById('step' + stepNumber) || document.getElementById('success');
        if (stepToShow) {
            stepToShow.classList.add('active');
        }
    }
    
    // Mettre à jour l'indicateur d'étapes
    function updateStepIndicator(currentStep) {
        document.querySelectorAll('.step').forEach(step => {
            const stepNum = parseInt(step.getAttribute('data-step'));
            
            step.classList.remove('step-completed', 'step-active', 'step-inactive');
            
            if (stepNum < currentStep) {
                step.classList.add('step-completed');
                step.querySelector('.step-circle').innerHTML = '<i class="bi bi-check"></i>';
            } else if (stepNum === currentStep) {
                step.classList.add('step-active');
                step.querySelector('.step-circle').textContent = stepNum;
            } else {
                step.classList.add('step-inactive');
                step.querySelector('.step-circle').textContent = stepNum;
            }
        });
        
        // Mettre à jour les connecteurs
        const connectors = document.querySelectorAll('.connector');
        connectors.forEach((connector, index) => {
            if (index + 1 < currentStep) {
                connector.classList.add('connector-completed');
                connector.classList.remove('connector-incomplete');
            } else {
                connector.classList.add('connector-incomplete');
                connector.classList.remove('connector-completed');
            }
        });
    }
    
    // Valider l'étape actuelle
    function validateStep(stepNumber) {
        let isValid = true;

        if (stepNumber === 1) {
            // Validation étape 1: Localisation
            const localisation = document.getElementById('localisation');
            const etage = document.getElementById('etage');
            
            if (!localisation.value.trim()) {
                showError(localisation);
                isValid = false;
            } else {
                hideError(localisation);
            }
            
            if (!etage.value.trim()) {
                showError(etage);
                isValid = false;
            } else {
                hideError(etage);
            }
        } else if (stepNumber === 2) {
            // Validation étape 2: Taille de la tâche
            // Pas de validation spécifique car les boutons radio ont une valeur par défaut
            // et la description est optionnelle
            isValid = true;
        } else if (stepNumber === 3) {
            // Validation étape 3: Sélection du tasker
            const selectedTasker = document.querySelector('input[name="selectedTasker"]:checked');
            if (!selectedTasker) {
                alert('Veuillez sélectionner un tasker');
                isValid = false;
            }
        }

        return isValid;
    }
    
    // Afficher une erreur pour un champ
    function showError(field) {
        field.classList.add('is-invalid');
    }
    
    // Masquer une erreur pour un champ
    function hideError(field) {
        field.classList.remove('is-invalid');
    }
    
    // Collecter toutes les données du formulaire
    function collectFormData() {
        const formData = {
            localisation: {
                adresse: document.getElementById('localisation').value,
                etage: document.getElementById('etage').value
            },
            tache: {
                taille: document.querySelector('input[name="taskSize"]:checked').value,
                description: document.getElementById('taskDescription').value
            }
        };
        
        // Ajouter le tasker sélectionné s'il existe
        const selectedTasker = document.querySelector('input[name="selectedTasker"]:checked');
        if (selectedTasker) {
            formData.taskerId = selectedTasker.value;
        }
        
        return formData;
    }

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
                    document.getElementById("localisation").value = data.display_name;
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
        switch (error.code) {
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

<style>
    .step-indicator {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-bottom: 30px;
    }
    
    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 1;
    }
    
    .step-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 500;
        margin-bottom: 8px;
    }
    
    .step-name {
        font-size: 14px;
        font-weight: 500;
    }
    
    .step-completed .step-circle {
        background-color: #22c55e; /* green-500 */
    }
    
    .step-active .step-circle {
        background-color: #3b82f6; /* blue-500 */
    }
    
    .step-inactive .step-circle {
        background-color: #6b7280; /* gray-500 */
    }
    
    .step-completed .step-name {
        color: #22c55e; /* green-500 */
    }
    
    .step-active .step-name {
        color: #111827; /* gray-900 */
    }
    
    .step-inactive .step-name {
        color: #6b7280; /* gray-500 */
    }
    
    .step-connector {
        position: absolute;
        top: 20px;
        left: 0;
        right: 0;
        height: 2px;
        z-index: 0;
        display: flex;
    }
    
    .connector {
        flex: 1;
    }
    
    .connector-completed {
        background-color: #22c55e; /* green-500 */
    }
    
    .connector-incomplete {
        background-color: #d1d5db; /* gray-300 */
    }
    
    .form-step {
        display: none;
    }
    
    .form-step.active {
        display: block;
    }
    
    .success-message {
        text-align: center;
        padding: 2rem 0;
    }
    
    .success-icon {
        font-size: 4rem;
        color: #22c55e;
        margin-bottom: 1rem;
    }
    
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
</style>
@endsection