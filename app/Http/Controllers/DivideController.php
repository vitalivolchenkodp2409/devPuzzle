<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Divide;
use App\Http\Resources\Divide as DivideResource;
use Illuminate\Support\Facades\Storage;
use Image;

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
                Storage::delete('/public/image/' . $divide->img);                             
            }

            $image = $request->file('image');

            $filename = $divide->name . '-' . time() . '.' . $image->getClientOriginalExtension();
            Storage::putFileAs('public/image', $image, $filename);
            
            $image_path = public_path('storage/image/'.$filename);
            //dd($image_path);
            $img = Image::make($image_path)->resize(325, 250, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($image_path);

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
