<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SongResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'file_path' => $this->file_path,
            'file_name' => $this->file_name,
            'url' => $this->url,
            'title' => $this->title,
            'duration' => $this->duration,
            'artist_name' => $this->artist_name,
            'created_at' => $this->created_at,
        ];
    }
}
