<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Travel;
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
            'startingDate' => 'required|date',
            'endingDate' => 'required|date|after:startingDate',
            'price' => 'required|numeric'
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
        return View('tours.edit', ["tour" => $tour]);
    }

    /**
     * Update the specified tour in storage.
     */
    public function update(Request $request, Tour $tour)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'startingDate' => 'required',
            'endingDate' => 'required',
            'price' => 'required'
        ]);

        $formFields['price'] = $formFields['price'] * 100;

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
