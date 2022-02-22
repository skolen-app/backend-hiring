<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGalaxyRequest;
use App\Http\Resources\GalaxyResource;
use App\Models\Galaxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $galaxy = Galaxy::create([
            "user_id" => $request->input('user_id'),
            "name" => $request->input('name'),
            "dimension" => $request->input('dimension'),
            "number_of_solar_systems" => $request->input('number_of_solar_systems')
        ]);
        //return $this->response(, new GalaxyResource($galaxy));
        return response('Galáxia criada com sucesso!')->json($galaxy);
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
     * @return GalaxyResource
     */
    public function update(StoreGalaxyRequest $request, $id)
    {
        $galaxy = Galaxy::findOrFail($request->id);

        $galaxy->update([
            'name' => $request->name,
            'dimension' => $request->dimension,
            'number_of_solar_systems' => $request->number_of_solar_systems
        ]);
        return $this->response('Informações sobre Galáxia atualizadas com sucesso!', new GalaxyResource($galaxy));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return GalaxyResource
     */
    public function destroy($id)
    {
        $galaxy = Galaxy::findOrFail($id);
        $galaxy->delete();
        return $this->response('Galáxia excluída com sucesso!');
    }
}
