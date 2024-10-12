<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use RealRashid\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;


class ProductController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $product = Product::with('category')->latest()->get();

        if ($category->isEmpty()) {
            return redirect()->route('admin.category.create')->with('error', 'Isi kategori terlebih dahulu');
        }

        $title = 'Hapus produk!';
        $text = "Yakin menghapus prodk ini?";
        confirmDelete($title, $text);

        return view('admin.product.index', compact('product'));
    }

    public function create()
    {
        $category = Category::all();

        return view('admin.product.create', compact('category'));
    }

    public function store(ProductRequest $request)
    {
        $price = str_replace('.', '', $request->price);

        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $price,
            'description' => $request->description,
        ]);

        session(['product_id' => $product->id]);

        return response()->json(['message' => 'Produk telah disimpan. Silakan unggah gambar.', 'product_id' => $product->id], 200);
    }

    // public function uploadImages(Request $request, $productId)
    // {
    //     // Cari produk berdasarkan ID
    //     $product = Product::find($productId);

    //     if (!$product) {
    //         return response()->json(['error' => 'Produk tidak ditemukan.'], 404);
    //     }

    //     // Simpan gambar yang diunggah
    //     if ($request->hasFile('images')) {
    //         foreach ($request->file('images') as $image) {
    //             $path = $image->store('products', 'public');
    //             $product->images()->create(['image' => $path]);
    //         }
    //     }

    //     return response()->json(['success' => 'Gambar berhasil diunggah.']);
    // }

    public function uploadImages(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Produk tidak ditemukan.'], 404);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $img = Image::read($image->getPathname());

                $img->resize(300, 200);

                $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

                $img->save(storage_path('app/public/products/' . $fileName), 75);

                $product->images()->create(['image' => 'products/' . $fileName]);
            }
        }

        return response()->json(['success' => 'Gambar berhasil diunggah.'], 200);
    }


    public function edit(Product $product)
    {
        $category = Category::all();

        return view('admin.product.edit', compact(
            'product',
            'category',
        ));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $price = str_replace('.', '', $request->price);

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $price,
            'description' => $request->description,
        ]);

        if ($request->has('deleted_images')) {
            foreach (explode(',', $request->input('deleted_images')) as $deletedImageId) {
                $image = $product->images()->find($deletedImageId);
                if ($image) {
                    Storage::disk('public')->delete($image->image);
                    $image->delete();
                }
            }
        }

        // Simpan ID produk di sesi untuk digunakan saat unggah gambar
        session(['product_id' => $product->id]);

        // Redirect ke halaman upload gambar
        return response()->json(['message' => 'Produk telah diubah. Silakan unggah gambar.', 'product_id' => $product->id], 200);
    }



    public function destroy(Product $product)
    {
        $images = $product->images;

        foreach ($images as $image) {
            Storage::disk('public')->delete($image->image);
            $image->delete();
        }

        $product->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.product')->with('message', 'Data produk dan gambar terkait telah dihapus.');
    }
}
