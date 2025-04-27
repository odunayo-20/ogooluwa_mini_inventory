<div>
    <h2>Edit Transaction</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="updateTransaction">
        <div class="row my-2">

            <div class="col-md-6">
                <label for="supplier">Supplier</label>
                <select wire:model.lazy="selectedSupplier" class="form-control " id="supplier">
                    <option value="">Select Supplier</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="product">Product</label>
                <select wire:model.lazy="selectedProduct" class="form-control" id="product">
                    <option value="">Select Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- <div class="col-md-6">
                <label for="transactionType">Transaction Type</label>
                <select wire:model="transactionType" id="transactionType" class="form-control">
                    <option value="">Select Transaction Type</option>
                    <option value="debit">Debit</option>
                    <option value="credit">Credit</option>
                </select>
            </div> --}}

        </div>

<table class="table">
    <thead>
        <tr>
            <th>Quantity</th>
            <th>Price Per Unit</th>
            <th>Amount Paid</th>
            <th>Total Cost</th>
            <th>Remaining Amount</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
         <input wire:model.lazy="quantity" value="1" class="form-control" type="number" required id="quantity" readonly/>
            </td>
            <td>
                <input type="number" value="{{ $pricePerUnit }}" readonly  class="form-control"/>
            </td>
            <td>
                <input wire:model.lazy="amountPaid" class="form-control" type="number" id="amountPaid" step="0.01" min="0" />
            </td>
            <td>
                <input wire:model.lazy="totalCost" class="form-control" value="{{$totalCost}}" type="number" readonly />
            </td>
            <td>
                <input wire:model.lazy="remainingAmount" class="form-control"  value="{{ $remainingAmount }}" type="number" readonly />
            </td>
        </tr>
    </tbody>
</table>

<button type="submit" class="btn btn-primary">Update Transaction</button>



    </form>
</div>
