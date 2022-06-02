<?php

namespace App\Http\Requests\Customer\Address;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Customer\AddressResource;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class UpdateRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('customer')->check();
    }
    public function rules():array
    {
        return [
            'address_id'=>'required|exists:addresses,id',
            'recipient_first_name'=>'nullable|string|max:255',
            'recipient_last_name'=>'nullable|string|max:255',
            'mobile'=>'nullable|string|max:255',
            'address'=>'nullable|string|max:255',
            'type'=>'nullable|in:'.implode(',',array_values(Address::Types)),
            'lat'=>'nullable|string|max:255',
            'lng'=>'nullable|string|max:255',
            'map_address'=>'nullable|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'address_id'=>__('models.Address.address_id'),
            'recipient_first_name'=>__('models.Address.recipient_first_name'),
            'recipient_last_name'=>__('models.Address.recipient_last_name'),
            'mobile'=>__('models.Address.mobile'),
            'address'=>__('models.Address.address'),
            'type'=>__('models.Address.type'),
            'lat'=>__('models.Address.lat'),
            'lng'=>__('models.Address.lng'),
            'map_address'=>__('models.Address.map_address'),
        ];
    }
    public function run(): JsonResponse
    {
        $Address = (new Address())->find($this->address_id);
        if ($this->filled('recipient_first_name')) {
            $Address->recipient_first_name = $this->recipient_first_name;
        }
        if ($this->filled('recipient_last_name')) {
            $Address->recipient_last_name = $this->recipient_last_name;
        }
        if ($this->filled('mobile')) {
            $Address->mobile = $this->mobile;
        }
        if ($this->filled('address')) {
            $Address->address = $this->address;
        }
        if ($this->filled('type')) {
            $Address->type = $this->type;
        }
        if ($this->filled('lat')) {
            $Address->lat = $this->lat;
        }
        if ($this->filled('lng')) {
            $Address->lng = $this->lng;
        }
        if ($this->filled('map_address')) {
            $Address->map_address = $this->map_address;
        }
        $Address->save();
        $Address->refresh();
        return $this->success_response([__('messages.updated_successful')],['Address'=>new AddressResource($Address)]);
    }
}
