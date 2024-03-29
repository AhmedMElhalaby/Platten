<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'question'=>$this->question,
            'answer'=>$this->answer,
        ];
    }
}
