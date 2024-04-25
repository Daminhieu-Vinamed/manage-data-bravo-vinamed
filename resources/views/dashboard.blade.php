@extends('layout.master')
@section('title', 'Thống kê')
@section('css')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/dataTables.responsive.min.css') }}" rel="stylesheet">
@endsection
@section('title-manage')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">THỐNG KÊ</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tổng đề nghị thanh toán chờ duyệt</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistical['countAll'] }} phiếu</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-globe fa-2x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Đề nghị thanh toán chờ duyệt của A11</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistical['countA11'] }} phiếu</div>
                        </div>
                        <div class="col-auto">
                            <h3 class="mb-0 fa-2x text-gray-400">A11</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Đề nghị thanh toán chờ duyệt của A12</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistical['countA12'] }} phiếu</div>
                        </div>
                        <div class="col-auto">
                            <h3 class="mb-0 fa-2x text-gray-400">A12</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Đề nghị thanh toán chờ duyệt của A14</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistical['countA14'] }} phiếu</div>
                        </div>
                        <div class="col-auto">
                            <h3 class="mb-0 fa-2x text-gray-400">A14</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="myAreaChart" width="531" height="400" style="display: block; height: 320px; width: 425px;" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Đề nghị thanh toán biểu đồ tròn </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas dataA11="{{ $statistical['countA11'] }}" dataA12="{{ $statistical['countA12'] }}" dataA14="{{ $statistical['countA14'] }}" id="myPieChart" width="301" height="306" style="display: block; height: 245px; width: 241px;" class="chartjs-render-monitor"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> A11
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> A12
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> A14
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Đề nghị thanh toán các bộ phận của A11</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="d-sm-flex align-items-center justify-content-between" id="filterPartA11">
                            <div class="lengthInTable"></div>
                            <div class="searchInTable"></div>
                        </div>
                        <table class="table table-bordered" id="tablePartA11" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Bộ phận</th>
                                    <th>Số lượng</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Bộ phận</th>
                                    <th>Số lượng</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($statistical['partA11'] as $part)
                                    <tr>
                                        <td>{{$part->DeptName}}</td>
                                        <td>{{$part->QuantityPaymentOrder}} phiếu</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Đề nghị thanh toán các bộ phận của A12</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="d-sm-flex align-items-center justify-content-between" id="filterPartA12">
                            <div class="lengthInTable"></div>
                            <div class="searchInTable"></div>
                        </div>
                        <table class="table table-bordered" id="tablePartA12" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Bộ phận</th>
                                    <th>Số lượng</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Bộ phận</th>
                                    <th>Số lượng</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($statistical['partA12'] as $part)
                                    <tr>
                                        <td>{{$part->DeptName}}</td>
                                        <td>{{$part->QuantityPaymentOrder}} phiếu</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Đề nghị thanh toán các bộ phận của A14</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="d-sm-flex align-items-center justify-content-between" id="filterPartA14">
                            <div class="lengthInTable"></div>
                            <div class="searchInTable"></div>
                        </div>
                        <table class="table table-bordered" id="tablePartA14" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Bộ phận</th>
                                    <th>Số lượng</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Bộ phận</th>
                                    <th>Số lượng</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($statistical['partA14'] as $part)
                                    <tr>
                                        <td>{{$part->DeptName}}</td>
                                        <td>{{$part->QuantityPaymentOrder}} phiếu</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Đề nghị thanh toán các nhân viên của A11</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="d-sm-flex align-items-center justify-content-between" id="filterStaffA11">
                            <div class="lengthInTable"></div>
                            <div class="searchInTable"></div>
                        </div>
                        <table class="table table-bordered" id="tableStaffA11" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nhân viên</th>
                                    <th>Số lượng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statistical['staffA11'] as $part)
                                    <tr>
                                        <td>{{$part->EmployeeName}}</td>
                                        <td>{{$part->QuantityPaymentOrder}} phiếu</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Đề nghị thanh toán các nhân viên của A12</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="d-sm-flex align-items-center justify-content-between" id="filterStaffA12">
                            <div class="lengthInTable"></div>
                            <div class="searchInTable"></div>
                        </div>
                        <table class="table table-bordered" id="tableStaffA12" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nhân viên</th>
                                    <th>Số lượng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statistical['staffA12'] as $part)
                                    <tr>
                                        <td>{{$part->EmployeeName}}</td>
                                        <td>{{$part->QuantityPaymentOrder}} phiếu</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Đề nghị thanh toán các nhân viên của A14</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="d-sm-flex align-items-center justify-content-between" id="filterStaffA14">
                            <div class="lengthInTable"></div>
                            <div class="searchInTable"></div>
                        </div>
                        <table class="table table-bordered" id="tableStaffA14" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nhân viên</th>
                                    <th>Số lượng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statistical['staffA14'] as $part)
                                    <tr>
                                        <td>{{$part->EmployeeName}}</td>
                                        <td>{{$part->QuantityPaymentOrder}} phiếu</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js') 
     <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/datatables/dataTables.responsive.min.js') }}"></script>
     <script src="{{ asset('assets/js/dashboard/chart-pie.js') }}"></script>
     <script src="{{ asset('assets/js/dashboard/chart-area.js') }}"></script>
     <script src="{{ asset('assets/js/dashboard/logic.js') }}"></script>
@endpush