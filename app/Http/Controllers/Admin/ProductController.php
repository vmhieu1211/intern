<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $products = Product::with('photos', 'category', 'subCategory')
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%')
                    ->orWhere('code', 'LIKE'123 '%' . $query . '%')
                    ->orWhere('description', 'LIKE', '%' . $query . '%');
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('admin.products.create', compact('categories', 'subCategories'));
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'code' => $request->code,
            'price' => $request->price,
            'is_new' => $request->is_new,
            'on_sale' => $request->on_sale,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'slug' => Str::slug($request->name),
        ]);

        //resized images
        /*  foreach ($request->images as $photo) {
            $name = Str::random(14);

            $extension = $photo->getClientOriginalExtension();

            $image = Image::make($photo)->fit(1200, 1200)->encode($extension);

            Storage::disk('public')->put($path = "products/{$product->id}/{$name}.{$extension}", (string) $image);

            $photo = Photo::create([
                'images' => $path,
                'product_id' => $product->id,
            ]); */

        foreach ($request->images as $photo) {
            // Generate a random name for the image
            $name = Str::random(14);
            $extension = $photo->getClientOriginalExtension();

            // Store the image in the 'public' disk
            $path = $photo->storeAs("products/{$product->id}", "{$name}.{$extension}", 'public');

            // Create a photo record for the uploaded image
            Photo::create([
                'images' => $path,
                'product_id' => $product->id,
            ]);
        }

        return redirect()->route('products.index')->with('success', "Created product successfully");
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        $subCategories = SubCategory::all();

        // $productSubCategory = $product->subcategory()->get();

        // dd($productSubCategory);
        // $attributes = $product->attributes()->get();

        return view('admin.products.create', compact('product', 'categories', 'subCategories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->only([
            'name',
            'code',
            'description',
            'price',
            'category_id',
            'sub_category_id',
            'quantity',
            'is_new',
            'on_sale'
        ]);
        $data['slug'] = Str::slug($request->name);  // Update slug here

        $product->update($data);

        /* if ($request->hasFile('images')) {

            foreach ($request->images as $photo) {
                $name = Str::random(14);

                $extension = $photo->getClientOriginalExtension();

                $image = Image::make($photo)->fit(1200, 1200)->encode($extension);

                Storage::disk('public')->put($path = "products/{$product->id}/{$name}.{$extension}", (string) $image);

                $photo = Photo::create([
                    'images' => $path,
                    'product_id' => $product->id,
                ]);
            }
        } */

        if ($request->hasFile('images')) {

            // Loop through the images and store them
            foreach ($request->images as $photo) {
                // Generate a random name for the image
                $name = Str::random(14);
                $extension = $photo->getClientOriginalExtension();

                // Store the image in the 'public' disk
                $path = $photo->storeAs("products/{$product->name}", "{$name}.{$extension}", 'public');

                // Create a photo record for each uploaded image
                Photo::create([
                    'images' => $path,
                    'product_id' => $product->id,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', "Updated product successfully");
    }

    public function destroy(Product $product)
    {
        // delete all product images
        $allImages = $product->photos;

        foreach ($allImages as $key => $img) {
            Storage::disk('public')->delete($img->images);
        }

        $product->photos()->delete();
        //delete product
        $product->delete();
        $productFolder = storage_path('app/public/products/' . $product->id);
        if (is_dir($productFolder) && count(scandir($productFolder)) == 2) {
            rmdir($productFolder); // Remove the empty directory
        }
        return redirect()->route('products.index')->with('success', "Deleted product successfully");
    }
    public function destroyImage($id)
    {
        $image = Photo::find($id);

        Storage::disk('public')->delete($image->images);

        $image->delete();

        return redirect()->back()->with('success', "Image deleted successfully.");
    }
}
