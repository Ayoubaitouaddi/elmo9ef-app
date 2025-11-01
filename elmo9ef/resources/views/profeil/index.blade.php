@extends('layouts')
@section('content') 
    <div class="container py-4">
        <!-- Section Couverture + Photo de profil -->
        <div class="profile-header">
            <!-- Photo de couverture -->
            <div class="cover-photo-container">
                <div class="cover-photo" style="background-image: url('{{ $tasker->cover_image ? asset('images/coverprofeil/' . $tasker->cover_image) : 'https://via.placeholder.com/1200x200' }}')">
                    <button class="cover-edit-btn" onclick="document.getElementById('cover-upload').click()">
                        <i class="fas fa-camera"></i> Modifier
                    </button>
                    <input type="file" id="cover-upload" style="display: none;" accept="image/*">
                </div>
            </div>
            
            <!-- Photo de profil -->
            <div class="profile-photo-container">
                <img src="{{ $tasker->image ? asset('storage/' . $tasker->image) : 'https://via.placeholder.com/150' }}" 
                     alt="Photo de {{ $tasker->nom }}" 
                     class="profile-photo mx-auto">
                <button class="profile-photo-edit" onclick="document.getElementById('profile-upload').click()">
                    <i class="fas fa-camera"></i>
                </button>
                <input type="file" id="profile-upload" style="display: none;" accept="image/*">
            </div>
            
            <!-- Contenu du profil -->
            <div class="profile-content">
                <div class="company-name">{{ $tasker->nom }} {{ $tasker->prenom }}</div>
                <div class="company-subtitle">{{ $tasker->category_name }}</div>
                <div class="text-center">{{ $tasker->service_name }}</div>
                
                <div class="contact-info">
                    <div>
                        <strong>Téléphone:</strong> 
                        <a href="tel:{{ $tasker->telephone }}" class="text-success" style="text-decoration: none;">
                            <i class="fas fa-phone-alt"></i> {{ $tasker->telephone }}
                        </a>
                    </div>
                    <div>
                        <strong>WhatsApp:</strong> 
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $tasker->telephone) }}" class="text-success" style="text-decoration: none;" target="_blank">
                            <i class="fab fa-whatsapp"></i> {{ $tasker->telephone }}
                        </a>
                    </div>
                    <div>
                        <strong>Adresse:</strong> {{ $tasker->adresse }}
                    </div>
                </div>
                
                <button class="share-btn mt-3">Partager</button>
                
                <div class="divider"></div>
                
                <!-- Section Projets (dupliquée dans l'image) -->
                <div class="mb-3">
                    <div class="section-title">Projets</div>
                    <div id="project-gallery" class="mt-3">
                        @foreach($tasker->projects as $project)
                            <img src="{{ asset('images/projects/' . $project->image_path) }}" class="img-thumbnail m-2" style="width: 150px;">
                        @endforeach
                    </div>
                    <button class="btn btn-primary" onclick="document.getElementById('project-upload').click()">
                        <i class="fas fa-upload"></i> Ajouter des photos de projets
                    </button>
                    <input type="file" id="project-upload" style="display: none;" accept="image/*" multiple>
                </div>
            </div>
        </div>
        
        <!-- Section À propos -->
        <div class="about-section">
            <div class="section-title">À propos</div>
            <p>BatiMor, nous sommes une entreprise de construction fiable, spécialisée en projets résidentiels et tertiaires.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('cover-upload').addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                uploadImage(e.target.files[0], 'cover');
            }
        });

        document.getElementById('profile-upload').addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                uploadImage(e.target.files[0], 'profile');
            }
        });

        document.getElementById('project-upload').addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const files = e.target.files;
                const formData = new FormData();

                for (let i = 0; i < files.length; i++) {
                    formData.append('images[]', files[i]);
                }

                formData.append('_token', '{{ csrf_token() }}');

                fetch('{{ route("projects.upload") }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Réponse du serveur:', data); // Ajoutez ceci pour voir la réponse
                    if (data.success) {
                        alert('Photos téléchargées avec succès !');
                        const gallery = document.getElementById('project-gallery');
                        data.images.forEach(image => {
                            const img = document.createElement('img');
                            img.src = image;
                            img.className = 'img-thumbnail m-2';
                            img.style.width = '150px';
                            gallery.appendChild(img);
                        });
                    } else {
                        alert('Erreur lors du téléchargement: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Erreur capturée:', error);
                    alert('Une erreur est survenue : ' + error.message);
                });
            }
        });

        function uploadImage(file, type) {
            const formData = new FormData();
            formData.append('image', file);
            formData.append('type', type);
            formData.append('_token', '{{ csrf_token() }}');

            fetch('{{ route("profile.update.image") }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (type === 'cover') {
                        document.querySelector('.cover-photo').style.backgroundImage = `url('${data.image_path}?${new Date().getTime()}')`;
                    } else {
                        document.querySelector('.profile-photo').src = `${data.image_path}?${new Date().getTime()}`;
                    }
                } else {
                    alert('Erreur lors du téléchargement: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Une erreur est survenue');
            });
        }
    </script>
@endsection 