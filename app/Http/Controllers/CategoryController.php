<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Vinkla\Hashids\Facades\Hashids;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::where('forProduct', 0)->get();
        $categoriesForProducts = Category::where('forProduct', 1)->get();

        $categoriesDeleted = Category::onlyTrashed()->get();

        return view('categories.index', compact('categories', 'categoriesForProducts','categoriesDeleted'));
    }

    public function store(Request $request): RedirectResponse
    {
//        dd($request->all());
        $category = Category::create([
            'name' => $request->name,
            'active' => true,
            'forProduct' => $request->forProduct
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id): View
    {
        $id = Hashids::decode($id);
        $category = Category::find($id);
        $category=$category[0];
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $id = Hashids::decode($id);
        $category = Category::find($id);
        $category=$category[0];
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('updated', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $category = Category::find($id);
        //inactiva la categoria cambiando el valor de active a false
        $category->update([
            'active' => false,
        ]);

        $category->delete();

        return redirect()->route('categories.index')->with('delete', 'Category deleted successfully.');
    }

    public function restore($id): RedirectResponse
    {
        $category = Category::onlyTrashed()->find($id);
        //activa la categoria cambiando el valor de active a true
        $category->update([
            'active' => true,
        ]);
        $category->restore();

        return redirect()->route('categories.index')->with('success', 'Category restored successfully.');
    }
}
