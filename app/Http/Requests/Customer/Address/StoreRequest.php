<?php

namespace App\Http\Requests\Customer\Address;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Customer\AddressResource;
use App\Models\Address;
use Illuminate\Http\JsonResponse;

class StoreRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth('customer')->check();
    }
    public function rules():array
    {
        return [
            'customer_id'=>'required|exists:customers,id',
            'recipient_name'=>'required|string|max:255',
            'mobile'=>'required|string|max:255',
            'address'=>'required|string|max:255',
            'type'=>'required|in:'.implode(',',array_values(Address::Types)),
            'lat'=>'required|string|max:255',
            'lng'=>'required|string|max:255',
            'map_address'=>'required|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'customer_id'=>__('models.Address.customer_id'),
            'recipient_name'=>__('models.Address.recipient_name'),
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
        $Address = new Address();
        $Address->customer_id = $this->customer_id;
        $Address->recipient_name = $this->recipient_name;
        $Address->mobile = $this->mobile;
        $Address->address = $this->address;
        $Address->type = $this->type;
        $Address->lat = $this->lat;
        $Address->lng = $this->lng;
        $Address->map_address = $this->map_address;
        $Address->save();
        $Address->refresh();
        return $this->success_response([__('messages.created_successful')],['Address'=>new AddressResource($Address)]);
    }
}
