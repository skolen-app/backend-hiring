<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSolarSystemRequest;
use App\Http\Resources\SolarSystemResource;
use App\Models\SolarSystem;
use Illuminate\Support\Facades\DB;

class SolarSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $userId = auth('api')->user()->getAuthIdentifier();
        return SolarSystemResource::collection(DB::table('solar_systems')
            ->join('galaxies', 'solar_systems.galaxy_id', '=','galaxies.id')
            ->where('galaxies.user_id', '=', $userId)
            ->where('solar_systems.deleted_at', '=', null)
            ->select('solar_systems.*')
            ->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSolarSystemRequest $request, $galaxyId)
    {
        $userId = auth('api')->user()->getAuthIdentifier();
        $galaxyBelongsToUser = DB::table('users')
            ->join('galaxies', 'galaxies.user_id', '=', 'users.id')
            ->where('galaxies.user_id', '=', $userId)
            ->where('galaxies.id', '=', $galaxyId)
            ->where('galaxies.deleted_at', '=', null)
            ->select('galaxies.*')
            ->first();
        if($galaxyBelongsToUser != null) {
            $data = ($request->validated());
            $data['galaxy_id'] = $galaxyId;
            $solarSystem = SolarSystem::create($data);
            return response()->json(['status' => 'Sistema Solar criado com sucesso!', new SolarSystemResource($solarSystem)]);
        }
        else {
            return response()->json(['status' => 'Não é possível criar esse Sistema Solar!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return SolarSystemResource
     */
    public function show($id)
    {
        $userId = auth('api')->user()->getAuthIdentifier();
        $solarSystemBelongsToUser = DB::table('users')
            ->join('galaxies', 'galaxies.user_id', '=', 'users.id')
            ->join('solar_systems', 'solar_systems.galaxy_id', '=','galaxies.id')
            ->where('galaxies.user_id', '=', $userId)
            ->where('solar_systems.id', '=', $id)
            ->where('solar_systems.deleted_at', '=', null)
            ->select('solar_systems.*')
            ->first();
        if($solarSystemBelongsToUser != null) {
            return new SolarSystemResource(SolarSystem::FindOrFail($id));
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
    public function update(StoreSolarSystemRequest $request, $id)
    {
        $userId = auth('api')->user()->getAuthIdentifier();
        $solarSystemBelongsToUser = DB::table('users')
            ->join('galaxies', 'galaxies.user_id', '=', 'users.id')
            ->join('solar_systems', 'solar_systems.galaxy_id', '=','galaxies.id')
            ->where('galaxies.user_id', '=', $userId)
            ->where('solar_systems.id', '=', $id)
            ->where('solar_systems.deleted_at', '=', null)
            ->select('solar_systems.*')
            ->first();
        if($solarSystemBelongsToUser != null) {
            $solarSystem = SolarSystem::findOrFail($id);
            $solarSystem->update($request->all());
            return response()->json(['status' => 'Informações sobre Sistema Solar atualizadas com sucesso!', new SolarSystemResource($solarSystem)]);
        }
        else {
            return response()->json(['status' => 'Não é possível autualizar as informações desse Sistema Solar!']);
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
        $solarSystemBelongsToUser = DB::table('users')
            ->join('galaxies', 'galaxies.user_id', '=', 'users.id')
            ->join('solar_systems', 'solar_systems.galaxy_id', '=','galaxies.id')
            ->where('galaxies.user_id', '=', $userId)
            ->where('solar_systems.id', '=', $id)
            ->where('solar_systems.deleted_at', '=', null)
            ->select('solar_systems.*')
            ->first();
        if($solarSystemBelongsToUser != null) {
            $solarSystem = SolarSystem::findOrFail($id);
            $solarSystem->delete();
            return response()->json(['status' => 'Sistema Solar excluído com sucesso!']);
        }
        else {
            return response()->json(['status' => 'Não é possível excluir esse Sistema Solar!']);
        }
    }
}
