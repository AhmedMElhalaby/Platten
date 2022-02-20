<?php

namespace App\Http\Requests\Vendor;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'per_page'=>'nullable|numeric',
            'q'=>'nullable|string|max:255'
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
        $Vendors = new Vendor();
        if ($this->filled('q')) {
            $Vendors = $Vendors->where('name','Like','%'.$this->q.'%');
        }
        $Vendors = $Vendors->paginate($this->per_page??10);
        return $this->success_response([],VendorResource::collection($Vendors->items()),'Vendors',$Vendors);
    }
}
