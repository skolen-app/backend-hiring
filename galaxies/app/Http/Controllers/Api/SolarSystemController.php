<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSolarSystemRequest;
use App\Http\Resources\SolarSystemResource;
use App\Models\Planet;
use App\Models\SolarSystem;
use Illuminate\Http\Request;
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
        return SolarSystemResource::collection(SolarSystem::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSolarSystemRequest $request, $galaxyId)
    {
        $solarSystem = SolarSystem::create($request->all());
        return response()->json(['status' => 'Sistema Solar criado com sucesso!', new SolarSystemResource($solarSystem)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return SolarSystemResource
     */
    public function show($id)
    {
        return new SolarSystemResource(SolarSystem::FindOrFail($id));
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
        $solarSystem = SolarSystem::findOrFail($id);

        $solarSystem->update($request->all());
        return response()->json(['status' => 'Informações sobre Sistema Solar atualizadas com sucesso!', new SolarSystemResource($solarSystem)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $solarSystem = SolarSystem::findOrFail($id);
        /*$planets = DB::table('planets')
            ->where('solar_system_id', '=', $id)->get();*/

        $solarSystem->delete();

       /* if(isset($planets)) {
            $planets->delete();
        }*/

        return response()->json(['status' => 'Sistema Solar excluído com sucesso!']);
    }
}
