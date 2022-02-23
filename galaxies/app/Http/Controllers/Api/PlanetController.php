<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlanetRequest;
use App\Http\Resources\PlanetResource;
use App\Models\Planet;
use Illuminate\Http\Request;

class PlanetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return PlanetResource::collection(Planet::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePlanetRequest $request, $solarSystemId)
    {
        $planet = Planet::create($request->all());

        return response()->json(['status' => 'Planeta criado com sucesso!', new PlanetResource($planet)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return PlanetResource
     */
    public function show($id)
    {
        return new PlanetResource(Planet::FindOrFail($id));
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
        $planet = Planet::findOrFail($id);

        $planet->update($request->all());

        return response()->json(['status' => 'Informações sobre Planeta atualizadas com sucesso!', new PlanetResource($planet)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $planet = Planet::findOrFail($id);
        $planet->delete();
        return response()->json(['status' => 'Planeta excluído com sucesso!']);
    }
}
