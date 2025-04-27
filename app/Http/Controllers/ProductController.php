<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\ProductSupplier;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
         $products = Product::all();
         $additional = ProductSupplier::all();
        //  dd($additional->products);
         return view('product.index', compact('products','additional'));
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         $suppliers =Supplier::all();
         $categories = Category::all();

         return view('product.create', compact('categories','suppliers'));
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
            //  'name' => 'required|min:3|unique:products|regex:/^[a-zA-Z ]+$/',
            'name' => 'required|min:3|unique:products,name',
            'serial_number' => 'required',
             'model' => 'required|min:3',
             'category_id' => 'required',
             'sales_price' => 'required',
             'unit' => 'required',
             'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'supplier_id' => 'required',
             'supplier_price' => 'required',

         ]);


         $product = new Product();
         $product->name = $request->name;
         $product->serial_number = $request->serial_number;
         $product->model = $request->model;
         $product->category_id = $request->category_id;
         $product->sales_price = $request->sales_price;
         $product->unit = $request->unit;


         if ($request->hasFile('image')) {
             $image = $request->file('image');
             $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
             $image->move(public_path('images/product/'), $imageName);
             $product->image = $imageName;
         }



         $product->save();

        //  foreach($request->supplier_id as $key => $supplier_id){
             $supplier = new ProductSupplier();
             $supplier->product_id = $product->id;
             $supplier->supplier_id = $request->supplier_id;
             $supplier->price = $request->supplier_price;
             $supplier->save();
        //  }
         return redirect()->back()->with('message', 'New product has been added successfully');
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
         //
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         $productId = $id; // The specific product ID you want to retrieve associated ProductSupplier record for
 $additional = ProductSupplier::where('product_id', $productId)->first();

         $product =Product::findOrFail($id);
         $suppliers =Supplier::all();
         $categories = Category::all();
         return view('product.edit', compact('additional','suppliers','categories','product'));
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

     public function update(Request $request, $id)
 {
     $request->validate([
         'name' => 'required|min:3|unique:products,name,' . $id,
         'serial_number' => 'required',
         'model' => 'required|min:3',
         'category_id' => 'required',
         'sales_price' => 'required',
         'supplier_id' => 'required',
         'supplier_price' => 'required|numeric|min:0',
     ]);

     $product = Product::find($id);

    //  dd($product);
     if (!$product) {
         return redirect()->back()->with('error', 'Product not found');
     }

     $product->name = $request->name;
     $product->serial_number = $request->serial_number;
     $product->model = $request->model;
     $product->category_id = $request->category_id;
     $product->sales_price = $request->sales_price;
     $product->unit = $request->unit;


     if ($request->hasFile('image')) {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',

        ]);
         // Delete the existing image file if it exists
         $existingImagePath = public_path("images/product/{$product->image}");
         if (file_exists($existingImagePath) && is_file($existingImagePath)) {
             unlink($existingImagePath);
         }

         $imageName = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
         $request->image->move(public_path('images/product/'), $imageName);

         $product->image = $imageName;
     }


     $product->save();

             // Update or create product suppliers
    //  foreach ($request->supplier_id as $key => $supplier_id) {
         $supplier = ProductSupplier::where('product_id', $product->id)
             ->where('supplier_id', $request->supplier_id)
             ->first();

         if (!$supplier) {
             $supplier = new ProductSupplier();
             $supplier->product_id = $product->id;
             $supplier->supplier_id = $request->supplier_id;
         }

         $supplier->price = $request->supplier_price;
         $supplier->save();
    //  }

     return redirect(route('product.index'))->with('message', 'Product has been updated successfully');
 }


     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    //  public function destroy($id)
    //  {
    //      $product = Product::find($id);
    //     //  if($product){
    //         $productSupplier = ProductSupplier::where('product_id', $id)->get();
    //     // }
    //     $productSupplier->delete();
    //      $product->delete();
    //      return redirect()->back();

    //  }

    public function destroy($id)
{
    $product = Product::find($id);

    if ($product) {
        // Delete associated product suppliers
        ProductSupplier::where('product_id', $id)->delete();

        // Delete the product itself
        $product->delete();

        return redirect()->back()->with('message', 'Product deleted successfully.');
    }

    return redirect()->back()->with('error', 'Product not found.');
}

 }
