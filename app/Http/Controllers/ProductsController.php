<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $products = Products::with('moto', 'category')->paginate(25);

//        return response()->json($products);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $motos = Motos::all();
        $categories = Category::where('forProduct', 1)->get();

        return view('products.create', compact('motos', 'categories'));
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'marca' => ['required', 'string'],
            'piece' => ['required', 'string'],
            'image' => ['required', 'file'],
            'price' => ['required', 'integer'],
            'category_id' => ['required', 'exists:' . Category::class . ',id']
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
            'category_id' => $request->category_id,
        ]);
        $product->motos()->attach($request->moto_id);

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function show($id)
    {
        $id = Hashids::decode($id);
        $product = Products::with('motos', 'category')->find($id);
        $product=$product[0];

        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $id=Hashids::decode($id);
        $product = Products::find($id);
        $product=$product[0];
        $motos=Motos::all();
        $motosSelecteds=$product->motos->pluck('id');
        $categories = Category::where('forProduct', 1);

        return view('products.edit', compact('product', 'motos', 'motosSelecteds', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $id=Hashids::decode($id);
        $product=Products::find($id);
        $product=$product[0];
        $previousMotos = $product->motos->pluck('id')->toArray();

        // Obtener los nuevos IDs de motos seleccionados desde el formulario
        $newMotos = $request->input('moto_id', []);

        $motosToRemove = array_diff($previousMotos, $newMotos);
        $product->motos()->detach($motosToRemove);

        // Agregar las nuevas motos seleccionadas
        $motosToAdd = array_diff($newMotos, $previousMotos);
        $product->motos()->attach($motosToAdd);

        $product->update($request->all());

        return redirect()->route('products.index')->with('message', 'Product updated Successfully');
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
