<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;

class MainController extends Controller
{
    public function home() {
        $categories = Category::all(); // Assurez-vous d'importer le modèle Category
        $services = Service::all();
        return view('home', compact('categories' , 'services'));
    }
    public function contact() {
        return view('contact');
    }
    public function about() {
        return view('about');
    }
    public function home1() {
        return view('home1');
    }
}