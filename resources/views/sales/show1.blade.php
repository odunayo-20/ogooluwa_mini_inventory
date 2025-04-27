@extends('layouts.master')

@section('title', 'Show Sales | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-file-text-o"></i> Sales</h1>
                <p>A Printable Sales Format</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Sales</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <section class="invoice">
                        <div class="row mb-4">
                            <div class="col-6">
                                <h2 class="page-header text-uppercase"><i class="fa fa-file"></i> Ogooluwa</h2>
                            </div>
                            <div class="col-6">
                                {{-- <h5 class="text-right">Date: {{$sale->created_at->format('Y-m-d')}}</h5> --}}
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-6">From
                                <address><strong>Ogooluwa</strong><br>Address<br>Obada market, via enery filling station,<br>Emure-ile, Owo.</address>
                            </div>
                            <div class="col-md-6">
                                <h4>Sales for {{ $customer->name }}</h4>

        <address>Customer Information</address>
        <p><strong>Name:</strong> {{ $customer->name }}</p>
        <p><strong>Email:</strong> {{ $customer->email }}</p>
                            </div>

                            {{-- <div class="col-4">To
                                 <address><strong>{{$sale->customer->name}}</strong><br>{{$sale->customer->address}}<br>Phone: {{$sale->customer->mobile}}<br>Email: {{$sale->customer->email}}</address>
                             </div>
                            <div class="col-4"><b>Sale #{{1000+$sale->id}}</b><br><br><b>Order ID:</b> {{ $sale->order_number }}<br><b>Payment Due:</b> {{$sale->created_at->format('Y-m-d')}}<br><b>Payment Method:</b> {{$sale->payment_method}}</div>
                        </div> --}}


    <div class="container">
        {{-- <h1>Sales for {{ $customer->name }}</h1>

        <h3>Customer Information</h3>
        <p><strong>Name:</strong> {{ $customer->name }}</p>
        <p><strong>Email:</strong> {{ $customer->email }}</p> --}}

        <h3>Sales Orders</h3>

        @if($sales->isEmpty())
            <p>No sales found for this customer.</p>
        @else
            @foreach($sales as $sale)
                <h4>Sale Date: {{ $sale->sale_date }}</h4>
                <h4>Order Number: {{ $sale->order_number }}</h4>
                <h4>Total Amount: {{ $sale->total_amount }}</h4>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            {{-- <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th> --}}

                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->salesItem as $item)
                            <tr>

                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->unit_price }}</td>
                                <td>{{ $item->discount }}</td>
                                <td>{{ $item->total_price }}</td>
                                <td style="display: none">
                                    {{-- {{$Amount += $total = $item->total_price }} --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <hr>
            @endforeach
            <tfoot>
                <tr>
                    {{-- {{ $Amount }} --}}
                    {{-- <td><b class="total">N{{number_format($total, 2)}}</b></td> --}}
                </tr>
            </tfoot>
        @endif
    </div>

                        {{-- <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Amount</th>
                                     </tr>
                                    </thead>
                                    <tbody>
                                    <div style="display: none">
                                        {{$total=0}}
                                    </div>
                                    @foreach($sale->salesItem as $item)
                                    <tr>

                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->unit_price }}</td>
                                        <td>{{ $item->total_price }}</td>
                                    </tr>
                                @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td>  </td>
                                        <td></td>
                                        <td></td>
                                        <td><b>Total</b></td>
                                        <td><b class="total">N{{number_format($total, 2)}}</b></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div> --}}
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:void(0);" onclick="printInvoice();"><i class="fa fa-print"></i> Print</a></div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>


    <script>
    function printInvoice() {
        window.print();
    }
    </script>

@endsection
@push('js')
@endpush





