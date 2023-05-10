<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();

        $categoriesDeleted = Category::onlyTrashed()->get();

        return view('categories.index', compact('categories', 'categoriesDeleted'));
    }

    public function store(Request $request): RedirectResponse
    {
        $category = Category::create([
            'name' => $request->name,
            'active' => true,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id): View
    {
        $category = Category::find($id);

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
        $category = Category::find($id);

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
