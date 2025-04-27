<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\SupplierTransaction;

class SupplierTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = SupplierTransaction::orderBy('id')->get();
        return view('SupplierTransaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('SupplierTransaction.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaction = SupplierTransaction::findOrFail($id);
        return view('SupplierTransaction.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the transaction by its ID
        $transaction = SupplierTransaction::findOrFail($id);

        // Assuming that the transaction directly contains a 'product_id' and 'quantity'
        $product = Product::find($transaction->product_id);

        if ($product) {
            // Update the product's stock by adding the quantity back
            if($transaction){

                $product->unit -= $transaction->quantity;
            }
            $product->save();
        }

        // Now delete the transaction itself
        $transaction->delete();

        // Redirect back with success message
        return redirect()->back()->with('message', 'Transaction Deleted Successfully');
    }




    public function calender(){
        return view('SupplierTransaction.calender');
    }

}
