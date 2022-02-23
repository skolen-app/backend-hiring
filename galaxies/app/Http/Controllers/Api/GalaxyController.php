<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Api\AuthController;
use App\Http\Requests\StoreGalaxyRequest;
use App\Http\Resources\GalaxyResource;
use App\Http\Resources\SolarSystemResource;
use App\Models\Galaxy;
use App\Models\Planet;
use App\Models\SolarSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return GalaxyResource::collection(Galaxy::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreGalaxyRequest $request)
    {
        $galaxy = Galaxy::create($request->all());
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
        return new GalaxyResource(Galaxy::FindOrFail($id));
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
        $galaxy = Galaxy::findOrFail($request->id);

        $galaxy->update($request->all());
        return response()->json(['status' => 'Informações sobre Galáxia atualizadas com sucesso!', new GalaxyResource($galaxy)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $galaxy = Galaxy::findOrFail($id);
        /*$solarSystems = SolarSystem::where('galaxy_id', (int)$id)->get();
        $planets = DB::table('planets')
            ->join('solar_systems', 'planets.solar_system_id', '=', 'solar_systems.id')
            ->where('galaxy_id', '=', $id)
            ->select('planets.*')
            ->get();*/

        $galaxy->delete();

        /*if(isset($solarSystems)) {
            $solarSystems->delete();
        }

        if(isset($planets)) {
            $planets->delete();
        }*/
        return response()->json(['status' => 'Galáxia excluída com sucesso!']);
    }
}
