<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

interface SongServiceInterface
{
    public function getAllSongs(): LengthAwarePaginator;

    public function getSong(int $id): ?Model;

    public function storeSong(array $data): ?Model;

    public function updateSong(array $data, int $id): bool;

    public function deleteSong(int $id): bool;
}
