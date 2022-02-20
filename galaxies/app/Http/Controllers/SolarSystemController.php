<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSolarSystemRequest;
use App\Http\Resources\SolarSystemResource;
use App\Models\SolarSystem;
use Illuminate\Http\Request;

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
     * @return SolarSystemResource
     */
    public function store(StoreSolarSystemRequest $request)
    {
        $solarSystem = SolarSystem::create([
            "galaxy_id" => $request->input('galaxy_id'),
            "name" => $request->input('name'),
            "dimension" => $request->input('dimension'),
            "number_of_planets" => $request->input('number_of_planets'),
            "main_star" => $request->input('main_star')
        ]);
        return new SolarSystemResource($solarSystem);
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
    public function update(StoreSolarSystemRequest $request, $id)
    {
        $solarSystem = SolarSystem::findOrFail($request->id);

        $solarSystem->update([
            'name' => $request->name,
            'dimension' => $request->dimension,
            'number_of_planets' => $request->number_of_planets,
            'main_star'=> $request->main_star
        ]);
        return $this->response('Informações sobre Sistema Solar atualizadas com sucesso!', new SolarSystemResource($solarSystem));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solarSystem = SolarSystem::findOrFail($id);
        $solarSystem->delete();
        return $this->response('Sistema Solar excluído com sucesso!');
    }
}
