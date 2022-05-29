<?php

namespace App\Http\Requests\Customer\Favourite;

use App\Http\Requests\ApiRequest;
use App\Models\Favourite;
use Illuminate\Http\JsonResponse;

class ToggleRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth('customer')->check();
    }
    public function rules():array
    {
        return [
            'product_id'=>'required|exists:products,id',
        ];
    }
    public function attributes(): array
    {
        return [
            'product_id'=>__('models.Favourite.product_id'),
        ];
    }
    public function run(): JsonResponse
    {
        $Favourite = (new Favourite())->where('customer_id',auth('customer')->user()->id)->where('product_id',$this->product_id)->first();
        if ($Favourite){
            $Favourite->delete();
        }else{
            $Favourite = new Favourite();
            $Favourite->customer_id = auth('customer')->user()->id;
            $Favourite->product_id = $this->product_id;
            $Favourite->save();
        }
        return $this->success_response([__('messages.saved_successfully')]);
    }
}
