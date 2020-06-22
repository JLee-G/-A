<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnimalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        // dd($this->age);
        // dd($this->type);
        return [
            'id' => $this->id,
            'type' => new TypeResource($this),
            'name' => $this->name,
            'birthday' => $this->birthday,
            'age' => $this->age,
            'aaa' => $this->aaa,
            'area' => $this->area,
            'fix' => $this->fix,
            'description' => $this->description,
            'personality' => $this->personality,
            'created_at' => $this->created_at != null ? $this->created_at->toDateTimeString() : null,
            'updated_at' => $this->updated_at != null ? $this->updated_at->toDateTimeString() : null,
        ];
    }
}
