<?php

namespace App\Http\Requests\Vendor;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;

class UpdateRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'vendor_id'=>'required|exists:vendors,id',
            'country_id'=>'nullable|exists:vendors,id',
            'city_id'=>'nullable|exists:vendors,id',
            'email'=>'nullable|email|unique:vendors,email,'.request('vendor_id').'|max:255',
            'name'=>'nullable|string|max:255',
            'mobile'=>'nullable|string|max:255',
            'nickname'=>'nullable|string|max:255',
            'company_name'=>'nullable|string|max:255',
            'postcode'=>'nullable|string|max:255',
            'address'=>'nullable|string|max:255',
            'address_alt'=>'nullable|string|max:255',
            'maroof_tax_number'=>'nullable|string|max:255',
            'maroof_company_number'=>'nullable|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'vendor_id'=>__('models.Vendor.vendor_id'),
            'country_id'=>__('models.Vendor.country_id'),
            'city_id'=>__('models.Vendor.city_id'),
            'name'=>__('models.Vendor.name'),
            'mobile'=>__('models.Vendor.mobile'),
            'nickname'=>__('models.Vendor.nickname'),
            'company_name'=>__('models.Vendor.company_name'),
            'postcode'=>__('models.Vendor.postcode'),
            'address'=>__('models.Vendor.address'),
            'address_alt'=>__('models.Vendor.address_alt'),
            'maroof_tax_number'=>__('models.Vendor.maroof_tax_number'),
            'maroof_company_number'=>__('models.Vendor.maroof_company_number'),
        ];
    }
    public function run(): JsonResponse
    {
        $Vendor = (new Vendor())->find($this->vendor_id);
        if ($this->filled('name')) {
            $Vendor->name = $this->name;
        }
        if ($this->filled('mobile')) {
            $Vendor->mobile = $this->mobile;
        }
        if ($this->filled('email')) {
            $Vendor->email = $this->email;
        }
        if ($this->filled('country_id')) {
            $Vendor->country_id = $this->country_id;
        }
        if ($this->filled('city_id')) {
            $Vendor->city_id = $this->city_id;
        }
        if ($this->filled('nickname')) {
            $Vendor->nickname = $this->nickname;
        }
        if ($this->filled('company_name')) {
            $Vendor->company_name = $this->company_name;
        }
        if ($this->filled('postcode')) {
            $Vendor->postcode = $this->postcode;
        }
        if ($this->filled('address')) {
            $Vendor->address = $this->address;
        }
        if ($this->filled('address_alt')) {
            $Vendor->address_alt = $this->address_alt;
        }
        if ($this->filled('maroof_tax_number')) {
            $Vendor->maroof_tax_number = $this->maroof_tax_number;
        }
        if ($this->filled('maroof_company_number')) {
            $Vendor->maroof_company_number = $this->maroof_company_number;
        }
        $Vendor->save();
        $Vendor->refresh();
        return $this->success_response([__('messages.updated_successful')],['Vendor'=>new VendorResource($Vendor)]);
    }
}
