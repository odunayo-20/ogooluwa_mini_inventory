<?php

namespace App\Livewire\SupplierTransaction;

use App\Models\Product;
use App\Models\SupplierTransaction;
use Livewire\Component;
use App\Models\Supplier;
use App\Models\ProductSupplier;

class Edit extends Component
{


    public $transactionId;
    public $transaction;
    public $suppliers;
    public $products;
    public $selectedSupplier;
    public $selectedProduct;
    public $transactionType;
    // public $quantity;
    // public $amountPaid;
    // public $pricePerUnit; // Price from the product_supplier pivot table

    public int $quantity = 1;
    public int $amountPaid = 0;
    public int $pricePerUnit = 0; // Price from the product_supplier pivot table
    public int $remainingAmount;
    public int $totalCost;



    public function mount($transactionId)
    {
        $this->transactionId = $transactionId;
        $this->transaction = SupplierTransaction::findOrFail($transactionId);

        // Load the data into the component properties
        $this->selectedSupplier = $this->transaction->supplier_id;
        $this->selectedProduct = $this->transaction->product_id;
        $this->quantity = $this->transaction->quantity;
        $this->amountPaid = $this->transaction->amount_paid;
        $this->totalCost = $this->transaction->total_cost;
        $this->remainingAmount = $this->transaction->amount_due;

        // Fetch the price per unit from the pivot table
        $productSupplier = ProductSupplier::where('product_id', $this->selectedProduct)
            ->where('supplier_id', $this->selectedSupplier)
            ->first();

        $this->pricePerUnit = $productSupplier->price;

        // Populate dropdowns
        $this->suppliers = Supplier::all();
        $this->products = Product::whereHas('suppliers', function ($query) {
            $query->where('supplier_id', $this->selectedSupplier);
        })->get();
    }

    public function updatedSelectedSupplier($supplierId)
    {
        // Get products from this supplier via the pivot table
        $this->products = Product::whereHas('suppliers', function ($query) use ($supplierId) {
            $query->where('supplier_id', $supplierId);
        })->get();

        // Reset selected product and price per unit
        $this->selectedProduct = null;
        $this->pricePerUnit = null;
    }

    public function updatedSelectedProduct($productId)
    {
        // Get price per unit for this product-supplier combination
        $productSupplier = ProductSupplier::where('product_id', $productId)
            ->where('supplier_id', $this->selectedSupplier)
            ->first();

        $this->pricePerUnit = $productSupplier->price;
    }
    public function updatedQuantity()
    {
        $this->totalCost = $this->pricePerUnit * $this->quantity ?? 0;
        $this->remainingAmount = $this->totalCost - $this->amountPaid;
    }
    public function updatedAmountPaid()
    {
        // Calculate total cost based on price per unit
        $this->totalCost = $this->pricePerUnit * $this->quantity ?? 0;
        $this->remainingAmount = $this->totalCost - $this->amountPaid;
    }

    public function updateTransaction()
    {
        $this->validate([
            'selectedSupplier' => 'required',
            'selectedProduct' => 'required',
            'quantity' => 'required|integer|min:1',
            'amountPaid' => 'required|numeric|min:0',
        ]);

        // Calculate total cost based on price per unit
        $totalCost = $this->pricePerUnit * $this->quantity;
        $remainingAmount = $totalCost - $this->amountPaid;

        // Update the transaction with new details
        $this->transaction->update([
            'product_id' => $this->selectedProduct,
            'quantity' => $this->quantity,
            'total_price' => $totalCost,
            'total_cost' => $totalCost,
            'amount_paid' => $this->amountPaid,
            'amount_due' => $remainingAmount,
            'supplier_id' => $this->selectedSupplier,
        ]);

        // Update product stock
        // $product = Product::find($this->selectedProduct);

        // $product->unit += $this->quantity;
        // $product->save();

        session()->flash('message', 'Transaction updated successfully!');

        return redirect()->route('transaction.index');
    }


    public function render()
    {
        return view('livewire.supplier-transaction.edit');
    }
}
