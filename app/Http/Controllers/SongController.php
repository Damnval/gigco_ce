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
     * @OA\Get(
     *      path="/api/songs",
     *      operationId="GetSongs",
     *      tags={"Songs"},
     *      summary="Get list of Songs",
     *      description="Returns list of Songs",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
        $songs = $this->songService->getAllSongs();

        return new SongsCollection($songs);
    }

    /**
    * @OA\Post(
    *       path="/api/songs",
    *       operationId="StoreSong",
    *       tags={"Songs"},
    *       summary="Store Song",
    *       description="Will save a new song in DB",
    *       @OA\RequestBody(
    *          @OA\JsonContent(),
    *          @OA\MediaType(
    *               mediaType="multipart/form-data",
    *               @OA\Schema(
    *                  type="object",
    *                  required={"url","title", "artist_name"},
    *                  @OA\Property(property="url", type="text"),
    *                  @OA\Property(property="title", type="text"),
    *                  @OA\Property(property="artist_name", type="text"),
    *                  @OA\Property(property="audio", type="file"),
    *               ),
    *           ),
    *       ),
    *      @OA\Response(
    *          response=201,
    *          description="Register Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="Register Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=422,
    *          description="Unprocessable Entity",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
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
     * @OA\Get(
     *      path="/api/songs/{id}",
     *      operationId="ShowSong",
     *      tags={"Songs"},
     *      summary="Get Song",
     *      description="Returns song data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Song id",
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show($id)
    {
        $song = $this->songService->getSong($id);
        return new SongResource($song);
    }

    /**
     * @OA\Put(
     *      path="/api/songs/{id}",
     *      operationId="updateSongs",
     *      tags={"Songs"},
     *      summary="Update existing song",
     *      description="Returns updated song data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *               mediaType="multipart/form-data",
     *               @OA\Schema(
     *                  type="object",
     *                  required={"url","title", "artist_name"},
     *                  @OA\Property(property="url", type="text"),
     *                  @OA\Property(property="title", type="text"),
     *                  @OA\Property(property="artist_name", type="text"),
     *                  @OA\Property(property="audio", type="file"),
     *               ),
     *           ),
     *       ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
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
     * @OA\Delete(
     *      path="api/songs/{id}",
     *      operationId="deleteSong",
     *      tags={"Songs"},
     *      summary="Delete existing song",
     *      description="Deletes a record and returns a success message",
     *      @OA\Parameter(
     *          name="id",
     *          description="Song id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
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
