<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::latest()->get();

        $title = 'Hapus kategori!';
        $text = "Yakin menghapus kategori ini?";
        confirmDelete($title, $text);

        return view('admin.category.index', compact('category'));
    }


    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request)
    {
        Category::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.category')->with('message', 'kategori telah ditambah');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $request->validated();

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.category')->with('message', 'data kategori telah diubah');
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category')->with('message', 'data kategori telah dihapus');
    }
}
