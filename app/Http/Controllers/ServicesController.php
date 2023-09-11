<?php

namespace App\Http\Controllers;

use App\Models\Motos;
use App\Models\Products;
use App\Models\Services;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Vinkla\Hashids\Facades\Hashids;

class ServicesController extends Controller
{
    public function index(): View
    {
        $services = Services::with('products', 'motos', 'users')->get();

        return view('services.index', compact('services'));
    }

    public function create(): View
    {
        $motos = Motos::all();
        $products = Products::all();

        return view('services.create', compact('motos', 'products'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user' => ['required', 'string'],
            'costo_servicio' => ['required', 'integer'],
            'moto_id' => ['required', 'exists:' . Motos::class . ',id'],
        ]);

        $productosSeleccionados = $request->input('product_id');
        $costoProductos = Products::whereIn('id', $productosSeleccionados)->sum('price');

        $total = $request->costo_servicio + $costoProductos;

        $service = Services::create([
            'user' => $request->user,
            'date_service' => Carbon::now(),
            'costo_servicio' => $request->costo_servicio,
            'moto_id' => $request->moto_id,
            'user_id' => Auth::user()->id,
            'total' => $total
        ]);

        $service->products()->attach($request->product_id);

        return redirect()->route('services.index')->with('success', 'Service created successfully');
    }

    public function show($id): View
    {
        $id = Hashids::decode($id);
        $service = Services::with('motos', 'products', 'users')->find($id);
        $user = Services::with('users')->find($id);
        $service = $service[0];

        return view('services.show', compact('service'));
    }

    public function showJson($id): JsonResponse
    {
        $service = Services::find($id);

        return response()->json($service);
    }


    public function edit($id): View
    {
        $id = Hashids::decode($id);
        $service = Services::with('motos', 'users', 'products')->find($id);
        $users = User::all();
        $products = Products::all();
        $motos = Motos::all();
        $service = $service[0];
        $productsSelected = $service->products->pluck('id');

        return view('services.edit', compact('service', 'products', 'motos', 'users', 'productsSelected'));
    }
    public function search(Request $request)
    {
        $query=$request->query('query');
        $users=Services::where('user', 'like', '%' . $query . '%')->with('motos', 'users', 'products')->get();

        return view('services.byuser', compact('users'));
//        return response()->json(['data' => $users]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $id=Hashids::decode($id);
        $service=Services::find($id);
        $service=$service[0];

        $previousProducts = $service->products->pluck('id')->toArray();
        $newProducts = $request->input('product_id', []);

        $productsToRemove = array_diff($previousProducts, $newProducts);
        $service->products()->detach($productsToRemove);

        $productsToAdd = array_diff($newProducts, $previousProducts);
        $service->products()->attach($productsToAdd);

        $costoProductosToAdd = 0;
        if (!empty($productsToAdd)) {
            $costoProductosToAdd = Products::whereIn('id', $productsToAdd)->sum('price');
        }

        $costoProductosToRemove = Products::whereIn('id', $productsToRemove)->sum('price');

        // Calcular el costo total de los productos incluyendo los previos y los nuevos
        $totalCost = $service->products->sum('price') + $costoProductosToAdd - $costoProductosToRemove;

        // Sumar el costo total de los productos al costo del servicio
        $total = $request->costo_servicio + $totalCost;
        $service->total = $total;

        $service->update($request->all());

        return redirect()->route('services.index')->with('message', 'Service update Successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $service = Services::find($id);
        $service->delete();

        return redirect()->route('services.index')->with('message', 'Service deleted Successfully');

    }
}
