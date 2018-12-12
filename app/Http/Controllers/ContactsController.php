<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Contacts;
use App\Http\Resources\Contacts as ContactsResource;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get contacts 
        $contacts = Contacts::all();

        //return collection of contacts as a resource
        return ContactsResource::collection($contacts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $contacts = $request->isMethod('put') ? contacts::findOrFail 
        ($request->id) : new Contacts;

        $contacts->id = $request->input('id');
        $contacts->name = $request->input('name');
        $contacts->email = $request->input('email');
        $contacts->message = $request->input('message');

        $data = ['name' => $request->input('name'), 'email' => $request->input('email'), 
        'message' => $request->input('message')];        

                        
        Mail::to('tarasenkoa.dp@gmail.com')->send(new SendMailable($data));
        Mail::to('temp.socials.dp@gmail.com')->send(new SendMailable($data));

        if($contacts->save()) {
            return new ContactsResource($contacts);
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
        // get contacts
        $contacts = Contacts::findOrFail($id);

        // return single contacts as a resource
        return new ContactsResource($contacts);
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get contacts
        $contacts = Contacts::findOrFail($id);

        if($contacts->delete()) {
        return new ContactsResource($contacts);
        }
    }
}
