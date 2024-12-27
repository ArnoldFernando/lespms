<?php

namespace App\Http\Controllers;

use App\Models\RatingAndFeedback;
use Illuminate\Http\Request;

class RatingAndFeedbackController extends Controller
{
    //


    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_service_id' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:10000',
        ]);

        // Check if the user has already rated this service
        $existingRating = RatingAndFeedback::where('event_service_id', $validated['event_service_id'])
            ->where('user_id', auth()->id())
            ->first();

        if ($existingRating) {
            return back()->with('error', 'You have already rated this service.');
        }

        RatingAndFeedback::create([
            'event_service_id' => $validated['event_service_id'],
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'feedback' => $validated['feedback'] ?? null,
        ]);

        return back()->with('success', 'Rating and feedback submitted successfully!');
    }
}
