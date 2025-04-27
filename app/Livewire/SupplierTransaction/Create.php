<?php

namespace App\Livewire\SupplierTransaction;

use App\Models\Product;
use Livewire\Component;
use App\Models\Supplier;
use App\Models\ProductSupplier;
use App\Models\SupplierTransaction;

class Create extends Component
{
    public $suppliers;
    public $products;
    public $selectedSupplier;
    public $selectedProduct;
    public $transactionType;
    public int $quantity = 1;
    public int $amountPaid = 0;
    public int $pricePerUnit = 0; // Price from the product_supplier pivot table
    public int $remainingAmount = 0;
    public int $totalCost = 0;

    public function mount()
    {
        $this->suppliers = Supplier::orderBy('name', 'asc')->get();
        $this->products = collect();
        // $this->calculatedAmount()
    }

    public function updatedSelectedSupplier($supplierId)
    {
        // Get products from this supplier via the pivot table
        $this->products = Product::whereHas('suppliers', function ($query) use ($supplierId) {
            $query->where('supplier_id', $supplierId);
        })->orderBy('name', 'asc')->get();
    }


    public function updatedSelectedProduct($productId)
    {
        // Get price per unit for this product-supplier combination
        $productSupplier = ProductSupplier::where('product_id', $productId)
                                          ->where('supplier_id', $this->selectedSupplier)
                                          ->first();

        $this->pricePerUnit = $productSupplier->price;
        $this->totalCost = $this->quantity * $this->pricePerUnit;

    }

    public function updatedQuantity(){
        $this->totalCost = $this->pricePerUnit * $this->quantity;
        $this->remainingAmount = $this->totalCost - $this->amountPaid;

    }
    public function updatedAmountPaid(){
        // Calculate total cost based on price per unit
        $this->totalCost = $this->pricePerUnit * $this->quantity;
        $this->remainingAmount = $this->totalCost - $this->amountPaid;

}


    public function createTransaction()
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

        // Create the transaction with payment details
        SupplierTransaction::create([
            'product_id' => $this->selectedProduct,
            'quantity' => $this->quantity,
            'total_price' => $totalCost,
            'total_cost' => $totalCost,
            'amount_paid' => $this->amountPaid,
            'amount_due' => $remainingAmount,
            'supplier_id' => $this->selectedSupplier,
        ]);



            // Update product stock
            $product = Product::findOrFail($this->selectedProduct);

            if($product){

                $product->unit += $this->quantity;
            }
            $product->save();

        session()->flash('message', 'Transaction and payment recorded successfully!');
        return redirect(route('transaction.index'));
    }

    public function render()
    {
        return view('livewire.supplier-transaction.create');
    }
}
