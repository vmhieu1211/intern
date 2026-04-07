<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products   = Product::orderBy('created_at', 'DESC')->with('category', 'photos')->paginate(8);
        $slides     = Slide::all();

        return view('welcome', compact('products', 'slides', 'categories'));
    }

    public function show($slug)
    {
        $product         = Product::where('slug', $slug)->with('photos')->firstOrFail();
        $singleImage     = $product->photos->first();
        $relatedProducts = $product->category->products()->with('photos')->inRandomOrder()->take(5)->get();

        return view('client.product.show', compact('product', 'relatedProducts', 'singleImage'));
    }

    public function contact()
    {
        $products = Product::orderBy('id', 'DESC')->with('photos')->take(4)->get();

        return view('contact', compact('products'));
    }

    public function contactStore(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Contact::create($request->only('name', 'email', 'subject', 'message'));

        return redirect()->back()->with('success', "Cảm ơn {$request->name}, chúng tôi sẽ liên hệ với bạn trong vòng 24 giờ!");
    }

    public function categories()
    {
        $products  = Product::orderBy('created_at', 'DESC')->with('photos')->paginate(12);
        $category  = Category::with('subcategories')->get();

        return view('categories', compact('products', 'category'));
    }

    public function category($slug)
    {
        $category   = Category::where('slug', $slug)->firstOrFail();
        $products   = $category->products()->orderBy('created_at', 'DESC')->with('photos')->paginate(12);
        $categories = Category::with('subcategories')->get();

        return view('category', compact('category', 'categories', 'products'));
    }

    public function subcategory($slug)
    {
        $subCategory = SubCategory::where('slug', $slug)->firstOrFail();
        $products    = $subCategory->products()->orderBy('created_at', 'DESC')->with('photos')->paginate(12);
        $categories  = Category::with('subcategories')->get();

        return view('sub-category', compact('products', 'categories', 'subCategory'));
    }

    public function onSale()
    {
        $products   = Product::where('on_sale', 1)->with('photos')->paginate(12);
        $categories = Category::with('subcategories')->get();

        return view('sale', compact('categories', 'products'));
    }
}
