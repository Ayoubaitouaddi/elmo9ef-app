<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasker;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TaskerController extends Controller
{
    public function index()
    {
        // Récupérer tous les Taskers avec pagination
        $taskers = Tasker::paginate(10);
        return view('taskers.index', compact('taskers'));
    }

    public function create()
    {
        // Récupérer les catégories et les services pour le formulaire
        $categories = Category::all(); // Assurez-vous d'importer le modèle Category
        $services = Service::all();
        return view('taskers.create', compact('categories', 'services'));
    }
    public function getServices($categoryId)
    {
        try {
            // Récupérer les services de la catégorie sélectionnée
            $services = Service::where('id_categorie', $categoryId)->get();
            return response()->json($services);
        } catch (\Exception $e) {
            // Log l'erreur et renvoyer une réponse d'erreur
            \Log::error("Erreur dans getServices : " . $e->getMessage());
            return response()->json(['error' => 'Une erreur est survenue'], 500);
        }
    }

    public function profeil($id)
    {
        $tasker = Tasker::findOrFail($id);

        // Retourner la nouvelle vue
        return view('profeil.index', compact('tasker'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'CIN' => 'required|string|max:20',
            'category_name' => 'nullable|string|max:255',
            'service_name' => 'nullable|string|max:255',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:15',
        ]);

        // Récupérer la catégorie et le service
        $category = Category::find($request->input('categories'));
        $service = Service::find($request->input('services'));

        // Gestion de l'image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('taskers', 'public');
        }

        // Création du Tasker
        $tasker = Tasker::create([
            'user_id' => Auth::id(),
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'CIN' => $request->input('CIN'),
            'category_name' => $category ? $category->name : null,
            'service_name' => $service ? $service->name : null,
            'image' => $imagePath,
            'adresse' => $request->input('adresse'),
            'telephone' => $request->input('telephone'),
        ]);

        // Recharger la relation tasker pour l'utilisateur connecté
        Auth::user()->load('tasker');

        return redirect()->route('profeil.index', $tasker->id)->with('success', 'Votre profil de tasker a été créé avec succès.');
    }


    public function edit($id)
    {
        // Trouver le Tasker par son ID
        $tasker = Tasker::findOrFail($id);
        $services = Service::all(); // Récupérer les services pour le formulaire d'édition
        return view('taskers.edit', compact('tasker', 'services'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'CIN' => 'required',
            'categories' => 'required|exists:categories,id', // Vérifie si l'ID du category existe
            'services' => 'required|exists:services,id', // Vérifie si l'ID du service existe
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'adresse' => 'required',
            'telephone' => 'required',
        ]);

        $tasker = Tasker::findOrFail($id);

        // Gestion de l'image (si une nouvelle image est téléchargée)
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($tasker->image) {
                Storage::disk('public')->delete($tasker->image);
            }
            $imagePath = $request->file('image')->store('taskers', 'public');
            $tasker->image = $imagePath;
        }

        // Trouver le service et enregistrer le nom
        $service = Service::find($request->input('services'));

        // Mise à jour des informations
        $tasker->update([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'CIN' => $request->input('CIN'),
            'category_name' => $category ? $category->name : null,
            'service_name' => $service ? $service->name : null,
            'adresse' => $request->input('adresse'),
            'telephone' => $request->input('telephone'),
        ]);

        return redirect()->route('taskers.show', $tasker->id)->with('success', 'Profil mis à jour avec succès!');
    }
}