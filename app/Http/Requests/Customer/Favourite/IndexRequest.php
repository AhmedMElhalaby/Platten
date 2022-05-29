<?php

namespace App\Http\Requests\Customer\Favourite;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Customer\FavouriteResource;
use App\Models\Favourite;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'favourite_id'=>'nullable|exists:favourites,id',
            'per_page'=>'nullable|numeric',
            'q'=>'nullable|string|max:255'
        ];
    }
    public function attributes(): array
    {
        return [
            'favourite_id'=>__('models.Favourite.favourite_id'),
            'q'=>__('models.q'),
            'per_page'=>__('models.per_page'),
        ];
    }
    public function run(): JsonResponse
    {
        $Favourites = new Favourite();
        if ($this->filled('favourite_id')) {
            $Favourites = $Favourites->where('favourite_id',$this->favourite_id);
        }
        if ($this->filled('q')) {
            $Favourites = $Favourites->where('name','Like','%'.$this->q.'%');
        }
        $Favourites = $Favourites->paginate($this->per_page??10);
        return $this->success_response([],['Favourites'=>FavouriteResource::collection($Favourites->items())],['Favourites'=>$Favourites]);
    }
}
