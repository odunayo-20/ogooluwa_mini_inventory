<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Sales;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use App\Models\SalesItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
         $sales = Sale::all();
         return view('sales.index', compact('sales'));
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         $customers = Customer::all();
         $products = Product::all();
         return view('sales.create', compact('customers','products'));
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

             'customer_id' => 'required',
             'product_id' => 'required',
             'qty' => 'required',
             'price' => 'required',
             'dis' => 'required',
             'amount' => 'required',
         ]);

         $invoice = new Sale();
         $invoice->customer_id = $request->customer_id;
         $invoice->total = 1000;
         $invoice->save();

         foreach ( $request->product_id as $key => $product_id){
             $sale = new SalesItem();
             $sale->qty = $request->qty[$key];
             $sale->price = $request->price[$key];
             $sale->dis = $request->dis[$key];
             $sale->amount = $request->amount[$key];
             $sale->product_id = $request->product_id[$key];
             $sale->invoice_id = $invoice->id;
             $sale->save();


          }

          return redirect('sales/'.$invoice->id)->with('message','Invoice created Successfully');




     }

     public function findPrice(Request $request){
         $data = DB::table('products')->select('sales_price')->where('id', $request->id)->first();
         return response()->json($data);
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
public function show($id)
     {
         $sale = Sale::findOrFail($id);
         $salesItem = SalesItem::where('sale_id', $id)->get();
         return view('sales.show', compact('sale','salesItem'));

     }


// public function show($id)
// {
//     // Find the sale with its related customer and sales items
//     $sale = Sale::with('customer', 'salesItem.product')->findOrFail($id);

//     // You can also filter based on customer name and sale date, but since
//     // you're showing by ID, this part would typically be handled in a search or index function.
//     // However, if you still want to display customer and date info on the page:
//     $salesItem = $sale->salesItems;

//     // Pass the sale and related items to the view
//     return view('sales.show', compact('sale', 'salesItem'));
// }

// public function show($customer_id)
// {
//     // Fetch all sales for the specific customer and load related sales items and products
//     $sales = Sale::with('salesItem.product')
//                 ->where('customer_id', $customer_id)
//                 // ->whereDate('sale_date')
//                 ->orderBy('sale_date', 'desc') // Order by date, if needed
//                 ->get();

//     $customer = Customer::findOrFail($customer_id);

//     return view('sales.show', compact('sales', 'customer'));
// }


     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         $customers = Customer::all();
         $products = Product::orderBy('id', 'DESC')->get();
         $invoice = Sale::findOrFail($id);
         $sales = SalesItem::where('invoice_id', $id)->get();
         return view('sales.edit', compact('customers','products','invoice','sales'));
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

         'customer_id' => 'required',
         'product_id' => 'required',
         'qty' => 'required',
         'price' => 'required',
         'dis' => 'required',
         'amount' => 'required',
     ]);

         $invoice = Sale::findOrFail($id);
         $invoice->customer_id = $request->customer_id;
         $invoice->total = 1000;
         $invoice->save();

         SalesItem::where('sale_id', $id)->delete();

         foreach ( $request->product_id as $key => $product_id){
             $sale = new SalesItem();
             $sale->qty = $request->qty[$key];
             $sale->price = $request->price[$key];
             $sale->dis = $request->dis[$key];
             $sale->amount = $request->amount[$key];
             $sale->product_id = $request->product_id[$key];
             $sale->sale_id = $invoice->id;
             $sale->save();


         }

          return redirect('sales/'.$invoice->id)->with('message','invoice created Successfully');


     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

    //  public function destroy($id)
    //  {
    //     $sale = SalesItem::where('product_id', $id)->get();
    //     if($sale){
    //         $product = Product::find($sale);

    //         if($product){
    //             $product->unit += $sale->quantity;
    //             $product->save();
    //         }
    //     }
    //     $sale->delete();
    //      $invoice = Sale::findOrFail($id);
    //      $invoice->delete();
    //      return redirect()->back();

    //  }

    public function destroy($id)
{
    // Retrieve all sales items that match the product_id
    $salesItems = SalesItem::where('product_id', $id)->get();

    // Loop through each sales item and update the product stock
    foreach ($salesItems as $sale) {
        $product = Product::find($sale->product_id);

        if ($product) {
            // Update the product's stock quantity
            $product->unit += $sale->quantity;
            $product->save();
        }

        // Delete the sales item
        $sale->delete();
    }

    // Find and delete the related sale (invoice)
    $invoice = Sale::findOrFail($id);
    $invoice->delete();

    return redirect()->back();
}

 }
