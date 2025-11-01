<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\Category;

class ServiceController extends Controller
{
    public function index()
    {
        $categories = Category::with('services')->get(); // Assuming you have a relationship defined in the Category model

        return view('services.index', compact('categories'));
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        $services = Service::where('name', 'like', '%' . $query . '%')->get();
        return response()->json($services);
    }

    public function showCategory($categoryName)
    {
        $category = Category::where('name', $categoryName)->firstOrFail();
        $services = $category->services; // Assuming you have a relationship defined in the Category model

        return view('services.category', compact('category', 'services'));
    }
                                                                                                                                                                                                                                                                                                                  
    public function showService($categoryName, $serviceName)
    {
        $category = Category::where('name', $categoryName)->firstOrFail();
        $service = $category->services()->where('name', $serviceName)->firstOrFail();
        $taskers = $service->taskers; // Assuming you have a relationship defined in the Service model

        return view('services.detail', compact('category', 'service', 'taskers'));
    }

    public function getServicesByCategory($categoryId)
    {
        $services = Service::where('category_id', $categoryId)->get();
        return response()->json($services);
    }

    public function showServiceWithTaskers($categoryName, $serviceName)
    {
        // Récupérer la catégorie et le service
        $category = Category::where('name', $categoryName)->firstOrFail();
        $service = Service::where('name', $serviceName)->where('id_categorie', $category->id)->firstOrFail();

        // Récupérer les Taskers associés à ce service
        $taskers = Tasker::where('service_name', $service->name)->get();

        // Retourner la vue avec les données
        return view('services.detail', compact('category', 'service', 'taskers'));
    }
}