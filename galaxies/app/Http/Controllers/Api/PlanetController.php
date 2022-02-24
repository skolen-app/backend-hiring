<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlanetRequest;
use App\Http\Resources\PlanetResource;
use App\Models\Planet;
use Illuminate\Support\Facades\DB;

class PlanetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $userId = auth('api')->user()->getAuthIdentifier();
        return PlanetResource::collection(DB::table('planets')
            ->join('solar_systems', 'planets.solar_system_id', '=', 'solar_systems.id')
            ->join('galaxies', 'solar_systems.galaxy_id', '=','galaxies.id')
            ->where('galaxies.user_id', '=', $userId)
            ->where('planets.deleted_at', '=', null)
            ->select('planets.*')
            ->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePlanetRequest $request, $solarSystemId)
    {
        $userId = auth('api')->user()->getAuthIdentifier();
        $solarSystemBelongsToUser = DB::table('users')
            ->join('galaxies', 'galaxies.user_id', '=', 'users.id')
            ->join('solar_systems', 'solar_systems.galaxy_id', '=','galaxies.id')
            ->where('galaxies.user_id', '=', $userId)
            ->where('solar_systems.id', '=', $solarSystemId)
            ->where('solar_systems.deleted_at', '=', null)
            ->select('solar_systems.*')
            ->first();
        if($solarSystemBelongsToUser != null) {
            $data = ($request->validated());
            $data['solar_system_id'] = $solarSystemId;
            $planet = Planet::create($data);
            return response()->json(['status' => 'Planeta criado com sucesso!', new PlanetResource($planet)]);
        }
        else {
            return response()->json(['status' => 'Não é possível criar esse Planeta!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return PlanetResource
     */
    public function show($id)
    {
        $userId = auth('api')->user()->getAuthIdentifier();
        $planetBelongsToUser = DB::table('users')
            ->join('galaxies', 'galaxies.user_id', '=', 'users.id')
            ->join('solar_systems', 'solar_systems.galaxy_id', '=','galaxies.id')
            ->join('planets', 'planets.solar_system_id', '=', 'solar_systems.id')
            ->where('galaxies.user_id', '=', $userId)
            ->where('planets.id', '=', $id)
            ->where('planets.deleted_at', '=', null)
            ->select('planets.*')
            ->first();
        if($planetBelongsToUser != null) {
            return new PlanetResource(Planet::FindOrFail($id));
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
    public function update(StorePlanetRequest $request, $id)
    {
        $userId = auth('api')->user()->getAuthIdentifier();
        $planetBelongsToUser = DB::table('users')
            ->join('galaxies', 'galaxies.user_id', '=', 'users.id')
            ->join('solar_systems', 'solar_systems.galaxy_id', '=','galaxies.id')
            ->join('planets', 'planets.solar_system_id', '=', 'solar_systems.id')
            ->where('galaxies.user_id', '=', $userId)
            ->where('planets.id', '=', $id)
            ->where('planets.deleted_at', '=', null)
            ->select('planets.*')
            ->first();
        if($planetBelongsToUser != null) {
            $planet = Planet::findOrFail($id);
            $planet->update($request->all());
            return response()->json(['status' => 'Informações sobre Planeta atualizadas com sucesso!', new PlanetResource($planet)]);
        }
        else {
            return response()->json(['status' => 'Não é possível autualizar as informações desse Planeta!']);
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
        $planetBelongsToUser = DB::table('users')
            ->join('galaxies', 'galaxies.user_id', '=', 'users.id')
            ->join('solar_systems', 'solar_systems.galaxy_id', '=','galaxies.id')
            ->join('planets', 'planets.solar_system_id', '=', 'solar_systems.id')
            ->where('galaxies.user_id', '=', $userId)
            ->where('planets.id', '=', $id)
            ->where('planets.deleted_at', '=', null)
            ->select('planets.*')
            ->first();
        if($planetBelongsToUser != null) {
            $planet = Planet::findOrFail($id);
            $planet->delete();
            return response()->json(['status' => 'Planeta excluído com sucesso!']);
        }
        else {
            return response()->json(['status' => 'Não é possível excluir esse Planeta!']);
        }
    }
}
