<?php

namespace App\Http\Controllers;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PlanetResource
     */
    public function store(Request $request)
    {
        $planet = Planet::create([
            "solar_system_id" => $request->input('solar_system_id'),
            "name" => $request->input('name'),
            "dimension" => $request->input('dimension'),
            "number_of_moons" => $request->input('number_of_moons'),
            "light_years_from_the_main_star" => $request->input('light_years_from_the_main_star')
        ]);

        return new PlanetResource($planet);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
