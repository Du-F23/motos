<?php

namespace App\Http\Controllers;

use App\Models\Motos;
use App\Models\Products;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductsController extends Controller
{
    public function index(): View
    {
        $products = Products::with('motos')->paginate(25);

//        return response()->json($products);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $motos = Motos::all();

        return view('products.create', compact('motos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'marca' => ['required', 'string'],
            'piece' => ['required', 'string'],
            'image' => ['required', 'file'],
            'moto_id' => ['required', 'exists:' . Motos::class . ',id']
        ]);
//        dd($request->all());
//
        $piece = str_replace(' ', '', $request->piece);
//        dd($piece);
        //recibe la imagen y la guarda en el storage publico
        $image = $request->file('image')->storeAs('public/products', time() . '_' . $request->marca . $piece . '_' . $request->file('image')->getClientOriginalName());
        //reemplaza la palabra public/ por vacio
        $image = str_replace('public/', '', $image);

        Products::create([
            'marca' => $request->marca,
            'piece' => $request->piece,
            'image' => $image,
            'active' => 1,
            'moto_id' => $request->moto_id
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $product=Products::find($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function restore($id): RedirectResponse
    {
        $product = Products::onlyTrashed()->find($id);
        $product->restore();

        return redirect()->route('motos.index')->with('success', 'Product restored successfully.');
    }

    public function forceDelete($id): RedirectResponse
    {
        $product = Products::onlyTrashed()->find($id);
        Storage::delete('public/' . $product->image);
        $product->forceDelete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

}
