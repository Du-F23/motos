<?php

namespace App\Http\Controllers;

use App\Models\Motos;
use App\Models\Products;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Vinkla\Hashids\Facades\Hashids;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::with('moto')->paginate(25);

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
            'price' => ['required', 'integer']
        ]);
//        dd($request->all());
//
        $piece = str_replace(' ', '', $request->piece);
//        dd($piece);
        //recibe la imagen y la guarda en el storage publico
        $image = $request->file('image')->storeAs('public/products', time() . '_' . $request->marca . $piece . '_' . $request->file('image')->getClientOriginalName());
        //reemplaza la palabra public/ por vacio
        $image = str_replace('public/', '', $image);

        $product = Products::create([
            'marca' => $request->marca,
            'piece' => $request->piece,
            'image' => $image,
            'price' => $request->price,
            'active' => 1,
        ]);
        $product->motos()->attach($request->moto_id);

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function show($id)
    {
//        $id = decrypt($id);
        $id = Hashids::decode($id);
        $products = Products::find($id);

        return response()->json(['data' => $products]);
    }

    public function edit($id)
    {
        $id=Hashids::decode($id);
        $product = Products::find($id);
        $product=$product[0];
        $motos=Motos::all();
        $motosSelecteds=$product->motos->pluck('id');

        return view('products.edit', compact('product', 'motos', 'motosSelecteds'));
    }

    public function update(Request $request, $id)
    {
        $id=Hashids::decode($id);
        $product=Products::find($id);

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
