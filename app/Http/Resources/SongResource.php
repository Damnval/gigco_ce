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
     * @OA\Property(
     *      title="url",
     *      description="Url of the new song",
     *      example="www.edsheeran.com"
     * )
     *
     * @var string
     */
    public $url;

    /**
     * @OA\Property(
     *      title="title",
     *      description="Title of the new song",
     *      example="Photograph"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="artist_name",
     *      description="artist_name of the new song",
     *      example="Ed Sheeran"
     * )
     *
     * @var string
     */
    public $artist_name;

    /**
     *
     * Transform the resource into an array.
     *
     * @OAS\Property(property="id",type="integer",example=1)
     * @OAS\Property(property="url",type="string",example="www.edsheeran.com"")
     *
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        // return [
        //     'id' => $this->id,
        //     'file_path' => $this->file_path,
        //     'file_name' => $this->file_name,
        //     'url' => $this->url,
        //     'title' => $this->title,
        //     'duration' => $this->duration,
        //     'artist_name' => $this->artist_name,
        //     'created_at' => $this->created_at,
        // ];
    }
}
