@extends('layouts')
@section('title', "HOME")

@section('content')
<div class="txt container d-flex justify-content-center align-items-center">
    <div class="text-center">
        <h1>Book qualified and trusted craftsmen</h1>
        <h1>for all your home projects.</h1>
    </div>
</div>
@endsection

@section('search')
<div class="search-container">
    <div class="search-bar">
        <input type="text" id="search-input" placeholder="Rechercher un service...">
        <button><i class="fas fa-search" style="color: white"></i></button>
    </div>
    <div id="search-results" class="search-results">
        <!-- Les résultats de recherche apparaîtront ici -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search-input').on('input', function() {
            var query = $(this).val();
            if (query.length >= 1) {
                $.ajax({
                    url: "{{ route('services.search') }}",
                    type: "GET",
                    data: { query: query },
                    success: function(data) {
                        var resultsHtml = '';
                        if (data.length > 0) {
                            data.forEach(function(service) {
                                resultsHtml += '<div class="result-item">' + service.name + '</div>';
                            });
                        } else {
                            resultsHtml = '<div class="result-item">Aucun résultat trouvé.</div>';
                        }
                        $('#search-results').html(resultsHtml);
                    },
                    error: function(xhr, status, error) {
                        console.error("Erreur AJAX :", error);
                        $('#search-results').html('<div class="result-item">Une erreur s\'est produite lors de la recherche.</div>');
                    }
                });
            } else {
                $('#search-results').html('<div class="result-item">Commencez à taper pour rechercher des services...</div>');
            }
        });
    });
</script>
@endsection

@section('categories')
<div class="container">
    <!-- Catégories principales -->
    <div class="main-categories" id="mainCategories">
        @foreach($categories as $category)
            <button class="category-btn {{ $loop->first ? 'active' : '' }}" data-category-id="{{ $category->id }}">
                <i class="fas fa-{{ $category->icon }} category-icon"></i>
                <span class="category-name">{{ $category->name }}</span>
                <div class="underline"></div>
            </button>
        @endforeach
    </div>

    <!-- Sous-catégories -->
    <div class="subcategories-container">
        <div class="subcategories" id="subcategories">
            <div class="no-subcategories">Sélectionnez une catégorie pour voir ses sous-catégories</div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const subcategories = document.getElementById('subcategories');

        // Charger les services d'une catégorie
        function loadServices(categoryId) {
            $.ajax({
                url: '/get-services/' + categoryId,
                type: 'GET',
                success: function (data) {
                    subcategories.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(service => {
                            const item = document.createElement('a');
                            item.className = 'subcategory-item';
                            item.textContent = service.name; // Assurez-vous que les services ont un champ "name"
                            item.href = `/book/${encodeURIComponent(service.name.toLowerCase().replace(/\s+/g, '-'))}`;; // Générer un lien vers le service
                            subcategories.appendChild(item);
                        });
                    } else {
                        const noItems = document.createElement('div');
                        noItems.className = 'no-subcategories';
                        noItems.textContent = 'Aucun service disponible';
                        subcategories.appendChild(noItems);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Erreur AJAX :", error);
                    subcategories.innerHTML = '<div class="no-subcategories">Erreur lors du chargement des services.</div>';
                }
            });
        }

        // Ajouter un événement de clic sur les boutons des catégories
        document.querySelectorAll('.category-btn').forEach(button => {
            button.addEventListener('click', function () {
                // Retirer la classe active de tous les boutons
                document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));

                // Ajouter la classe active au bouton cliqué
                this.classList.add('active');

                // Charger les services pour la catégorie sélectionnée
                loadServices(this.dataset.categoryId);
            });
        });

        // Charger les services de la première catégorie par défaut
        const firstCategory = document.querySelector('.category-btn');
        if (firstCategory) {
            loadServices(firstCategory.dataset.categoryId);
        }
    });
</script>
@endsection
