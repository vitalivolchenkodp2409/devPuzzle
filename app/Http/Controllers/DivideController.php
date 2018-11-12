<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Divide;
use App\Http\Resources\Divide as DivideResource;
use Illuminate\Support\Facades\Storage;

class DivideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get divides 
        $divides = Divide::paginate(5);        

        //return collection of divides as a resource
        return DivideResource::collection($divides);
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $divide = $request->isMethod('put') ? Divide::findOrFail 
        ($request->divide_id) : new Divide;

        $divide->id = $request->input('divide_id');
        $divide->name = $request->input('name');

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $divide->name . '.' . $image->getClientOriginalExtension();
            Storage::putFileAs('public/image', $image, $filename);

            $divide->img = $filename;
        }

        if($divide->save()) {
            return new DivideResource($divide);
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
        // get divide
        $divide = Divide::findOrFail($id);        

        // return single divide as a resource
        return new DivideResource($divide);
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get divide
        $divide = Divide::findOrFail($id);

        if($divide->delete()) {
        return new DivideResource($divide);
        }
    }
}
