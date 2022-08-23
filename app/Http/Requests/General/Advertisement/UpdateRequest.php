<?php

namespace App\Http\Requests\General\Advertisement;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\AdvertisementResource;
use App\Models\Advertisement;
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
            'advertisement_id'=>'required|exists:advertisements,id',
            'name'=>'nullable|string|max:255',
            'image'=>'nullable|mimes:png,jpg,jpeg',
            'url'=>'nullable|string',
            'type'=>'nullable|in:1,2',
            'order'=>'nullable|in:1,2,3',
        ];
    }
    public function attributes(): array
    {
        return [
            'advertisement_id'=>__('models.Advertisement.advertisement_id'),
            'name'=>__('models.Advertisement.name'),
            'image'=>__('models.Advertisement.image'),
            'url'=>__('models.Advertisement.url'),
            'type'=>__('models.Advertisement.type'),
            'order'=>__('models.Advertisement.order'),
        ];
    }
    public function run(): JsonResponse
    {
        $Advertisement = (new Advertisement())->find($this->advertisement_id);
        if ($this->filled('name')) {
            $Advertisement->name = $this->name;
        }
        if ($this->hasFile('image')) {
            $path = $this->file('image')->store('public/advertisements');
            $Advertisement->image = $path;
        }
        if ($this->filled('url')) {
            $Advertisement->url = $this->url;
        }
        if ($this->filled('type')) {
            $Advertisement->type = $this->type;
        }
        if ($this->filled('order')) {
            $Advertisement->order = $this->order;
        }
        $Advertisement->save();
        $Advertisement->refresh();
        return $this->success_response([__('messages.updated_successful')],[
            'Advertisement'=>new AdvertisementResource($Advertisement)
        ]);
    }
}
