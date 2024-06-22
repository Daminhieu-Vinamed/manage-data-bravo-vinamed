@extends('layout.master')
@section('title', 'Thống kê')
@section('css')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/dataTables.responsive.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/subStyle.css') }}" rel="stylesheet">
@endsection
@section('title-manage')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">THỐNG KÊ ĐỀ NGHỊ THANH TOÁN</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-8 col-lg-6 d-flex flex-wrap px-0">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-purple shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-purple text-uppercase mb-1">Đề nghị thanh toán chờ duyệt của A06</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="A06" data="{{ $statistical['count']['A06'] }}">{{ $statistical['count']['A06'] }} phiếu</div>
                            </div>
                            <div class="col-auto">
                                <h3 class="mb-0 fa-2x text-gray-400">A06</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-pink shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-pink text-uppercase mb-1">Đề nghị thanh toán chờ duyệt của A11</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="A11" data="{{ $statistical['count']['A11'] }}">{{ $statistical['count']['A11'] }} phiếu</div>
                            </div>
                            <div class="col-auto">
                                <h3 class="mb-0 fa-2x text-gray-400">A11</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-red shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-red text-uppercase mb-1">Đề nghị thanh toán chờ duyệt của A12</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="A12" data="{{ $statistical['count']['A12'] }}">{{ $statistical['count']['A12'] }} phiếu</div>
                            </div>
                            <div class="col-auto">
                                <h3 class="mb-0 fa-2x text-gray-400">A12</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-orange shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-orange text-uppercase mb-1">Đề nghị thanh toán chờ duyệt của A14</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="A14" data="{{ $statistical['count']['A14'] }}">{{ $statistical['count']['A14'] }} phiếu</div>
                            </div>
                            <div class="col-auto">
                                <h3 class="mb-0 fa-2x text-gray-400">A14</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-yellow shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-yellow text-uppercase mb-1">Đề nghị thanh toán chờ duyệt của A18</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="A18" data="{{ $statistical['count']['A18'] }}">{{ $statistical['count']['A18'] }} phiếu</div>
                            </div>
                            <div class="col-auto">
                                <h3 class="mb-0 fa-2x text-gray-400">A18</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-green shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-green text-uppercase mb-1">Đề nghị thanh toán chờ duyệt của A19</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="A19" data="{{ $statistical['count']['A19'] }}">{{ $statistical['count']['A19'] }} phiếu</div>
                            </div>
                            <div class="col-auto">
                                <h3 class="mb-0 fa-2x text-gray-400">A19</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-blue shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-blue text-uppercase mb-1">Đề nghị thanh toán chờ duyệt của A21</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="A21" data="{{ $statistical['count']['A21'] }}">{{ $statistical['count']['A21'] }} phiếu</div>
                            </div>
                            <div class="col-auto">
                                <h3 class="mb-0 fa-2x text-gray-400">A21</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-cyan shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-cyan text-uppercase mb-1">Đề nghị thanh toán chờ duyệt của A22</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="A22" data="{{ $statistical['count']['A22'] }}">{{ $statistical['count']['A22'] }} phiếu</div>
                            </div>
                            <div class="col-auto">
                                <h3 class="mb-0 fa-2x text-gray-400">A22</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-gray shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">Đề nghị thanh toán chờ duyệt của A25</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="A25" data="{{ $statistical['count']['A25'] }}">{{ $statistical['count']['A25'] }} phiếu</div>
                            </div>
                            <div class="col-auto">
                                <h3 class="mb-0 fa-2x text-gray-400">A25</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
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
                        <canvas id="myPieChart" width="301" height="306" style="display: block; height: 245px; width: 241px;" class="chartjs-render-monitor"></canvas>
                    </div>
                    <div class="mt-4 text-center small">Tổng: {{ $statistical['count-total'] }} phiếu</div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-xl-6 col-lg-6">
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
    </div> --}}
    @if (!empty($statistical['part']))
        <div class="row">
            @foreach ($statistical['part'] as $key => $arr)
                <div class="col-xl-4 col-lg-6">
                    <div class="card shadow mb-4">
                        <a href="#collapseCard{{$key}}Top" class="d-block card-header py-3" data-toggle="collapse"
                            role="button" aria-expanded="true" aria-controls="collapseCard{{$key}}Top">
                            <h6 class="m-0 font-weight-bold text-primary">Đề nghị thanh toán các bộ phận {{$key}}</h6>
                        </a>
                        <div class="collapse show" id="collapseCard{{$key}}Top">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="d-sm-flex align-items-center justify-content-between" id="filterPart{{$key}}">
                                        <div class="lengthInTable"></div>
                                        <div class="searchInTable"></div>
                                    </div>
                                    <table class="table table-bordered" id="tablePart{{$key}}" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Bộ phận</th>
                                                <th>Số lượng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($arr as $part)
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
            @endforeach
        </div>
    @endif
    <div class="row">
        @foreach ($statistical['staff'] as $key => $arr)
            <div class="col-xl-4 col-lg-6">
                <div class="card shadow mb-4">
                    <a href="#collapseCard{{$key}}Bottom" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="collapseCard{{$key}}Bottom">
                        <h6 class="m-0 font-weight-bold text-primary">Đề nghị thanh toán các nhân viên {{$key}}</h6>
                    </a>
                    <div class="collapse show" id="collapseCard{{$key}}Bottom">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="d-sm-flex align-items-center justify-content-between" id="filterStaff{{$key}}">
                                    <div class="lengthInTable"></div>
                                    <div class="searchInTable"></div>
                                </div>
                                <table class="table table-bordered" id="tableStaff{{$key}}" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nhân viên</th>
                                            <th>Số lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($arr as $part)
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
        @endforeach
    </div>
@endsection
@push('js') 
     <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/datatables/dataTables.responsive.min.js') }}"></script>
     <script src="{{ asset('assets/js/payment-order/dashboard/chart-pie.js') }}"></script>
     <script src="{{ asset('assets/js/payment-order/dashboard/chart-area.js') }}"></script>
     <script src="{{ asset('assets/js/payment-order/statistical.js') }}"></script>
@endpush