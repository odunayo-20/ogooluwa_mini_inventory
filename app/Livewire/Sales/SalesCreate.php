<?php

namespace App\Livewire\Sales;

use App\Models\Sale;

use App\Models\Product;

use Livewire\Component;
use App\Models\Customer;
use App\Models\SalesItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SalesCreate extends Component
{
    public $products = []; // This will hold multiple products
    public $customer_id;
    public $sale_date;
    public $payment_method;
    public $total_amount;
    public $selectedSession;
    public $availableSessions = [];

    public $term;
    // public $total_amount;

    public function mount()
    {
        $this->products[] = [
            'product_id' => '',
            'quantity' => 1,
            'sales_price' => 0,
            'dis' => 0,
            'amount' => 0,
        ];
        $this->sale_date = Carbon::now()->format('Y-m-d');

        // Generate available sessions dynamically, e.g., from 2018/2019 to 2030/2031
        $currentYear = Carbon::now()->year;
        $startYear = 2018; // Example: start from 2018
        $endYear = $currentYear + 5; // Example: show sessions up to 5 years from now

        for ($year = $startYear; $year <= $endYear; $year++) {
            $nextYear = $year + 1;
            $this->availableSessions[] = "{$year}/{$nextYear}";
        }

    }
public function updatedSelectedSession()
{
    $this->validate([
        'selectedSession' => 'required',
    ]);
}

    // Method to add a new product row
    public function addRow()
    {
        $this->products[] = [
            'product_id' => '',
            'quantity' => 1,
            'sales_price' => 0,
            'dis' => 0,
            'amount' => 0,
        ];
    }

    // Method to remove a product row
    public function removeRow($index)
    {
        unset($this->products[$index]);
        $this->products = array_values($this->products); // reindex the array
    }

    // Method triggered when a product is selected
    public function updatedProducts($value, $key)
    {
        list($index, $field) = explode('.', $key);

        // When a product_id is selected, update its price and discount
        if ($field == 'product_id') {
            $product = Product::find($value);
            if ($product) {
                $this->products[$index]['sales_price'] = $product->sales_price;
                $this->products[$index]['dis'] = $product->dis;
                $this->products[$index]['unit'] = $product->unit;
                $this->total_amount =   $this->calculateAmount($index);
            }
        }

        // Recalculate amount when quantity or other relevant fields change
        if (in_array($field, ['quantity', 'sales_price', 'dis'])) {
            $this->calculateAmount($index);
        }
    }

    // Calculate the amount based on price, quantity, and discount
    public function calculateAmount($index)
    {
        // dd($this->products);
        $this->products[$index]['amount'] =
            ($this->products[$index]['sales_price'] * $this->products[$index]['quantity']) - ($this->products[$index]['dis'] * $this->products[$index]['sales_price'] * $this->products[$index]['quantity']) / 100;
    }

    // var amount = (qty * price)-(qty * price * dis)/100;


    // public function submit()
    // {
    //     // validation and before submission
    //     $this->validate([
    //         'customer_id' => 'required|string',
    //         'date' => 'required|date',
    //         'products.*.product_id' => 'required|exists:products,id',
    //         'products.*.quantity' => 'required|integer|min:1',
    //         'products.*.sales_price' => 'required|numeric',
    //         'products.*.amount' => 'required|numeric',
    //     ]);






    //     foreach ($this->products as $index => $product) {


    //         $productModel = Product::find($product['product_id']);

    //         // checking if requested quantity is greater than availaible unit
    //         if ($product['quantity'] > $productModel->unit) {

    //             session()->flash('error', "Sorry $productModel->name product quantity is not available. Only $productModel->unit quantity is available");
    //             break;
    //         } else {
    //             // Create the sale record
    //             $sale = Invoice::create([
    //                 'customer_id' => $this->customer_id,
    //                 'total' => array_sum(array_column($this->products, 'amount')), // Total amount of the sale,
    //                 // 'total' => 1000,
    //             ]);

    //             // Create a SaleItem for each product sold
    //             Sale::create([
    //                 'invoice_id' => $sale->id, // Reference to the sale
    //                 'product_id' => $product['product_id'], // The product ID
    //                 'qty' => $product['quantity'], // Quantity of the product sold
    //                 'price' => $product['sales_price'], // Price of the product
    //                 'dis' => $product['dis'] ?? 0, // Discount if any
    //                 'amount' => $product['amount'], // The total amount for this product
    //             ]);
    //             // Decrease the quantity in the product inventory
    //             if ($productModel) {
    //                 $productModel->unit -= $product['quantity']; // Reduce stock
    //                 $productModel->save(); // Save the updated product
    //             }
    //             session()->flash('message', 'Sale successfully created, and stock updated.');
    //         }
    //     }
    // }
    public function generateOrderNumber($product_id)
    {
        // Get current date in YYYYMMDD format
        $date = Carbon::now()->format('Ymd');

        // Get product ID
        $productId = $product_id;

        // Generate a random 3-digit number for uniqueness
        $uniqueNumber = mt_rand(100, 999);

        // Combine the fields to create the order number
        $orderNumber = "ORD-{$date}-PRD{$productId}-{$uniqueNumber}";
      //   ORD-20240914-0002
        return $orderNumber;
    }

//     public function submit()
// {
//     // Validate request before submission
//     $this->validate([
//         'customer_id' => 'required|string',
//         'payment_method' => 'required',
//         'sale_date' => 'required|date',
//         'products.*.product_id' => 'required|exists:products,id',
//         'products.*.quantity' => 'required|integer|min:1',
//         'products.*.sales_price' => 'required|numeric',
//         'products.*.amount' => 'required|numeric',
//         'selectedSession' => 'required',
//         'term' => 'required',
//     ]);

//     foreach ($this->products as $index => $product) {
//         $productModel = Product::find($product['product_id']);

//         // Check if requested quantity is greater than available unit
//         if ($product['quantity'] > $productModel->unit) {
//             session()->flash('error', "Sorry $productModel->name product quantity is not available. Only $productModel->unit quantity is available");
//             break;
//         } else {
//                     // Assuming a product_id is passed in the request
//         $product_id = $product['product_id'];

//         // Generate the order number
//         $orderNumber = $this->generateOrderNumber($product_id);

//             // Step 1: Create the invoice (order)
//             $sale = Sale::create([
//                 'customer_id' => $this->customer_id,
//                 'order_number' => $orderNumber,
//                 'payment_method' => $this->payment_method,
//                 'sale_date' => $this->sale_date,
//                 // 'total_amount' => array_sum(array_column($this->products, 'amount')), // Total amount of the sale,
//                 'total_amount'=> $product['amount'],
//             ]);

//             // Step 2: Create a Sale record for each product sold
//             SalesItem::create([
//                 'sale_id' => $sale->id, // Reference to the sale
//                 'product_id' => $product['product_id'], // The product ID
//                 'quantity' => $product['quantity'], // Quantity of the product sold
//                 'unit_price' => $product['sales_price'], // Price of the product
//                 'discount' => $product['dis'] ?? 0, // Discount if any
//                 'total_price' => $product['amount'], // The total amount for this product
//                 'academic_session' => $this->selectedSession,
//                 'term' => $this->term,
//             ]);

//             // Step 3: Decrease the product quantity in the inventory
//             if ($productModel) {
//                 $productModel->unit -= $product['quantity']; // Reduce stock
//                 $productModel->save(); // Save the updated product stock
//             }
//         }
//     }

//     session()->flash('message', 'Sale successfully created, and stock updated.');
//     return redirect(route('sales.index'));
// }



public function submit()
{
    // Validate request before submission
    $this->validate([
        'customer_id' => 'required|string',
        'payment_method' => 'required',
        'sale_date' => 'required|date',
        'products.*.product_id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|integer|min:1',
        'products.*.sales_price' => 'required|numeric',
        'products.*.amount' => 'required|numeric',
        'selectedSession' => 'required',
        'term' => 'required',
    ]);
      // Step 1: Create the invoice (order)
      $sale = Sale::create([
        'customer_id' => $this->customer_id,
        'payment_method' => $this->payment_method,
        'sale_date' => $this->sale_date,
        'total_amount' => '88990',
    ]);

    foreach ($this->products as $index => $product) {
        $productModel = Product::find($product['product_id']);

        // Check if the product exists
        if (!$productModel) {
            session()->flash('error', "The product does not exist.");
            return;
        }

        // Check if requested quantity is less than 1
        if ($productModel->unit < 1) {
            session()->flash('error', "Sorry, $productModel->name is out of stock.");
            return;
        }

        // Check if requested quantity is greater than available stock
        if ($product['quantity'] > $productModel->unit) {
            session()->flash('error', "Sorry, $productModel->name product quantity is not available. Only $productModel->unit quantity is available.");
            return;
        }

        // Assuming a product_id is passed in the request
        $product_id = $product['product_id'];

        // Generate the order number
        $orderNumber = $this->generateOrderNumber($product_id);

        // // Step 1: Create the invoice (order)
        // $sale = Sale::create([
        //     'customer_id' => $this->customer_id,
        //     'order_number' => $orderNumber,
        //     'payment_method' => $this->payment_method,
        //     'sale_date' => $this->sale_date,
        //     'total_amount' => $product['amount'],
        // ]);

        // Step 2: Create a Sale record for each product sold
        SalesItem::create([
            'sale_id' => $sale->id, // Reference to the sale
            'product_id' => $product['product_id'], // The product ID
            'quantity' => $product['quantity'], // Quantity of the product sold
            'order_number' => $orderNumber,

            'unit_price' => $product['sales_price'], // Price of the product
            'discount' => $product['dis'] ?? 0, // Discount if any
            'total_price' => $product['amount'], // The total amount for this product
            'academic_session' => $this->selectedSession,
            'term' => $this->term,
        ]);

        // Step 3: Decrease the product quantity in the inventory
        $productModel->unit -= $product['quantity']; // Reduce stock
        $productModel->save(); // Save the updated product stock
    }

    session()->flash('message', 'Sale successfully created, and stock updated.');
    return redirect(route('sales.index'));
}

    public function render()
    {
        $availableProducts = Product::all();
        // Fetch all products for the dropdown
        $customers = Customer::orderBy('created_at', 'asc')->get();

        return view('livewire.sales.sales-create', compact(['availableProducts', 'customers']));
    }
}
