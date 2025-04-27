@extends('layouts.master')

@section('title', 'Add Sale | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Create Sales</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Sales</li>
                <li class="breadcrumb-item"><a href="#">Create</a></li>
            </ul>
        </div>


         <div class="row">
             <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Sales</h3>
                    <div class="tile-body">

    <div class="container">
        @livewire('sales.sales-create', ['products'])
    </div>

                    </div>
                </div>
            </div>
         </div>
    </main>
@endsection
