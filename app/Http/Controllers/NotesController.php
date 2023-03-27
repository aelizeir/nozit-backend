<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Carbon\Carbon;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return Notes::get();
//        $notes = Notes::all();
//        return response()-> json($notes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'isImportant' => 'required',
            'title' => 'required',
            'description'=> 'required',
            'time' => 'required'
        ]);
        $notes = new Notes();
        $notes->user_id = auth()->user()->id;
        $notes->isImportant ? true : false;
        $notes->title = $input['title'];
        $notes->description = $input['description'];
        $notes->time = Carbon::createFromDate($input['date']);
        $notes->save();
        return response()->json($notes);
    }

    /**
     * Display the specified resource.
     */
    public function show(Notes $notes)
    {
        $getValue = Notes::where('user_id', $userId)->get();

        return response([
            'notes' => $getValue
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notes $notes)
    {
        $input = $request-> validate([
            'isImportant' => 'required',
            'title' => 'required',
            'description'=> 'required',
        ]);
//        $notes->isImportant ? true : false;
//        $notes->title = $input['title'];
//        $notes->description = $input['description'];
//        $notes->time = Carbon::createFromDate($input['date']);
//        $notes->save();
//        return response()->json($notes);
        try{

            $notes = Notes::findOrFail($id);
            $notes->update($request->all());

            return response("Successfully edited", 200);

        }catch(Exception $e){
            return response($e->getString(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notes $notes)
    {
        return response ()-> json($notes->delete());
    }
}