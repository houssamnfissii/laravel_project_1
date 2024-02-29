<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Trip;
use App\Models\Tripuser;
use App\Models\User;
use BaconQrCode\Encoder\QrCode;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripuserController extends Controller
{
    public function index()
    {
        $trips=Trip::get();
        return view('user.trips',compact('trips'));
    }
    public function show(string $id)
    {   
        $trip = Trip::with('reviews.user', 'activities')->find($id);
        $trips = Trip::get();
        
        if(!$trip) {
            
            abort(404);
        }
    
        return view('user.tripdetails', compact('trip', 'trips'));
    }


    public function book(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to login first.');
        }
    
        $request->validate([
            'trip_id' => 'required|exists:trips,id', 
        ]);
    
        $userId = Auth::id();
    
        $existingRelationship = Tripuser::where('user_id', $userId)
                                        ->where('trip_id', $request->trip_id)
                                        ->exists();
    
        if ($existingRelationship) {
            return redirect()->back()->with('error', 'You have already booked this trip.');
        }
    
        $tripUser = new Tripuser();
        $tripUser->trip_id = $request->trip_id;
        $tripUser->user_id = $userId;
        $tripUser->save();

        $user = User::find($userId);
        $trips = $user->trips()->with('trip', 'user')->get();
        $pdf =  FacadePdf::loadView('user.pdf', ['tripUser' => $tripUser]);
        return $pdf->download('trip_booking.pdf');
    }
   
    public function userTrips()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to login first.');
        }

        $userId = Auth::id();
        $user = User::find($userId);
        $trips = $user->trips()->with('trip', 'user')->get();

        return view('user.triplist', compact('trips'));
    }
    public function destroy($id)
{
    $tripUser = Tripuser::find($id);

    if (!$tripUser) {
        return redirect()->route('user.trips')->with('error', 'Trip user not found.');
    }

    $tripUser->delete();

    return redirect()->route('user.trips')->with('success', 'Trip user deleted successfully.');
}

    
   
}
