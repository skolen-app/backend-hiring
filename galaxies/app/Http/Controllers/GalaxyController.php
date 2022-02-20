<?php

namespace App\Http\Controllers;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return GalaxyResource
     */
    public function store(StoreGalaxyRequest $request)
    {
        $galaxy = Galaxy::create([
            "user_id" => Auth::id(),
            "name" => $request->input('name'),
            "dimension" => $request->input('dimension'),
            "number_of_solar_systems" => $request->input('number_of_solar_systems')
        ]);
        return new GalaxyResource($galaxy);
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
