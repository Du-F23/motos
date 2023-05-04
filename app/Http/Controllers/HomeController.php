<?php

namespace App\Http\Controllers;

use App\Models\Products;
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
        return view('dashboard');
    }
}
