

@extends('layouts.master')

@section('title', 'Product | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Product Table</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Product</li>
                <li class="breadcrumb-item active"><a href="#">Product Table</a></li>
            </ul>
        </div>
        <div class="">
            <a class="btn btn-primary" href="{{route('product.create')}}"><i class="fa fa-plus"></i> Add Product</a>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body"  style="overflow: auto">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Product </th>
                                <th>Model </th>
                                <th>Serial</th>
                                <th>Sales Price</th>
                                <th>Purchase Price</th>
                                <th>Supplier</th>
                                <th>Unit</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                             <tbody>

                             @foreach($additional as $add)
                                 <tr>
                                     <td>{{$add->product->name}}</td>
                                     <td>{{$add->product->model}}</td>
                                     <td>{{$add->product->serial_number}}</td>
                                     <td>{{$add->product->sales_price}}</td>
                                     <td>{{$add->price}}</td>
                                     <td>{{$add->supplier->name}}</td>
                                     <td>{{  $add->product->unit}}</td>
                                     <td><img width="40px" src="{{ asset('images/product/'.$add->product->image) }}"></td>

                                     <td>
                                         <a class="btn btn-primary btn-sm" href="{{ route('product.edit', $add->product->id) }}"><i class="fa fa-edit" ></i></a>

                                         <form class="d-inline" action="{{ route('product.destroy',$add->product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm waves-effect" type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>


                                         {{-- <button class="btn btn-danger btn-sm waves-effect" type="submit" onclick="deleteTag({{ $add->product->id }})">
                                             <i class="fa fa-trash"></i>
                                         </button>
                                         <form id="delete-form-{{ $add->product->id }}" action="{{ route('product.destroy',$add->product->id) }}" method="POST" style="display: none;">
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
