<?php

namespace App\Http\Controllers;

use App\Models\Motos;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Category;
use Vinkla\Hashids\Facades\Hashids;

class MotosController extends Controller
{
    public function index(): View
    {
        $motos = Motos::with('category')->get();
        $motosDeleted = Motos::onlyTrashed()->with('category')->get();

        return view('motos.index', compact('motos', 'motosDeleted'));
    }

    public function create(): View
    {
        $categories = Category::where('forProduct', 0)->get();

        return view('motos.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer'],
            'model' => ['required', 'string'],
            'color' => ['required', 'string'],
            'hp' => ['required', 'string'],
            'image' => ['required', 'file'],
            'category_id' => ['required', 'exists:' . Category::class . ',id']
        ]);

        //recibe la imagen y la guarda en el storage publico
        $image = $request->file('image')->storeAs('public/motos', time() . '_' . $request->name . '_' . $request->file('image')->getClientOriginalName());
        //reemplaza la palabra public/ por vacio
        $image = str_replace('public/', '', $image);

        Motos::create([
            'name' => $request->name,
            'marca' => $request->marca,
            'year' => $request->year,
            'model' => $request->model,
            'color' => $request->color,
            'hp' => $request->hp,
            'image' => $image,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('motos.index')->with('success', 'Moto created successfully.');
    }

    public function showJson($id): JsonResponse
    {
        //busca por id en la tabla motos ya sea en las eliminadas o no
        //recupera de los headers si esta eliminada o no
//        $moto = Motos::withTrashed()->find($id);
        $moto = Motos::with('products')->find($id);

        return response()->json($moto);
    }

    public function show($id)
    {
        $id = Hashids::decode($id);
//        $moto = Motos::with('category')->find($id);
//        $pieces = Motos::with('products')->find($id);
//        $pieces = $pieces[0]->products;
//        $moto = $moto[0];
        $moto = Motos::with('category')->find($id);
        $pieces = Motos::with(['products' => function ($query) {
            $query->with('category')->orderBy('category_id', 'asc');
        }])->find($id);
        $moto = $moto[0];
        $pieces = $pieces[0]->products;

//        return response()->json($pieces);

        return view('motos.show', compact('moto', 'pieces'));
    }

    public function edit($id): View
    {
        $id = Hashids::decode($id);
        $moto = Motos::with('category')->find($id);
        $categories = Category::all();
        $moto = $moto[0];

        return view('motos.edit', compact('moto', 'categories'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $id = Hashids::decode($id);
        $moto = Motos::find($id);
        $moto = $moto[0];
        if ($request->file('image')) {
            $image = $request->file('image')->storeAs('public/motos', time() . '_' . $request->name . '_' . $request->file('image')->getClientOriginalName());
            $image = str_replace('public/', '', $image);
            $moto->image = $image;
            $moto->update($request->all());
        }
        $moto->update($request->all());

        return redirect()->route('motos.index')->with('updated', 'Moto updated successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        $moto = Motos::find($id);
        $moto->delete();

        return redirect()->route('motos.index')->with('deleted', 'Moto deleted successfully.');
    }

    public function restore($id): RedirectResponse
    {
        $moto = Motos::onlyTrashed()->find($id);
        $moto->restore();

        return redirect()->route('motos.index')->with('success', 'Moto restored successfully.');
    }

    public function forceDelete($id): RedirectResponse
    {
        $moto = Motos::onlyTrashed()->find($id);
        Storage::delete('public/' . $moto->image);
        $moto->forceDelete();

        return redirect()->route('motos.index')->with('success', 'Moto deleted successfully.');
    }

    public function showByCategory($id, $year = null, $hp = null)
    {
        $motos = Motos::where('category_id', $id)->get();

        if ($hp != null) {
            $motos = Motos::where('category_id', $id)->where('year', $year)->where('hp', $hp)->get();
        } elseif ($year != null){
            $motos = Motos::where('category_id', $id)->where('year', $year)->get();
        }

        // Obtén todos los años de motos de la categoría seleccionada
        $years = Motos::where('category_id', $id)->distinct()->pluck('year');

        // Obtén todos los caballos de fuerza de motos de la categoría seleccionada
        $hps = Motos::where('category_id', $id)->distinct()->pluck('hp');

        if (!$motos->empty() === false) {
            return view('motos.filtered', compact('motos', 'hps', 'years', 'id'));
        }

        // Si no hay motos para la categoría seleccionada, devuelve todos los años y caballos de fuerza
        $years = Motos::distinct()->pluck('year');
        $hps = Motos::distinct()->pluck('hp');
        return view('motos.filtered', compact('motos', 'hps', 'years'));
    }


    public function showByCategoryJson($id)
    {
        $motos = Motos::where('category_id', $id)->get();

        return response()->json($motos);
    }

    public function findPieces($id)
    {
        $pieces = Motos::with('products')->find($id);
        $pieces = $pieces->products;

        return response()->json($pieces);
    }

    public function searchByName(Request $request)
    {
        $query = $request->input('query');

//        $motos = Motos::where('name', $query)->orWhere('model', $query)->get();
        $motos = Motos::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', '%' . $query . '%')
                ->orWhere('model', 'like', '%' . $query . '%');
        })->get();

//        return response()->json(['data' => $motos, 'query' => $query], 200);
        return view('motos.byname', compact('motos'));
    }
}
