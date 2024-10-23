<?php

namespace App\Http\Controllers;

use App\Http\Requests\Warehouse\LookUpInventoryByQRRequest;
use App\Http\Requests\Warehouse\LookUpInventoryWarehouseRequest;
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

    public function getDataLookUpInventoryByQR(LookUpInventoryByQRRequest $request)
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

    public function searchWarehouse(Request $request)
    {
        return $this->warehouseService->searchWarehouse($request);
    }

    public function searchSupplies(Request $request)
    {
        return $this->warehouseService->searchSupplies($request);
    }
}