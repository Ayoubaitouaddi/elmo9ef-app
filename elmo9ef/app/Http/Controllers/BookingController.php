<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Tasker;
use App\Models\Category;

class BookingController extends Controller
{
    public function showBookingForm($categoryName, $serviceName)
    {
        // Récupérer la catégorie
        $category = Category::where('name', $categoryName)->first();

        // Récupérer le service
        $service = Service::where('name', $serviceName)->first();

        // Vérifier si la catégorie et le service existent
        if (!$category || !$service) {
            abort(404, 'La catégorie ou le service demandé est introuvable.');
        }

        // Récupérer les taskers associés au service
        $taskers = Tasker::where('service_name', $service->name)->get();

        // Passer les données à la vue
        return view('booking.form', compact('category', 'service', 'taskers'));
    }
}

