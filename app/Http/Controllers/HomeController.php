<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use App\Models\Motos;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function home()
    {
        if (!auth()->check()) {
            $products = Products::all();
            return view('welcome', compact('products'));
        }
        return redirect()->route('dashboard');
    }

    public function dashboard(): View
    {
        $categories = Category::all();
        $motos = Motos::all();

        return view('dashboard', compact('motos', 'categories'));
    }
}
