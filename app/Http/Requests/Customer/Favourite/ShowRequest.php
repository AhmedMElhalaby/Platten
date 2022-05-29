<?php

namespace App\Http\Requests\Customer\Favourite;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Customer\FavouriteResource;
use App\Models\Favourite;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'favourite_id'=>'required|exists:favourites,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'favourite_id'=>__('models.Favourite.favourite_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],['Favourite'=>new FavouriteResource(Favourite::find($this->favourite_id))]);
    }
}
