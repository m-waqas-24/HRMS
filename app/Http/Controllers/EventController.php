<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage events')){
            $events = Event::where('created_by' , \Auth::user()->creatorId())->orderby('id', 'DESC')->paginate(16);
        
            return view('admin.events.index', compact('events'));
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required',
            'description' => 'required',
        ]);

        Event::create([
            'title' => $request->title,
            'date' => $request->date,
            'desc' => $request->description,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Event created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if(Auth::user()->can('delete events')){
            if( \Auth::user()->creatorId() == $event->created_by){
                $event->delete();
                return back()->withSuccess('Event deleted successfully!');
            }else{
                auth()->logout();
                abort(403);
            }
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
    }
}
