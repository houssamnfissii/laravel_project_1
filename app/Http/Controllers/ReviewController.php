<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        return response()->json($reviews);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'review' => 'required',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        // Assuming you have authenticated user and associated trip
        $review = new Review();
        $review->user_id = auth()->user()->id;
        $review->trip_id = $request->trip_id;
        $review->review_text = $request->review;
        $review->rating = $request->rating;
        $review->save();

        return redirect()->back()->with('success', 'Review added successfully');
    }
}
