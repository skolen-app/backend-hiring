<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


use App\Http\Requests\StoreGalaxyRequest;
use App\Http\Resources\GalaxyResource;
use App\Models\Galaxy;
use Illuminate\Support\Facades\DB;


class GalaxyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $userId = auth('api')->user()->getAuthIdentifier();
        return GalaxyResource::collection(Galaxy::where('user_id', $userId)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(StoreGalaxyRequest $request)
    {
        $userId = auth('api')->user()->getAuthIdentifier();
        $data = ($request->validated());
        $data['user_id'] = $userId;
        $galaxy = Galaxy::create($data);
        return response()->json(['status' => 'Galáxia criada com sucesso!', new GalaxyResource($galaxy)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return GalaxyResource
     */
    public function show($id)
    {
        $userId = auth('api')->user()->getAuthIdentifier();
        $galaxyBelongsToUser = DB::table('users')
            ->join('galaxies', 'galaxies.user_id', '=', 'users.id')
            ->where('galaxies.user_id', '=', $userId)
            ->where('galaxies.id', '=', $id)
            ->where('galaxies.deleted_at', '=', null)
            ->select('galaxies.*')
            ->first();
        if($galaxyBelongsToUser != null) {
            return new GalaxyResource(Galaxy::FindOrFail($id));
        }
        else {
            return response()->json(['status' => 'Busca não retornou resultados.']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreGalaxyRequest $request, $id)
    {
        $userId = auth('api')->user()->getAuthIdentifier();
        $galaxyBelongsToUser = DB::table('users')
            ->join('galaxies', 'galaxies.user_id', '=', 'users.id')
            ->where('galaxies.user_id', '=', $userId)
            ->where('galaxies.id', '=', $id)
            ->where('galaxies.deleted_at', '=', null)
            ->select('galaxies.*')
            ->first();
        if($galaxyBelongsToUser != null) {
            $galaxy = Galaxy::findOrFail($id);
            $galaxy->update($request->all());
            return response()->json(['status' => 'Informações sobre Galáxia atualizadas com sucesso!', new GalaxyResource($galaxy)]);
        }
        else {
            return response()->json(['status' => 'Não é possível autualizar as informações dessa Galáxia!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $userId = auth('api')->user()->getAuthIdentifier();
        $galaxyBelongsToUser = DB::table('users')
            ->join('galaxies', 'galaxies.user_id', '=', 'users.id')
            ->where('galaxies.user_id', '=', $userId)
            ->where('galaxies.id', '=', $id)
            ->where('galaxies.deleted_at', '=', null)
            ->select('galaxies.*')
            ->first();
        if($galaxyBelongsToUser != null) {
            $galaxy = Galaxy::findOrFail($id);
            $galaxy->delete();
            return response()->json(['status' => 'Galáxia excluída com sucesso!']);
        }
        else {
            return response()->json(['status' => 'Não é possível excluir essa Galáxia!']);
        }
    }
}
