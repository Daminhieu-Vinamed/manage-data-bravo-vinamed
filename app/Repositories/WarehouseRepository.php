<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class WarehouseRepository
{
    public function searchWarehouseQuery($search, $page, $perPage)
    {
        $B20Warehouse = DB::connection('A25')->table('B20Warehouse')
        ->where('IsActive', config('constants.number.one'))
        ->where('IsGroup', config('constants.number.zero'));
        if ($search) {
            $B20Warehouse->where('Code', 'LIKE', '%' . $search . '%')->orWhere('Name', 'LIKE', '%' . $search . '%');
        }
        $dataWarehouse = $B20Warehouse->paginate($perPage, ['Code', 'Name'], 'page', $page);
        $results = $dataWarehouse->map(function($warehouse) {
            return [
                'id' => $warehouse->Code,
                'text' => $warehouse->Code . ' - ' . $warehouse->Name 
            ];
        });
        return response()->json([
            'data' => $results,
            'total' => $dataWarehouse->total()
        ]);
    }
    
    public function searchSuppliesQuery($search, $page, $perPage)
    {
        $vB20Item = DB::connection('A25')->table('vB20Item')
        ->where('IsActive', config('constants.number.one'));
        if ($search) {
            $vB20Item->where('Code', 'LIKE', '%' . $search . '%')->orWhere('Name', 'LIKE', '%' . $search . '%')->orWhere('ItemCode_NCC', 'LIKE', '%' . $search . '%');
        }
        $dataItem = $vB20Item->paginate($perPage, ['Code', 'Name', 'ItemCode_NCC'], 'page', $page);
        $results = $dataItem->map(function($item) {
            return [
                'id' => $item->Code,
                'text' => $item->Code .' - ' . $item->ItemCode_NCC . ' - ' . $item->Name
            ];
        });
        return response()->json([
            'data' => $results,
            'total' => $dataItem->total()
        ]);
    }
   
    public function getDataLookUpInventoryByQR($request)
    {
        $data = DB::connection('A25')->select('EXEC usp_Vcd_TongHopNhapXuatTon_Barcode ?, ?, ?, ?, ?, ?', [$request->startDate, $request->endDate, config('constants.value.null'), $request->warehouse, config('constants.number.zero'), $request->supplies]);
        return $data;
    }
    
    public function getDataLookUpInventoryByWarehouse($request)
    {
        $data = DB::connection('A25')->select('EXEC usp_Vcd_TongHopNhapXuatTon_Barcode_Tuandh ?, ?, ?, ?', [config('constants.value.null'), $request->endDate, $request->warehouse, $request->supplies]);
        return $data;
    }
}