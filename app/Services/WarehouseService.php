<?php

namespace App\Services;

use App\Repositories\WarehouseRepository;

class WarehouseService extends WarehouseRepository
{
    protected WarehouseRepository $warehouseRepository;

    public function __construct(WarehouseRepository $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    public function searchWarehouse($request)
    {
        $search = $request->input('q');
        $page = $request->input('page', 1);
        $perPage = 20;
        $dataWarehouse = $this->warehouseRepository->searchWarehouseQuery($search, $page, $perPage);
        return $dataWarehouse;
    }

    public function searchSupplies($request)
    {
        $search = $request->input('q');
        $page = $request->input('page', 1);
        $perPage = 20;
        $dataWarehouse = $this->warehouseRepository->searchSuppliesQuery($search, $page, $perPage);
        return $dataWarehouse;
    }
    
    public function getDataLookUpInventory($request)
    {
        return $this->warehouseRepository->getDataLookUpInventory($request);
    }
}