<?php

namespace App\Http\Requests\General\Subscription;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\SubscriptionResource;
use App\Models\Subscription;
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
            'subscription_id'=>'required|exists:subscriptions,id',
            'name'=>'nullable|string|max:255',
            'description'=>'nullable|string|max:255',
            'monthly_price'=>'required|numeric|min:1',
            'yearly_price'=>'nullable|numeric|min:1',
        ];
    }
    public function attributes(): array
    {
        return [
            'subscription_id'=>__('models.Subscription.subscription_id'),
            'name'=>__('models.Subscription.name'),
            'description'=>__('models.Subscription.description'),
            'monthly_price'=>__('models.Subscription.monthly_price'),
            'yearly_price'=>__('models.Subscription.yearly_price'),
        ];
    }
    public function run(): JsonResponse
    {
        $Subscription = (new Subscription())->find($this->subscription_id);
        if ($this->filled('name')) {
            $Subscription->name = $this->name;
        }
        if ($this->filled('description')) {
            $Subscription->description = $this->description;
        }
        if ($this->filled('monthly_price')) {
            $Subscription->monthly_price = $this->monthly_price;
        }
        if ($this->filled('yearly_price')) {
            $Subscription->yearly_price = $this->yearly_price;
        }
        $Subscription->save();
        $Subscription->refresh();
        return $this->success_response([__('messages.updated_successful')],[
            'Subscription'=>new SubscriptionResource($Subscription)
        ]);
    }
}
