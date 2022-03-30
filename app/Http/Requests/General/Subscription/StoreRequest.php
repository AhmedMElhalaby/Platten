<?php

namespace App\Http\Requests\General\Subscription;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\SubscriptionResource;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;

class StoreRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'name'=>'required|string|max:255',
            'description'=>'nullable|string|max:255',
            'monthly_price'=>'required|numeric|min:1',
            'yearly_price'=>'required|numeric|min:1',
        ];
    }
    public function attributes(): array
    {
        return [
            'name'=>__('models.Subscription.name'),
            'description'=>__('models.Subscription.description'),
            'monthly_price'=>__('models.Subscription.monthly_price'),
            'yearly_price'=>__('models.Subscription.yearly_price'),
        ];
    }
    public function run(): JsonResponse
    {
        $Subscription = new Subscription();
        $Subscription->name = $this->name;
        $Subscription->description = @$this->description;
        $Subscription->monthly_price = $this->monthly_price;
        $Subscription->yearly_price = $this->yearly_price;
        $Subscription->save();
        $Subscription->refresh();
        return $this->success_response([__('messages.created_successful')],[
            'Subscription'=>new SubscriptionResource($Subscription)
        ]);
    }
}
