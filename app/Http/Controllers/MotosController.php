<?php

namespace App\Http\Controllers;

use App\Models\Motos;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Category;

class MotosController extends Controller
{
    public function index(): View
    {
        $motos = Motos::all();
        $motosDeleted = Motos::onlyTrashed()->get();

        return view('motos.index', compact('motos', 'motosDeleted'));
    }

    public function create(): View
    {
        $categories = Category::all();

        return view('categories.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        //recibe la imagen y la guarda en el storage publico
        $image = $request->file('image')->storeAs('public/motos', time(). '_' . $request->name . '_' . $request->file('image')->getClientOriginalName());
        // quita la palabra public del path
        $image = str_replace('public/', '', $image);

        $motos = Motos::create([
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

    public function show($id)
    {
        //
    }

    public function edit($id): View
    {
        $moto = Motos::find($id);
        $categories = Category::all();

        return view('motos.edit', compact('moto', 'categories'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $moto = Motos::find($id);
        if ($request->file('image')) {
            $image = $request->file('image')->storeAs('public/motos', time(). '_' . $request->name . '_' . $request->file('image')->getClientOriginalName());
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
}
