<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Work;
use App\Http\Resources\Work as WorkResource;
use Illuminate\Support\Facades\File;
use Image;

class WorkController extends Controller
{
    public function index()
    {
        //get works 
        $works = Work::all();

        //return collection of works as a resource
        return WorkResource::collection($works);
    }  
    
    public function store(Request $request)
    {
        $work = $request->isMethod('put') ? Work::findOrFail
        ($request->work_id) : new Work;

        $work->id = $request->input('work_id');
        $work->name = $request->input('name');
        $work->description = $request->input('description');   
        
        if($request->hasFile('image')) {
          if($work->image){                
            File::delete(public_path('image/') . $work->image);                             
          } 

        $image = $request->file('image');

        $filename = $work->name . '-' . time() . '.'. $image->getClientOriginalExtension();
        
        $image_path = public_path('image/'.$filename);
        
        Image::make($image)->resize(325, 250)->save($image_path);

        $work->image = $filename;
        }

        if($work->save()) {
            return new WorkResource($work);
        }
    }

    public function show($id)
    {
        // get work
        $work = Work::findOrFail($id);

        // return single work as a resource
        return new WorkResource($work);
    }   
    
    public function destroy($id)
    {
        // get work
        $work = Work::findOrFail($id);
        
        File::delete(public_path('image/') . $work->image);

        if($work->delete()) {
        return new WorkResource($work);
        }
    }
}