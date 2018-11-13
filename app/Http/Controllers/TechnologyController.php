<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Technology;
use App\Http\Resources\Technology as TechnologyResource;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //get technologies 
         $technologies = Technology::all();

         //return collection of comments as a resource
         return TechnologyResource::collection($technologies);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $technology = $request->isMethod('put') ? Technology::findOrFail 
        ($request->technology_id) : new Technology;

        $technology->id = $request->input('technology_id');
        $technology->divide_id = $request->input('divide_id');
        $technology->name = $request->input('name');  
              

        if($technology->save()) {
            return new TechnologyResource($technology);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get technology
        $technology = Technology::findOrFail($id);

        // return single comment as a resource
        return new TechnologyResource($technology);
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get technology
        $technology = Technology::findOrFail($id);

        if($technology->delete()) {
        return new TechnologyResource($technology);
        }
    }
}
