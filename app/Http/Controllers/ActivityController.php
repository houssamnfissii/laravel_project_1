<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Trip;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities=Activity::get();
        return view('admin.activiylist',compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $Trip = Trip::find($id);
        return view('admin.activiycreate', compact('Trip'));
    }
    
    public function update(Request $request,$id)
    {
       
            
            $obj = new Activity();
            $obj->trip_id=$id;
            $obj->title=$request->title;
            $obj->description=$request->description;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time().'.'.$image->extension();
                $image->move(public_path(), $imageName);
                $obj->image=$imageName;
            }

            $obj->image='image';
            $obj->save();
    
        return redirect()->back();
    }
    

    /**

     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
    
        return redirect()->back()->with('success', 'Activity deleted successfully');
    }
}
