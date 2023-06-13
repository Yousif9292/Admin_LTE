<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'data' => $products,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'image' => 'nullable|image',
        'product_name' => 'required',
        'purchase_price' => 'required|numeric',
        'sale_price' => 'required|numeric',
        'discount' => 'required|numeric',
        'status' => 'required|boolean',
        'category_id' => 'required|exists:categories,id',
    ]);



    // Create a new product instance
    $product = new Product;
    $product->product_name = $request->product_name;
    $product->purchase_price = $request->purchase_price;
    $product->sale_price = $request->sale_price;
    $product->discount = $request->discount;
    $product->status = $request->status;
    $product->category_id = $request->category_id;

    // Handle the image upload if provided
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = time().'.'.$image->getClientOriginalExtension(); // Specify the destination path and file name
        $destinationPath = public_path('images');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->resize(150, 150, function ($constraint) {
		    $constraint->aspectRatio();
		})->save($destinationPath. '/'.$imagePath);
        $destinationPath = public_path('images');
       // Move the uploaded image to the specified location
        $product->image = $imagePath;


    }

    // Save the product
    $product->save();

    // Redirect to the index page with a success message
    return response()->json([
        'data' => $product,
        'message' => 'Product created successfully.',
    ], 201);
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json([
            'data' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return response()->json([
            'data' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image',
            'product_name' => 'required',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'discount' => 'required|numeric',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
        ]);



        // Find the product to update
        $product = Product::findOrFail($id);
        $product->product_name = $request->product_name;
        $product->purchase_price = $request->purchase_price;
        $product->sale_price = $request->sale_price;
        $product->discount = $request->discount;
        $product->status = $request->status;
        $product->category_id = $request->category_id;

        // Handle the image update if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('public\images');
            $product->image = $imagePath;
        }

        // Save the updated product
        $product->save();

        // Redirect to the index page with a success message
        return response()->json([
            'data' => $product,
            'message' => 'Product updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // $imagePath = public_path($product->image);

        // // Check if the image file exists
        // if (file_exists($imagePath)) {
        //     // Delete the image file
        //     unlink($imagePath);
        // }


        // Delete the product
        $product->delete();

        // Redirect to the index page with a success message
        return response()->json([
            'message' => 'Product deleted successfully.',
        ]);
    }
}
