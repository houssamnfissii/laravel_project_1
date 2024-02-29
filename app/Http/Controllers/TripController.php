<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips=Trip::get();
        return view('admin.triplist',compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tripcreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $validatedData = $request->validate([
            'destination' => 'required|string',
            'status' => 'required|in:available,unavailable',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'max_participants' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'city' => 'required|string',
            'description' => 'required|string',
            'image_1' => 'image|max:2048', 
            'image_2' => 'image|max:2048',
            'image_3' => 'image|max:2048',
        ]);
    
        $imagePaths = [];
        foreach (['image_1', 'image_2', 'image_3'] as $imageField) {
            if ($request->hasFile($imageField)) {
             
                $imageName = uniqid() . '_' . time() . '.' . $request->file($imageField)->extension();
             
                $request->file($imageField)->move(public_path(), $imageName);
           
                $imagePaths[$imageField] =$imageName;
            }

        }
        $trip = new Trip();
        $trip->destination = $validatedData['destination'];
        $trip->status = $validatedData['status'];
        $trip->start_date = $validatedData['start_date'];
        $trip->end_date = $validatedData['end_date'];
        $trip->max_participants = $validatedData['max_participants'];
        $trip->price = $validatedData['price'];
        $trip->city = $validatedData['city'];
        $trip->description = $validatedData['description'];
        $trip->image_1 = $imagePaths['image_1'] ?? null;
        $trip->image_2 = $imagePaths['image_2'] ?? null;
        $trip->image_3 = $imagePaths['image_3'] ?? null;
    
        $trip->save();
        return redirect()->route('trip.index')->with('success', 'Trip created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $trip = Trip::with('reviews', 'activities')->find($id);
        return view('admin.tripdetails',compact('trip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $trip=Trip::find($id);
        return view('admin.tripedit',compact('trip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'destination' => 'required|string',
            'status' => 'required|in:available,unavailable',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'max_participants' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'city' => 'required|string',
            'description' => 'required|string',
            'image_1' => 'image|max:2048', 
            'image_2' => 'image|max:2048',
            'image_3' => 'image|max:2048',
        ]);
    
        $trip = Trip::findOrFail($id);
    
        // Remove existing images if new ones are uploaded
        if ($request->hasFile('image_1') && $trip->image_1) {
            unlink(public_path($trip->image_1));
        }
        if ($request->hasFile('image_2') && $trip->image_2) {
            unlink(public_path($trip->image_2));
        }
        if ($request->hasFile('image_3') && $trip->image_3) {
            unlink(public_path($trip->image_3));
        }
    
        // Process uploaded images
        $imagePaths = [];
        foreach (['image_1', 'image_2', 'image_3'] as $imageField) {
            if ($request->hasFile($imageField)) {
                $imageName = uniqid() . '_' . time() . '.' . $request->file($imageField)->extension();
                $request->file($imageField)->move(public_path(), $imageName);
                $imagePaths[$imageField] = $imageName;
            }
        }
    
        // Update trip data
        $trip->update([
            'destination' => $validatedData['destination'],
            'status' => $validatedData['status'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'max_participants' => $validatedData['max_participants'],
            'price' => $validatedData['price'],
            'city' => $validatedData['city'],
            'description' => $validatedData['description'],
            'image_1' => $imagePaths['image_1'] ?? $trip->image_1,
            'image_2' => $imagePaths['image_2'] ?? $trip->image_2,
            'image_3' => $imagePaths['image_3'] ?? $trip->image_3,
        ]);
    
        return redirect()->route('trip.index')->with('success', 'Trip updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $trip = Trip::findOrFail($id);
     
        $trip->delete();

        return redirect()->route('trip.index')->with('success', 'Trip deleted successfully.');
    }
    public function vidercore($id)
    {
        
    }
}
