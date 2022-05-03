<?php

namespace App\Services;

use App\CustomClasses\Mp3uploader;
use App\Models\Song;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class SongService
{
    public function __construct(Mp3uploader $mp3uploader)
    {
        $this->mp3uploader = $mp3uploader;
    }

    // we can use repository to apply seperation of concern or SOLID principle
    public function getAllSongs(): LengthAwarePaginator
    {
        // pagination is hard coded for now since no clear specs
        // we can pass it by request. e.g. $pagination = request->input('pagination')
        $pagination = 8;
        return Song::paginate($pagination);
    }

    public function getSong(int $id): ?Model
    {
        $song = Song::findOrFail($id);
        return $song;
    }

    public function storeSong(array $data): ?Model
    {
        $data = array_merge($data, $this->mp3uploader->getData($data['audio']));

        $song = new Song();
        $song->fill($data);
        $song->save();
        return $song;
    }

    public function updateSong(array $data, int $id): bool
    {
        $data = array_merge($data, $this->mp3uploader->getData($data['audio']));

        $song = Song::find($id);
        $updated_song = $song->update($data);
        return $updated_song;
    }

    public function deleteSong(int $id): bool
    {
        return Song::destroy($id);
    }
}
