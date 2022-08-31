<?php

namespace App\Http\Requests\Employee\Report;

use App\Export\VendorExport;
use App\Http\Requests\ApiRequest;
use App\Http\Resources\Employee\Report\VendorReportResource;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;

class VendorRequest extends ApiRequest
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
        $Vendors = (new Vendor())->with(['country','city']);
        if ($this->filled('q')) {
            $Vendors = $Vendors->where('name','Like','%'.$this->q.'%');
        }
        if ($this->filled('from_date') && $this->filled('to_date')){
            $Vendors = $Vendors->whereBetween('created_at',[Carbon::parse($this->from_date),Carbon::parse($this->to_date)]);
        }
        if ($this->filled('from_date') && !$this->filled('to_date')){
            $Vendors = $Vendors->where('created_at','>=',Carbon::parse($this->from_date));
        }
        if (!$this->filled('from_date') && $this->filled('to_date')){
            $Vendors = $Vendors->where('created_at','<=',Carbon::parse($this->from_date));
        }
        $Vendors = $Vendors->get();
        $VendorsResource = VendorReportResource::collection($Vendors);
        $file_path = 'reports/Vendors-Report-'.now()->format('Y-m-d-H-i-A').'.xlsx';
        Excel::store(new VendorExport($VendorsResource),'public/'.$file_path);
        return $this->success_response([],
        [
            'count'=>count($Vendors),
            'Vendors'=>$VendorsResource,
            'excel'=> asset('storage/'.$file_path)
        ]);
    }
}
