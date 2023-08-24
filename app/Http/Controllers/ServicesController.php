<?php

namespace App\Http\Controllers;

use App\Models\Motos;
use App\Models\Products;
use App\Models\Services;
use App\Models\User;
use Carbon\Carbon;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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

    public function show($id)
    {
        $id = Hashids::decode($id);
        $service = Services::with('motos', 'products', 'users')->find($id);
        $user = Services::with('users')->find($id);
        $service = $service[0];

        return view('services.show', compact('service'));
    }

    public function edit($id): View
    {
        $id = Hashids::decode($id);
        $service = Services::with('motos', 'users', 'products')->find($id);
        $users = User::all();
        $products = User::all();
        $motos = Motos::all();
        $service = $service[0];

        return view('services.edit', compact('service', 'products', 'motos', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Services $services
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Services $services)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Services $services
     * @return \Illuminate\Http\Response
     */
    public function destroy(Services $services)
    {
        //
    }
}
