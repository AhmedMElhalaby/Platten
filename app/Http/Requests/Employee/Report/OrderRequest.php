<?php

namespace App\Http\Requests\Employee\Report;

use App\Export\OrderExport;
use App\Http\Requests\ApiRequest;
use App\Http\Resources\Employee\Report\OrderReportResource;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;

class OrderRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'per_page'=>'nullable|numeric',
            'q'=>'nullable|string|max:255',
            'from_date'=>'nullable|date',
            'to_date'=>'nullable|date',
        ];
    }
    public function attributes(): array
    {
        return [
            'q'=>__('models.q'),
            'per_page'=>__('models.per_page'),
        ];
    }
    public function run(): JsonResponse
    {
        $Orders = (new Order())->with(['vendor','customer']);
        if ($this->filled('vendor_id')) {
            $Orders = $Orders->where('vendor_id', $this->vendor_id);
        }
        if ($this->filled('customer_id')) {
            $Orders = $Orders->where('customer_id', $this->customer_id);
        }
        if ($this->filled('from_date') && $this->filled('to_date')){
            $Orders = $Orders->whereBetween('created_at',[Carbon::parse($this->from_date),Carbon::parse($this->to_date)]);
        }
        if ($this->filled('from_date') && !$this->filled('to_date')){
            $Orders = $Orders->where('created_at','>=',Carbon::parse($this->from_date));
        }
        if (!$this->filled('from_date') && $this->filled('to_date')){
            $Orders = $Orders->where('created_at','<=',Carbon::parse($this->from_date));
        }
        $Orders = $Orders->get();
        $OrdersResource = OrderReportResource::collection($Orders);
        $file_path = 'reports/Orders-Report-'.now()->format('Y-m-d-H-i-A').'.xlsx';
        Excel::store(new OrderExport($OrdersResource),'public/'.$file_path);
        return $this->success_response([],
        [
            'count'=>count($Orders),
            'Orders'=>$OrdersResource,
            'excel'=> asset('storage/'.$file_path)
        ]);
    }
}
