<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Store Song request",
 *      description="Store Song request body data",
 *      type="object",
 *      required={"url", "title", "artist_name"}
 * )
 */
class StoreSong extends FormRequest
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
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url' => 'required',
            'title' => 'required',
            'artist_name' => 'required',
            // will use mp3 for demo purpose only
            'audio' => 'nullable|file|mimes:mp3'
        ];
    }
}
