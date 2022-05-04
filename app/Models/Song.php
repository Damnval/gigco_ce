<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Song",
 *     description="Song model",
 *     @OA\Xml(
 *         name="Song"
 *     )
 * )
 */
class Song extends Model
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="url",
     *      description="url of the new Song",
     *      example="www.edsheeran.com/songs/"
     * )
     *
     * @var string
     */
    public $url;

    /**
     * @OA\Property(
     *      title="title",
     *      description="title of the new Song",
     *      example="PhotoGraph"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="artist_name",
     *      description="Artist name of the new Song",
     *      example="Ed sheeran"
     * )
     *
     * @var string
     */
    public $artist_name;

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file_path',
        'file_name',
        'url',
        'title',
        'duration',
        'artist_name',
    ];
}
