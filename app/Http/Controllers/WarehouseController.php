<?php

namespace App\Http\Controllers;

use App\Http\Requests\Warehouse\LookUpInventoryRequest;
use App\Services\WarehouseService;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    protected WarehouseService $warehouseService;

    public function __construct(WarehouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }

    public function lookUpInventory()
    {
        return view('warehouse.look-up-inventory');
    }
    
    public function searchWarehouse(Request $request)
    {
        return $this->warehouseService->searchWarehouse($request);
    }
    
    public function searchSupplies(Request $request)
    {
        return $this->warehouseService->searchSupplies($request);
    }
    
    public function getDataLookUpInventory(LookUpInventoryRequest $request)
    {
        $data = $this->warehouseService->getDataLookUpInventory($request);
        return view('warehouse.list-look-up-inventory', compact('data'));
    }
}