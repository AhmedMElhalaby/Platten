<?php

namespace App\Http\Requests\Employee\Report;

use App\Export\CustomerExport;
use App\Http\Requests\ApiRequest;
use App\Http\Resources\Employee\Report\CustomerReportResource;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;

class CustomerRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'q'=>'nullable|string|max:255',
            'from_date'=>'nullable|date',
            'to_date'=>'nullable|date',
        ];
    }
    public function attributes(): array
    {
        return [
            'q'=>__('models.q'),
        ];
    }
    public function run(): JsonResponse
    {
        $Customers = new Customer();
        if ($this->filled('q')) {
            $Customers = $Customers->where('name','Like','%'.$this->q.'%');
        }
        if ($this->filled('from_date') && $this->filled('to_date')){
            $Customers = $Customers->whereBetween('created_at',[Carbon::parse($this->from_date),Carbon::parse($this->to_date)]);
        }
        if ($this->filled('from_date') && !$this->filled('to_date')){
            $Customers = $Customers->where('created_at','>=',Carbon::parse($this->from_date));
        }
        if (!$this->filled('from_date') && $this->filled('to_date')){
            $Customers = $Customers->where('created_at','<=',Carbon::parse($this->from_date));
        }
        $Customers = $Customers->get();
        $CustomersResource = CustomerReportResource::collection($Customers);
        $file_path = 'reports/Customers-Report-'.now()->format('Y-m-d-H-i-A').'.xlsx';
        Excel::store(new CustomerExport($CustomersResource),'public/'.$file_path);
        return $this->success_response([],
        [
            'count'=>count($Customers),
            'Customers'=>$CustomersResource,
            'excel'=>asset('storage/'.$file_path)
        ]);
    }
}
