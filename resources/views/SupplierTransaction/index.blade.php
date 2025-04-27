

@extends('layouts.master')

@section('title', 'Transaction | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Transactions Table</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item active"><a href="#">Transactions Table</a></li>
            </ul>
        </div>
        <div class="">
            <a class="btn btn-primary" href="{{route('transaction.create')}}"><i class="fa fa-plus"></i> Create New Transaction</a>
        </div>
<div>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
</div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body" style="overflow: auto">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Supplier</th>
                                    <th>Quantity</th>
                                    <th>Total Cost</th>
                                    <th>Amount Paid</th>
                                    <th>Amount Due</th>
                                    <th>Date & Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                             <tbody>
                                @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->product->name }}</td>
                                    <td>{{ $transaction->supplier->name }}</td>
                                    <td>{{ $transaction->quantity }}</td>
                                    <td>{{ number_format($transaction->total_cost, 2) }}</td>
                                    <td>{{ number_format($transaction->amount_paid, 2) }}</td>
                                    <td>{{ number_format($transaction->amount_due, 2) }}</td>
                                    <td>{{ $transaction->created_at->format('Y-m-d h:ia') }}</td>
                                    {{-- <td>{{ $transaction->created_at->format('H:ia') }}</td> --}}
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('transaction.edit', $transaction->id) }}"><i class="fa fa-edit" ></i></a>
                                        <form class="d-inline" action="{{ route('transaction.destroy',$transaction->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm waves-effect" type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        {{-- <button class="btn btn-danger btn-sm waves-effect" type="submit" onclick="deleteTag({{ $transaction->id }})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $transaction->id }}" action="{{ route('transaction.destroy',$transaction->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </main>



@endsection

@push('js')
    <script type="text/javascript" src="{{asset('/')}}js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteTag(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush
