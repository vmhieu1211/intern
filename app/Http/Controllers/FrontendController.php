<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Slide;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $products = Product::orderBy('created_at', 'DESC')->with('category', 'photos')->paginate(8);

        $slides = Slide::all();


        return view('welcome', compact('products', 'slides', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with('photos')->firstOrFail();

        $singleImage = $product->photos()->get()->first();

        $relatedProducts = $product->category->products()->with('photos')->inRandomOrder()->take(5)->get();

        $shareSettings = SystemSetting::first();

        return view('client.product.show', compact('product', 'relatedProducts', 'singleImage', 'shareSettings'));
    }

    public function contact()
    {
        $info = SystemSetting::first();
        $shareSettings = SystemSetting::first();
        $products = Product::orderBy('id', 'DESC')->with('photos')->take(4)->get();

        return view('contact', compact('info', 'products', 'shareSettings'));
    }

    public function contactStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', "Hey $request->name, thanks for reaching out we will get back to you withinn 24 hours");
    }

    public function categories()
    {
        $products = Product::orderBy('created_at', 'DESC')->with('photos')->paginate(12);

        $category = Category::with('subcategories')->get();

        $systemInfo = SystemSetting::first();

        $shareSettings = SystemSetting::first();

        return view('categories', compact('products', 'category', 'systemInfo', 'shareSettings'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = $category->products()->orderBy('created_at', 'DESC')->with('photos')->paginate(12);

        $categories = Category::with('subcategories')->get();

        return view('category', compact('category', 'categories', 'products'));
    }

    public function subcategory($slug)
    {
        $subCategory = SubCategory::where('slug', $slug)->firstOrFail();

        $products = $subCategory->products()->orderBy('created_at', 'DESC')->with('photos')->paginate(12);

        $categories = Category::with('subcategories')->get();

        return view('sub-category', compact('products', 'categories', 'subCategory'));
    }

    public function onSale()
    {
        $products = Product::where('on_sale', 1)->with('photos')->paginate(12);
        $categories = Category::with('subcategories')->get();
        $shareSettings = SystemSetting::first();

        return view('sale', compact('categories', 'products', 'shareSettings'));
    }
}
