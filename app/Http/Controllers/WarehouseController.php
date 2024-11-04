<?php

namespace App\Http\Controllers;

use App\Http\Requests\Warehouse\LookUpInventoryQRRequest;
use App\Http\Requests\Warehouse\LookUpInventoryWarehouseRequest;
use App\Http\Requests\Warehouse\QuotaWarningReportRequest;
use App\Services\WarehouseService;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    protected WarehouseService $warehouseService;

    public function __construct(WarehouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }

    public function lookUpInventoryByQR()
    {
        return view('warehouse.look-up-inventory-by-QR');
    }

    public function getDataLookUpInventoryByQR(LookUpInventoryQRRequest $request)
    {
        $data = $this->warehouseService->getDataLookUpInventoryByQR($request);
        return view('warehouse.list-look-up-inventory-by-QR', compact('data'));
    }

    public function lookUpInventoryByWarehouse()
    {
        return view('warehouse.look-up-inventory-by-warehouse');
    }

    public function getDataLookUpInventoryByWarehouse(LookUpInventoryWarehouseRequest $request)
    {
        $data = $this->warehouseService->getDataLookUpInventoryByWarehouse($request);
        return view('warehouse.list-look-up-inventory-by-warehouse', compact('data'));
    }

    public function quotaWarningReport()
    {
        return view('warehouse.quota-warning-report');
    }

    public function getDataQuotaWarningReport(QuotaWarningReportRequest $request)
    {
        $data = $this->warehouseService->getDataQuotaWarningReport($request);
        return view('warehouse.list-quota-warning-report', compact('data'));
    }
    
    public function recommendWarehouseRelease()
    {
        return view('warehouse.recommend-warehouse-release.create');
    }
    
    public function managementRequestsWarehouseRelease()
    {
        return view('warehouse.recommend-warehouse-release.list');
    }
    
    public function searchWarehouse(Request $request)
    {
        return $this->warehouseService->searchWarehouse($request);
    }

    public function searchSupplies(Request $request)
    {
        return $this->warehouseService->searchSupplies($request);
    }
    
    public function searchCustomer(Request $request)
    {
        return $this->warehouseService->searchCustomer($request);
    }
}