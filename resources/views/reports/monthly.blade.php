@extends('layouts.master')

@section('title', 'Report | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Report Table</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Report</li>
                <li class="breadcrumb-item"><a href="{{ route('report.daily') }}">Daily Report</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('report.weekly') }}">Weekly Report</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('report.monthly') }}">Monthly Report</a></li>
            </ul>
        </div>
        <div class="d-flex justify-content-between">
            <a class="btn btn-primary" href="{{ route('sales.index') }}"><i class="fa fa-plus"></i> View Sales</a>

            <a class="btn btn-danger" href="{{ route('report.downloadMonthly', 'pdf') }}">Download PDF</a>

        </div>


        <h2>Monthly Sales Report - {{ now()->startOfMonth()->format('Y-m-d') }} to {{ now()->endOfMonth()->format('Y-m-d') }}
        </h2>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body"  style="overflow: auto">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Product </th>
                                <th>Qty </th>
                                <th>Discount </th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Date </th>
                            </tr>
                            </thead>
                            <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->product->name }}</td>
                    <td>{{ $sale->quantity }}</td>
                    <td>{{ $sale->discount }}%</td>
                    <td>N{{ number_format($sale->unit_price, 2)  }}</td>
                    <td>N{{ number_format($sale->total_price, 2)  }}</td>
                        <td>{{ $sale->created_at->format('Y-m-d') }}</td>

                </tr>
            @endforeach
        </tbody>
                        </table>

                        <div style="width: 100%" class="py-4">
                            <h2 style="float: right">

                                Total : N{{ number_format($totalAmount, 2) }}
                            </h2>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('report.downloadWeekly', 'pdf') }}">Download PDF</a>
        {{-- <a href="{{ route('report.download', 'excel') }}">Download Excel</a>
        <a href="{{ route('report.download', 'csv') }}">Download CSV</a> --}}
    </main>

@endsection

@push('js')
    <script type="text/javascript" src="{{asset('/')}}js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

@endpush
