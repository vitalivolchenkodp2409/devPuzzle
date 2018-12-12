<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Divide;
use App\Http\Resources\Divide as DivideResource;
use Image;
use Illuminate\Support\Facades\File;

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
        $divides = Divide::all();        

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
        ($request->id) : new Divide;

        $divide->id = $request->input('id');
        $divide->name = $request->input('name');

        if($request->hasFile('image')) {
            if($divide->img){                 
                File::delete(public_path('image/') . $divide->img);                           
            }

            $image = $request->file('image');

            $filename = $divide->name . '-' . time() . '.' . $image->getClientOriginalExtension();
                        
            $image_path = public_path('image/'.$filename);
            
            Image::make($image)->resize(325, 250)->save($image_path);            

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
        
        File::delete(public_path('image/') . $divide->img);
        
        if($divide->delete()) {
        return new DivideResource($divide);
        }
    }
}
