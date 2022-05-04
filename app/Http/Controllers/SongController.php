<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSong;
use App\Http\Requests\UpdateSong;
use App\Http\Resources\SongResource;
use App\Http\Resources\SongsCollection;
use App\Services\SongService;
use Illuminate\Support\Facades\DB;

class SongController extends Controller
{
    public function __construct(SongService $songService)
    {
        $this->songService = $songService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $songs = $this->songService->getAllSongs();

        return new SongsCollection($songs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSong $request)
    {
        DB::beginTransaction();

        try {
            // Will return only validated data
            $validated = $request->validated();
            $song = $this->songService->storeSong($validated);
        } catch (Exception $e) {
            DB::rollBack();
            return 'error: ' . $e->getMessage();
        }

        DB::commit();
        return new SongResource($song);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $song = $this->songService->getSong($id);
        return new SongResource($song);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSong $request, $id)
    {
        DB::beginTransaction();
        try {
            // Will return only validated data
            $validated = $request->validated();
            $this->songService->updateSong($validated, $id);
        } catch (Exception $e) {
            DB::rollBack();
            return 'error: ' . $e->getMessage();
        }

        DB::commit();

        return response()->json([
            'message' => 'Data updates successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $this->songService->deleteSong($id);
        } catch (Exception $e) {
            DB::rollBack();
            return 'error: ' . $e->getMessage();
        }

        DB::commit();
        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
    }
}
