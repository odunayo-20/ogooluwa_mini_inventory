<div>

    @if(session()->has('error'))

    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif

    <form wire:submit.prevent="submit">
            <div class="form-group col-md-3">

                <label>Customer Name</label>
                <select name="" wire:model="customer_id" id="" class="form-control">
                    <option value="">--Select Customer</option>
                    @foreach ($customers as $customer)

                    <option value="{{ $customer->id }}">{{ $customer->name}}</option>
                    @endforeach
                </select>
                @error('customer_id') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group col-md-3">

                <label>Payment Method</label>
                <select name="" wire:model="payment_method" id="" class="form-control">
                    <option value="">--Select Payement</option>

                    <option value="Transfer">Transfer</option>
                    <option value="Cash">Cash</option>
                </select>
                @error('payment_method') <span class="error">{{ $message }}</span> @enderror
            </div>

        <div class="form-group col-md-3">
            <label>Date</label>
            <input value="<?php echo date('Y-m-d')?>" type="date" wire:model="sale_date"  value="{{ Carbon\Carbon::now() }}" class="form-control datepicker">
            @error('sale_date') <span class="error">{{ $message }}</span> @enderror
        </div>
<div class="row">
    <div class="form-group col-md-3">
        <label>Academic Session</label>
        <select wire:model="selectedSession" class="form-control">
            <option value="">Select Session</option>
            @foreach ($availableSessions as $session)
                <option value="{{ $session }}">{{ $session }}</option>
            @endforeach
        </select>
        @error('selectedSession') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group col-md-3">
        <label>Terms</label>
        <select wire:model="term" name="" id="" class="form-control">
            <option>--Select Terms</option>
            <option value="Frist Term">First Term</option>
            <option value="Second Term">Second Term</option>
            <option value="Third Term">Third Term</option>
        </select>
    </div>

</div>

<div style="overflow: auto">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Avaiable Quantity</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Discount %</th>
                    <th scope="col">Amount</th>
                    <th scope="col">
                        <button type="button" wire:click.prevent="addRow" class="badge badge-success text-white">
                            <i class="fa fa-plus"></i> Add Row
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>


        <!-- Dynamic product rows -->
        @foreach($products as $index => $product)
        <tr>
            <td>
                <select wire:model.lazy="products.{{ $index }}.product_id" class="form-control">
                    <option value="">--Select Product--</option>
                    @foreach ($availableProducts as $availableProduct)
                        <option value="{{ $availableProduct->id }}">{{ $availableProduct->name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" readonly wire:model.lazy="products.{{ $index }}.unit" class="form-control">
            </td>

            <td>
                <input type="number" wire:model.lazy="products.{{ $index }}.quantity" class="form-control" min="1">
                            <div>
                                @error('quantity') <span class="error">{{ $message }}</span> @enderror
                            </div>
            </td>
            <td><input type="number" wire:model.lazy="products.{{ $index }}.sales_price" class="form-control" readonly>
                <div>
                    @error('sales_price') <span class="error">{{ $message }}</span> @enderror
                </div>
            </td>
            <td><input type="number" value="0" wire:model.lazy="products.{{ $index }}.dis" class="form-control">
                <div>
                    @error('dis') <span class="error">{{ $message }}</span> @enderror
                </div>
</td>
<td><input type="number" wire:model.lazy="products.{{ $index }}.amount" class="form-control" readonly>
    <div>
        @error('amount') <span class="error">{{ $message }}</span> @enderror
    </div>
</td>
<td>
    <button type="button" wire:click.prevent="removeRow({{ $index }})" class="btn btn-danger">
        <i class="fa fa-remove"></i>
    </button>
</td>
        </tr>

        @endforeach
            </tbody>
        </table>
        <!-- Add New Product Button -->
    </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
    <style>
        .error{
            color: red;
        }
    </style>

</div>


