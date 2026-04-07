<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Services\PhotoService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function __construct(private PhotoService $photos) {}

    public function index(Request $request)
    {
        $query = $request->input('search');

        $products = Product::with('photos', 'category', 'subCategory')
            ->when($query, fn($q) => $q
                ->where('name', 'LIKE', "%{$query}%")
                ->orWhere('code', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
            )
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories    = Category::all();
        $subCategories = SubCategory::all();

        return view('admin.products.create', compact('categories', 'subCategories'));
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create([
            'name'            => $request->name,
            'description'     => $request->description,
            'code'            => $request->code,
            'price'           => $request->price,
            'is_new'          => $request->is_new,
            'on_sale'         => $request->on_sale,
            'quantity'        => $request->quantity,
            'category_id'     => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'slug'            => Str::slug($request->name),
        ]);

        if ($request->hasFile('images')) {
            $this->photos->upload($product, $request->file('images'));
        }

        return redirect()->route('products.index')->with('success', 'Tạo sản phẩm thành công!');
    }

    public function edit(Product $product)
    {
        $categories    = Category::all();
        $subCategories = SubCategory::all();

        return view('admin.products.create', compact('product', 'categories', 'subCategories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update([
            'name'            => $request->name,
            'code'            => $request->code,
            'description'     => $request->description,
            'price'           => $request->price,
            'category_id'     => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'quantity'        => $request->quantity,
            'is_new'          => $request->is_new,
            'on_sale'         => $request->on_sale,
            'slug'            => Str::slug($request->name),
        ]);

        if ($request->hasFile('images')) {
            $this->photos->upload($product, $request->file('images'));
        }

        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function destroy(Product $product)
    {
        $this->photos->deleteAll($product);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công!');
    }

    public function destroyImage($id)
    {
        $photo = Photo::findOrFail($id);
        $this->photos->delete($photo);

        return redirect()->back()->with('success', 'Xóa ảnh thành công!');
    }
}
