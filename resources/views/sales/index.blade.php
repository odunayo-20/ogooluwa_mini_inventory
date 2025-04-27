

@extends('layouts.master')

@section('title', 'Sales | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Sales Table</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Sale</li>
                <li class="breadcrumb-item active"><a href="#">Sales Table</a></li>
            </ul>
        </div>
        <div class="">
            <a class="btn btn-primary" href="{{route('sales.create')}}"><i class="fa fa-plus"></i> Create New Sale</a>
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
                    <div class="tile-body"  style="overflow: auto">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Sale ID </th>
                                <th>Payment Method</th>
                                <th>Customer Name </th>
                                <th>Date </th>
                                <th>Action</th>
                            </tr>
                            </thead>
                             <tbody>

                             @foreach($sales as $sale)
                                 <tr>
                                     <td>{{1000+$sale->id}}</td>
                                     <td>{{ $sale->payment_method }}</td>
                                     <td>{{$sale->customer->name}}</td>
                                     <td>{{$sale->sale_date}}</td>
                                     <td>
                                         <a class="btn btn-primary btn-sm" href="{{route('sales.show', $sale->id)}}"><i class="fa fa-eye" ></i></a>
                                         <a style="display: none" class="btn btn-info btn-sm" href="{{route('sales.edit', $sale->id)}}"><i class="fa fa-edit" ></i></a>

                                         <form class="d-inline" action="{{ route('sales.destroy',$sale->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm waves-effect" type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
{{--
                                         <button class="btn btn-danger btn-sm waves-effect" type="submit" onclick="deleteTag({{ $sale->id }})">
                                             <i class="fa fa-trash"></i>
                                         </button>
                                         <form id="delete-form-{{ $sale->id }}" action="{{ route('sales.destroy',$sale->id) }}" method="POST" style="display: none;">
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
