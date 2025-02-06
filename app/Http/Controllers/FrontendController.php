<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class FrontendController extends Controller
{
    // Returns the platform welcome or landing page
    public function index(Request $request)
    {
        $query = $request->input('search');

        $categories = Category::all();
        $products = Product::orderBy('created_at', 'DESC')
            ->with('category', 'photos')
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%')
                    ->orWhere('code', 'LIKE', '%' . $query . '%')
                    ->orWhere('description', 'LIKE', '%' . $query . '%');
            })
            ->paginate(8);

        $shareSettings = SystemSetting::firstOrFail();

        return view('welcome', compact('products', 'categories', 'shareSettings'));
    }

    // show single product details
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with('photos')->firstOrFail();

        $singleImage = $product->photos()->get()->first();

        $relatedProducts = $product->category->products()->with('photos')->inRandomOrder()->take(5)->get();

        $shareSettings = SystemSetting::first();

        return view('client.product.show', compact('product', 'relatedProducts', 'singleImage', 'shareSettings'));
    }

    // Get contact us page
    public function contact()
    {
        $info = SystemSetting::first();
        $shareSettings = SystemSetting::first();
        $products = Product::orderBy('id', 'DESC')->with('photos')->take(4)->get();

        return view('contact', compact('info', 'products', 'shareSettings'));
    }

    //send message from contact us
    public function contactStore(Request $request)
    {
        // Validate contact info
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
            // 'g-recaptcha-response' => config('services.recaptcha.key') ? 'required|recaptcha' : 'nullable',
        ]);

        // Save contact info
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', "Hey $request->name, thanks for reaching out we will get back to you withinn 24 hours");
    }

    // display all categories and products
    public function categories()
    {
        $products = Product::orderBy('created_at', 'DESC')->with('photos')->paginate(12);

        $category = Category::with('subcategories')->get();

        $systemInfo = SystemSetting::first();

        $shareSettings = SystemSetting::first();

        return view('categories', compact('products', 'category', 'systemInfo', 'shareSettings'));
    }

    // diplay a single category and its products
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = $category->products()->orderBy('created_at', 'DESC')->with('photos')->paginate(12);

        $categories = Category::with('subcategories')->get();

        return view('category', compact('category', 'categories', 'products'));
    }

    // diplay a single subcategory and its products
    public function subcategory($slug)
    {
        $subCategory = SubCategory::where('slug', $slug)->firstOrFail();

        $products = $subCategory->products()->orderBy('created_at', 'DESC')->with('photos')->paginate(12);

        $categories = Category::with('subcategories')->get();

        return view('sub-category', compact('products', 'categories', 'subCategory'));
    }

    // return products on sale
    public function onSale()
    {
        $products = Product::where('on_sale', 1)->with('photos')->paginate(12);

        $categories = Category::with('subcategories')->get();
        $shareSettings = SystemSetting::first();

        return view('sale', compact('categories', 'products', 'shareSettings'));
    }
}
