@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content ">
        <!-- ============================================================== -->
        <!-- pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Dashboard </h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#" class="breadcrumb-link">Dashboard</a>
                                </li>
                                <!-- <li class="breadcrumb-item active" aria-current="page">E-Commerce Dashboard Template</li> -->
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader  -->
        <!-- ============================================================== -->
        <div class="ecommerce-widget">
            <div class="row">
                <!-- ============================================================== -->
                <!-- sales  -->
                <!-- ============================================================== -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card border-3 border-top border-top-primary">
                        <div class="card-body">
                            <h5 class="text-muted">Total Clubs</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">{{ $stats['clubs'] }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end sales  -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- new customer  -->
                <!-- ============================================================== -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card border-3 border-top border-top-primary">
                        <div class="card-body">
                            <h5 class="text-muted">Total Events</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">{{ $stats['events'] }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end new customer  -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- visitor  -->
                <!-- ============================================================== -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card border-3 border-top border-top-primary">
                        <div class="card-body">
                            <h5 class="text-muted">Total Lofts</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">{{ $stats['lofts'] }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end visitor  -->
                <!-- ============================================================== -->
            </div>
            <div class="row">
                <!-- ============================================================== -->
                <!-- product category  -->
                <!-- ============================================================== -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header"> Product Category</h5>
                        <div class="card-body">
                            <div class="ct-chart-category ct-golden-section" style="height: 315px;"></div>
                            <div class="text-center m-t-40">
                                <span class="legend-item mr-3">
                                    <span class="fa-xs text-primary mr-1 legend-tile">
                                        <i class="fa fa-fw fa-square-full "></i>
                                    </span>
                                    <span class="legend-text">Man</span>
                                </span>
                                <span class="legend-item mr-3">
                                    <span class="fa-xs text-secondary mr-1 legend-tile">
                                        <i class="fa fa-fw fa-square-full"></i>
                                    </span>
                                    <span class="legend-text">Woman</span>
                                </span>
                                <span class="legend-item mr-3">
                                    <span class="fa-xs text-info mr-1 legend-tile">
                                        <i class="fa fa-fw fa-square-full"></i>
                                    </span>
                                    <span class="legend-text">Accessories</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end product category  -->
                <!-- product sales  -->
                <!-- ============================================================== -->
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- <div class="float-right"><select class="custom-select"><option selected>Today</option><option value="1">Weekly</option><option value="2">Monthly</option><option value="3">Yearly</option></select></div> -->
                            <h5 class="mb-0"> Product Sales</h5>
                        </div>
                        <div class="card-body">
                            <div class="ct-chart-product ct-golden-section"></div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end product sales  -->
                <!-- ============================================================== -->
                <div class="col-xl-3 col-lg-12 col-md-6 col-sm-12 col-12">
                    <!-- ============================================================== -->
                    <!-- top perfomimg  -->
                    <!-- ============================================================== -->
                    <div class="card">
                        <h5 class="card-header">Top Performing Campaigns</h5>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table no-wrap p-table">
                                    <thead class="bg-light">
                                        <tr class="border-0">
                                            <th class="border-0">Campaign</th>
                                            <th class="border-0">Visits</th>
                                            <th class="border-0">Revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Campaign#1</td>
                                            <td>98,789 </td>
                                            <td>$4563</td>
                                        </tr>
                                        <tr>
                                            <td>Campaign#2</td>
                                            <td>2,789 </td>
                                            <td>$325</td>
                                        </tr>
                                        <tr>
                                            <td>Campaign#3</td>
                                            <td>1,459 </td>
                                            <td>$225</td>
                                        </tr>
                                        <tr>
                                            <td>Campaign#4</td>
                                            <td>5,035 </td>
                                            <td>$856</td>
                                        </tr>
                                        <tr>
                                            <td>Campaign#5</td>
                                            <td>10,000 </td>
                                            <td>$1000</td>
                                        </tr>
                                        <tr>
                                            <td>Campaign#5</td>
                                            <td>10,000 </td>
                                            <td>$1000</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <a href="#" class="btn btn-outline-light float-right">Details</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end top perfomimg  -->
                    <!-- ============================================================== -->
                </div>
            </div>
            <div class="row">
                <!-- ============================================================== -->
                <!-- total revenue  -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- category revenue  -->
                <!-- ============================================================== -->
                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Revenue by Category</h5>
                        <div class="card-body">
                            <div id="c3chart_category" style="height: 420px;"></div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end category revenue  -->
                <!-- ============================================================== -->
                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header"> Total Revenue</h5>
                        <div class="card-body">
                            <div id="morris_totalrevenue"></div>
                        </div>
                        <div class="card-footer">
                            <p class="display-7 font-weight-bold">
                                <span class="text-primary d-inline-block">$26,000</span>
                                <span class="text-success float-right">+9.45%</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
