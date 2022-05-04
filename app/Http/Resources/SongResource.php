<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="SongResource",
 *     description="Song resource",
 *     @OA\Xml(
 *         name="SongResource"
 *     )
 * )
 */
class SongResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     *
     * @OA\Property(format="string", title="url", default="Demo", description="Url", property="url"),
     * @OA\Property(format="string", title="title", default="demo", description="title", property="title"),
     * @OA\Property(format="string", title="artist_name", default="test", description="Artist name", property="artist_name")
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
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
