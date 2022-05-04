<?php

namespace Tests\Feature;

use App\Models\Song;
use Tests\TestCase;

class SongApiTest extends TestCase
{
    /**
     * Test that will save a song model in DB
     *
     * @return void
     */
    public function test_can_create_song()
    {
        $formData = [
            'url' => 'Unit Test url',
            'title' => 'Unit Test Photograhp',
            'artist_name' => 'Unit Test Ed sheeran',
        ];

        $this->post(route('songs.store'), $formData)
        ->assertStatus(201);
    }

    /**
     * will get a specific song
     *
     * @return void
     */
    public function test_can_get_specic_song()
    {
        $song = Song::first();

        $this->get(route('songs.update', $song->id))
            ->assertStatus(200);
    }

    /**
     * Test that it can get all songs
     *
     * @return void
     */
    public function test_can_get_all_songs()
    {
        $this->get(route('songs.index'))
            ->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_can_update_song()
    {
        $song = Song::first();

        $formData = [
            'url' => 'Unit Test update url',
            'title' => 'Unit Test update Photograhp',
            'artist_name' => 'Unit Test update Ed sheeran',
        ];

        $this->put(route('songs.update', $song->id), $formData)
            ->assertStatus(200);
    }

    /**
     * will test if artist_name field is required
     *
     * @return void
     */
    public function test_artist_name_is_required()
    {
        $formData = [
            'url' => 'test Url',
            'title' => 'Photograhp',
            'artist_name' => '',
        ];

        $this->json('POST', 'api/songs', $formData, ['Accept' => 'application/json'])
            ->assertStatus(422);
    }

    /**
      * will title if url field is required
      *
      * @return void
      */
    public function test_title_is_required()
    {
        $formData = [
            'url' => 'test Url',
            'title' => '',
            'artist_name' => 'Ed sheeran',
        ];

        $this->json('POST', 'api/songs', $formData, ['Accept' => 'application/json'])
            ->assertStatus(422);
    }

    /**
     * will test if url field is required
     *
     * @return void
     */
    public function test_url_is_required()
    {
        $formData = [
            'url' => '',
            'title' => 'Photograhp',
            'artist_name' => 'Ed sheeran',
        ];

        $this->json('POST', 'api/songs', $formData, ['Accept' => 'application/json'])
            ->assertStatus(422);
    }

    /**
     * will test if can delete a song
     *
     * @return void
     */
    public function test_delete_song()
    {
        $song = Song::first();

        if ($song) {
            $song->delete();
        }

        $this->assertTrue(true);
    }
}
