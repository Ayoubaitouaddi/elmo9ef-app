<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TaskerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Models\Category;




Route::get('/get-services/{categoryId}', [TaskerController::class, 'getServices']);

Route::middleware('auth')->group(function () {
    Route::resource('services', ServiceController::class);
    Route::resource('taskers', TaskerController::class);});
    Route::get('services/{categoryName}', [ServiceController::class, 'showCategoryWithTaskers'])->name('services.category');
    Route::get('services/{categoryName}/{serviceName}', [ServiceController::class, 'showService'])->name('services.detail');
    Route::get('services/{categoryName}', [ServiceController::class, 'show'])->name('services.category');
    Route::get('/services-by-category', [ServiceController::class, 'getServicesByCategory']);
    Route::get('/get-services/{categoryId}', [ServiceController::class, 'getServicesByCategory']);





/*countries*/
Route::get('/countries', [CountryController::class, 'index']);



Route::get('/',[MainController::class,'home'])->name('home');
Route::resource('services', ServiceController::class);
Route::get('/search', [ServiceController::class, 'search'])->name('services.search');
Route::get('/categories', function () {return response()->json(Category::with('services')->get());});



// Route pour devenir un "Tasker"
Route::get('/taskers/create', [TaskerController::class, 'create'])->name('taskers.create');
Route::post('/taskers/store', [TaskerController::class, 'store'])->name('taskers.store');
Route::get('taskers/{tasker}', [TaskerController::class, 'show'])->name('taskers.show');
Route::get('taskers', [TaskerController::class, 'index'])->name('taskers.index');
Route::get('taskers/{tasker}/edit', [TaskerController::class, 'edit'])->name('taskers.edit');
Route::get('/taskers/{id}/profeil', [TaskerController::class, 'profeil'])->name('profeil.index');


//route pour booker 
Route::get('/book/{service}', [BookingController::class, 'showBookingForm'])->name('booking.form');
Route::get('/book/{category}/{service}', [BookingController::class, 'showBookingForm'])->name('booking.form');
Route::post('/book/step1', [BookingController::class, 'step1'])->name('booking.step1');
Route::post('/book/step2', [BookingController::class, 'step2'])->name('booking.step2');
Route::post('/book/step3', [BookingController::class, 'step3'])->name('booking.step3');
Route::get('/book/{service}', [BookingController::class, 'show'])->name('booking.show');









// Afficher la page d'authentification
Route::get('/auth', [AuthController::class, 'showAuthPage'])->name('auth');

// Soumettre le formulaire de connexion
Route::post('/auth.login', [AuthController::class, 'login'])->name('login.submit');

// Soumettre le formulaire d'inscription
Route::post('/auth.register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/dashboard', function () {
    return view('dashboard'); // Assurez-vous que la vue 'dashboard' existe
})->name('dashboard');

Route::post('/profile/update-image', [ProfileController::class, 'updateImage'])->name('profile.update.image');
Route::post('/projects/upload', [ProjectController::class, 'upload'])->name('projects.upload');

require __DIR__.'/auth.php';