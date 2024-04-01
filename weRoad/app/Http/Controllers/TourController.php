<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Travel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Show the form for creating a new tour.
     */
    public function create(Travel $travel)
    {
        return View('tours.create', ['travel' => $travel]);
    }

    /**
     * Store a newly created tour in storage.
     */
    public function store(Request $request, Travel $travel)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'startingDate' => ['required', 'date', 'after_or_equal:today'],
            'endingDate' => [
                'required',
                'date',
                'after:startingDate',
                function ($attribute, $value, $fail) use ($request, $travel) {
                    $startingDate = Carbon::parse($request->input('startingDate'));
                    $endingDate = Carbon::parse($value);

                    if ($startingDate->diffInDays($endingDate) > $travel->numberOfDays) {
                        $fail('The difference between starting date and ending date must be at most ' . $travel->numberOfDays . ' days.');
                    }
                },
            ],
            'price' => ['required', 'numeric', 'gt:0']
        ]);

        $formFields['price'] *= 100;
        Tour::create(array_merge($formFields, ["travelId" => $travel->id]));

        return redirect('/travels/' . $travel->id);
    }

    /**
     * Show the form for editing the specified tour.
     */
    public function edit(Tour $tour)
    {
        $travel = Travel::find($tour->travelId);

        return View('tours.edit', ["tour" => $tour, 'travel' => $travel]);
    }

    /**
     * Update the specified tour in storage.
     */
    public function update(Request $request, Tour $tour)
    {
        $travel = Travel::find($tour->travelId);

        $formFields = $request->validate([
            'name' => 'required',
            'startingDate' => ['required', 'date', 'after_or_equal:today'],
            'endingDate' => [
                'required',  'date', 'after:startingDate',
                function ($attribute, $value, $fail) use ($request, $travel) {
                    $startingDate = Carbon::parse($request->input('startingDate'));
                    $endingDate = Carbon::parse($value);

                    if ($startingDate->diffInDays($endingDate) > $travel->numberOfDays) {
                        $fail('The difference between starting date and ending date must be at most ' . $travel->numberOfDays . ' days.');
                    }
                },
            ],
            'price' => ['required', 'numeric', 'gt:0']
        ]);

        $formFields['price'] *= 100;

        $tour->update($formFields);

        return redirect('/travels/' . $tour->travelId);
    }

    /**
     * Remove the specified tour from storage.
     */
    public function destroy(Tour $tour)
    {
        $tour->delete();
        return redirect('/');
    }
}
