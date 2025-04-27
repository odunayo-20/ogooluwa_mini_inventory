<!DOCTYPE html>
<html>
<head>
    <title>{{ $reportOf }}</title>
    <link rel="stylesheet" href="{{ asset('pdf.css') }}" type="text/css">
    <style>

        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }

table {
    width: 100%;
    border-spacing: 0;
    border-collapse: collapse;
}
table.products {
    font-size: 0.875rem;
}
table.products tr {
    background-color: rgb(96 165 250);
}
table.products th {
    color: #ffffff;
    padding: 0.5rem;
}
table tr.items {
    background-color: rgb(241 245 249);
}
table tr.items td {
    padding: 0.5rem;
}
.total {
    text-align: right;
    margin-top: 1rem;
    font-size: 0.875rem;
}

    </style>
</head>
<body>
    <h1>{{$reportOf}}</h1>
    <div>
<div style="overflow: auto">
        <table class="products">
            <thead>
                <tr>
                    <th>Order Id</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Discount</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($sales as $sale)
                <tr class="items">
                    <td>{{ $sale->order_number }}</td>
                    <td>{{ $sale->product->name }}</td>
                    <td>{{ $sale->quantity }}</td>
                    <td>{{ $sale->discount }}%</td>
                    <td>N{{ number_format($sale->unit_price, 2)  }}</td>
                    <td>N{{ number_format($sale->total_price, 2)  }}</td>
                        <td>{{ $sale->created_at->format('Y-m-d') }}</td>
                </tr>
                @empty
                <tr class="items">

                    <td style="font-size: 20px" class="justify-content-center" colspan="7">No Record Found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

        <div class="total">
            Total : N{{number_format($totalAmount, 2) }}
        </div>
        <div class="footer margin-top">
            <div>Thank you</div>
            <div>&copy; Ogooluwa</div>
        </div>
    </div>
</body>
</html>
