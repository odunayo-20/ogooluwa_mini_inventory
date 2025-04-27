<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon">
                <i class="icon fa fa-cube fa-3x"></i>
                <div class="info">
                    <h4>Products</h4>
                    <p><b>{{ $totalProducts }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon">
                <i class="icon fa fa-shopping-cart fa-3x"></i>
                <div class="info">
                    <h4>Sales Item</h4>
                    <p><b>{{ $totalSales }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon">
                <i class="icon fa fa-truck fa-3x"></i>
                <div class="info">
                    <h4>Suppliers</h4>
                    <p><b>{{ $totalSuppliers }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon">
                <i class="icon fa fa-file fa-3x"></i>
                <div class="info">
                    <h4>Sales</h4>
                    <p><b>{{ $totalInvoices }}</b></p>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Total Amount of Sales</h3>
                <div style="width:100%; max-width:100%; height:300px;">
                    <table class="table">


                        <tr>
                            <td class="font-extrabold">Total Amount Of Monthly Sales</td>
                            <td>N{{ number_format($monthlySales, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="font-extrabold">Total Amount Of Weekly Sales</td>
                            <td>N{{ number_format($weeklySales, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="font-extrabold">Total Amount Of Daily Sales</td>
                            <td>N{{ number_format($todaySales, 2) }}</td>
                        </tr>

                    </table>
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="tile">
                <h4 class="tile-title">Top 5 Low Quantity Products</h4>
                <div style="width:100%; max-width:100%; height:300px;">
                    <table class="table">
                        @forelse ($lowStockProducts as $lowStockProduct)
                            <tr>
                                <td><strong class="text-uppercase text-danger">{{ $lowStockProduct->name }}</strong>
                                </td>
                                <td class="text-uppercase text-danger">{{ $lowStockProduct->unit }}</td>
                            </tr>
                        @empty
                            <p class="font-bold" style="font-size: 30px">No Record Found</p>
                        @endforelse
                    </table>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title"> Range from 20 - 100 Low Stock Products</h3>
                <div style="width:100%; max-width:100%; height:350px;">
                    <table class="table">

                        @forelse ($lowStockProducts50 as $lowStockProduct)
                            <tr>
                                <td><strong class="text-uppercase text-danger">{{ $lowStockProduct->name }}</strong>
                                </td>
                                <td class="text-uppercase text-danger">{{ $lowStockProduct->unit }}</td>
                            </tr>
                        @empty
                            <p class="font-bold" style="font-size: 30px">No Record Found</p>
                        @endforelse
                    </table>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title"> Range from 100 - 500 Low Quantity Products</h3>
                <div style="width:100%; max-width:100%; height:350px;">
                    <table class="table">


                        @forelse ($lowStockProducts100 as $lowStockProduct)
                            <tr>
                                <td><strong class="text-uppercase text-danger">{{ $lowStockProduct->name }}</strong>
                                </td>
                                <td class="text-uppercase text-danger">{{ $lowStockProduct->unit }}</td>
                            </tr>
                        @empty
                            <p class="font-bold" style="font-size: 30px">No Record Found</p>
                        @endforelse
                    </table>
                </div>

            </div>
        </div>

    </div>

</main>
