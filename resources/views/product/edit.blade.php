@extends('layouts.master')

@section('title', 'Edit Product | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i>Edit Product</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Product</li>
                <li class="breadcrumb-item"><a href="#">Edit Product</a></li>
            </ul>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        <div class="">
            <a class="btn btn-primary" href="{{route('product.index')}}"><i class="fa fa-edit"></i> Manage Products</a>
        </div>
        <div class="row mt-2">

            <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Edit Product Form</h3>
                    <div class="tile-body">
                        <form method="POST" action="{{route('product.update', $product->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                             <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">Product Name</label>
                                    <input value="{{$additional->product->name}}" name="name" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Product Name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Serial Number</label>
                                    <input value="{{$additional->product->serial_number}}" name="serial_number" class="form-control @error('serial_number') is-invalid @enderror" type="number" placeholder="Enter serial number">
                                    @error('serial_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">Model</label>
                                    <input value="{{$additional->product->model}}" name="model" class="form-control @error('model') is-invalid @enderror" type="text" placeholder="Enter Model Name">
                                    @error('model')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Category</label>

                                    <select name="category_id" class="form-control">
                                        <option value="{{$additional->product->category->id}}">{{$additional->product->category->name}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">Selling Price</label>
                                    <input value="{{$additional->product->sales_price}}" name="sales_price" class="form-control @error('sales_price') is-invalid @enderror" type="number" placeholder="Enter Sales Price">
                                    @error('sales_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Unit</label>
                                    <input type="number" name="unit" class="form-control" value="{{ $additional->product->unit }}">

                                    @error('unit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">Image</label>
                                    <input value="{{$additional->product->image}}" name="image"  class="form-control @error('image') is-invalid @enderror" type="file" >
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="tile ">
                                <div class="row field_wrapper">
                                     <div class="form-group col-md-4">
                                        <select name="supplier_id" class="form-control">
                                            <option value="{{$additional->supplier_id}}">{{$additional->supplier->name}} </option>
                                            @foreach($suppliers as $supplier)
                                                <option value="{{$supplier->id}}">{{$supplier->name}} </option>
                                            @endforeach
                                        </select>
                                        @error('supplier_id')
                                        <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input value="{{$additional->price}}"  name="supplier_price" class="form-control @error('supplier_price') is-invalid @enderror" type="number" placeholder="Enter Sales Price">
                                        @error('supplier_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group col-md-4">
                                        <a href="javascript:void(0);" class="add_button btn btn-primary btn-sm" title="Add field"><i class="fa fa-plus"></i></a>
                                        <a href="javascript:void(0);" class="remove_button btn btn-danger btn-sm" title="Delete field"><i class="fa fa-minus"></i></a>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="form-group col-md-4 align-self-end">
                                <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div><select name="supplier_id[]" class="form-control"><option class="form-control">Select Supplier</option>@foreach($suppliers as $supplier)<option value="{{$supplier->id}}">{{$supplier->name}}</option>@endforeach</select><input name="supplier_price[]" class="form-control" type="text" placeholder="Enter Sales Price"><a href="javascript:void(0);" class="remove_button btn btn-danger" title="Delete field"><i class="fa fa-minus"></i></a></div>'
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

@endpush



