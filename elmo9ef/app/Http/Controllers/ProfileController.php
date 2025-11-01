<?php

namespace App\Http\Controllers;

use App\Models\Tasker;
use App\Models\Profeil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|string|in:cover,profile',
        ]);

        $path = $request->file('image')->store('images/coverprofeil', 'public');

        $tasker = auth()->user()->tasker;

        if ($request->type === 'cover') {
            $tasker->cover_image = basename($path); // Enregistrer uniquement le nom du fichier
        } else {
            $tasker->image = basename($path); // Enregistrer uniquement le nom du fichier
        }

        $tasker->save();

        return response()->json([
            'success' => true,
            'image_path' => asset('storage/' . $path),
        ]);
    }

    public function index($taskerId)
    {
        $tasker = Tasker::with('projects')->findOrFail($taskerId);

        return view('profeil.index', compact('tasker'));
    }
}

class TaskerController extends Controller
{
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

        // Créer un tasker
        $tasker = Tasker::create([
            'user_id' => Auth::id(),
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'CIN' => $request->input('CIN'),
            'category_name' => $request->input('category_name'),
            'service_name' => $request->input('service_name'),
            'image' => $request->file('image') ? $request->file('image')->store('taskers', 'public') : null,
            'adresse' => $request->input('adresse'),
            'telephone' => $request->input('telephone'),
        ]);

        // Créer un profil correspondant
        Profeil::create([
            'tasker_id' => $tasker->id, // Utiliser tasker_id au lieu de user_id
            'nom' => $tasker->nom,
            'prenom' => $tasker->prenom,
            'CIN' => $tasker->CIN,
            'category_name' => $tasker->category_name,
            'service_name' => $tasker->service_name,
            'image' => $tasker->image,
            'adresse' => $tasker->adresse,
            'telephone' => $tasker->telephone,
        ]);

        return redirect()->route('profeil.index', $tasker->id)->with('success', 'Votre profil de tasker a été créé avec succès.');
    }
}

