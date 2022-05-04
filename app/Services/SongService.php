<?php

namespace App\Services;

use App\CustomClasses\Mp3uploader;
use App\Interfaces\SongServiceInterface;
use App\Models\Song;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class SongService implements SongServiceInterface
{
    // we can use repository to apply seperation of concern or SOLID principle

    /**
     * Initialize Service to use
     *
     * @param Mp3uploader $mp3uploader
     */
    public function __construct(Mp3uploader $mp3uploader)
    {
        $this->mp3uploader = $mp3uploader;
    }

    /**
     * Will get all songs
     *
     * @return LengthAwarePaginator
     */
    public function getAllSongs(): LengthAwarePaginator
    {
        // pagination is hard coded for now since no clear specs
        // we can pass it by request. e.g. $pagination = request->input('pagination')
        $pagination = 8;
        return Song::paginate($pagination);
    }

    /**
     * Will get a specific song
     *
     * @param integer $id
     * @return Model|null
     */
    public function getSong(int $id): ?Model
    {
        $song = Song::findOrFail($id);
        return $song;
    }

    /**
     * Will save a song
     *
     * @param array $data
     * @return Model|null
     */
    public function storeSong(array $data): ?Model
    {
        $data = array_merge($data, $this->mp3uploader->getData($data));

        $song = new Song();
        $song->fill($data);
        $song->save();
        return $song;
    }

    /**
     * Will update a song properties
     *
     * @param array $data
     * @param integer $id
     * @return boolean
     */
    public function updateSong(array $data, int $id): bool
    {
        $data = array_merge($data, $this->mp3uploader->getData($data));

        $song = Song::findOrFail($id);
        $updated_song = $song->update($data);
        return $updated_song;
    }

    /**
     * Will delete a song from database
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteSong(int $id): bool
    {
        $song = Song::findOrFail($id);
        return $song->delete();
    }
}
