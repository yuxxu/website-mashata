@extends('layouts.main')

@section('content')
 
 <!-- Begin Page Content -->
        <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                       <!-- Total Pasien -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pasien</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPasien }}</div>
                                        </div>
                                        <div class="col-auto">
                                            {{-- <i class="fas fa-calendar fa-2x text-gray-300"></i> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sudah Check-Up -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Sudah Check-Up</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sudahCheckup }}</div>
                                        </div>
                                        <div class="col-auto">
                                            {{-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sedang Check-Up -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Sedang Check-Up</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $sedangCheckup }}</div>
                                                </div>
                                                <div class="col">
                                                    {{-- <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: {{ $totalPasien > 0 ? ($sedangCheckup / $totalPasien) * 100 : 0 }}%" 
                                                            aria-valuenow="{{ $sedangCheckup }}" aria-valuemin="0"
                                                            aria-valuemax="{{ $totalPasien }}"></div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            {{-- <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Belum Check-Up -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Belum Check-Up</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $belumCheckup }}</div>
                                        </div>
                                        <div class="col-auto">
                                            {{-- <i class="fas fa-comments fa-2x text-gray-300"></i> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Grafik Status Pasien Hari Ini</h6>

                                    
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Antrian Per Poli</h6>
                                    <div class="dropdown no-arrow">
                                        
                                        
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

        </div>
 <!-- /.container-fluid -->

 @endsection


{{-- <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div> --}}