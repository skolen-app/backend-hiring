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
    public function store(StorePlanetRequest $request)
    {
        $planet = Planet::create([
            "solar_system_id" => $request->input('solar_system_id'),
            "name" => $request->input('name'),
            "dimension" => $request->input('dimension'),
            "number_of_moons" => $request->input('number_of_moons'),
            "light_years_from_the_main_star" => $request->input('light_years_from_the_main_star')
        ]);

        //return $this->response('', new PlanetResource($planet));
        return response('Planeta criado com sucesso!')->json($planet);
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
     * @return \Illuminate\Http\Response
     */
    public function update(StorePlanetRequest $request, $id)
    {
        $planet = Planet::findOrFail($request->id);

        $planet->update([
            'name' => $request->name,
            'dimension' => $request->dimension,
            'number_of_moons' => $request->number_of_moons,
            'light_years_from_the_main_star'=> $request->light_years_from_the_main_star
        ]);
        return $this->response('Informações sobre Planeta atualizadas com sucesso!', new PlanetResource($planet));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $planet = Planet::findOrFail($id);
        $planet->delete();
        return $this->response('Planeta excluído com sucesso!');
    }
}
