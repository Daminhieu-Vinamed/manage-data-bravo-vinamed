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
    
    public function searchCustomer($request)
    {
        $search = $request->input('q');
        $page = $request->input('page', 1);
        $perPage = 20;
        $dataWarehouse = $this->warehouseRepository->searchCustomerQuery($search, $page, $perPage);
        return $dataWarehouse;
    }
    
    public function searchEmployee($request)
    {
        $search = $request->input('q');
        $page = $request->input('page', 1);
        $perPage = 20;
        $dataWarehouse = $this->warehouseRepository->searchEmployeeQuery($search, $page, $perPage);
        return $dataWarehouse;
    }
    
    public function getDataLookUpInventoryByQR($request)
    {
        return $this->warehouseRepository->getDataLookUpInventoryByQR($request);
    }
    
    public function getDataLookUpInventoryByWarehouse($request)
    {
        return $this->warehouseRepository->getDataLookUpInventoryByWarehouse($request);
    }
    
    public function getDataQuotaWarningReport($request)
    {
        return $this->warehouseRepository->getDataQuotaWarningReport($request);
    }
}