<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TravelController extends Controller
{
    /**
     * Display a listing of the travel.
     */
    public function index()
    {
        return View("dashboard", ["travels" => Travel::all()]);
    }

    /**
     * Show the form for creating a new travel.
     */
    public function create()
    {
        return View('travels.create');
    }

    /**
     * Store a newly created travel in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'numberOfDays' => ['required', 'numeric'],
            'nature' => ['required', 'numeric'],
            'relax' => ['required', 'numeric'],
            'history' => ['required', 'numeric'],
            'culture' => ['required', 'numeric'],
            'party' => ['required', 'numeric'],
        ]);

        $isPublic = $request->has('isPublic');

        $slug =  str_replace(" ", "-", strtolower($formFields['name']));
        if (Travel::where('slug', Str::slug($request->name))->exists()) {
            return redirect()->back()->withErrors(['name' => 'Element already exists.']);
        }

        $moods = [
            "nature" => $request->nature ?? 0,
            "relax" => $request->relax ?? 0,
            "history" => $request->history ?? 0,
            "culture" => $request->culture ?? 0,
            "party" => $request->party ?? 0
        ];

        foreach ($moods as $key => $value) {
            if ($value > 100) {
                return redirect()->back()->withErrors([$key => 'The value of ' . $key . ' can\'t be greater than 100.']);
            }
        }

        Travel::create(array_merge($formFields, ['isPublic' => $isPublic, 'slug' => $slug, 'moods' => json_encode($moods)]));

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified travel.
     */
    public function show(Travel $travel)
    {
        $tours = Tour::where('travelId', $travel->id)->get();

        $moods = json_decode($travel->moods);
        return View("travels.show", [
            "travel" => $travel,
            "moods" => $moods,
            "tours" => $tours
        ]);
    }

    /**
     * Show the form for editing the specified travel.
     */
    public function edit(Travel $travel)
    {
        $moods = json_decode($travel->moods);
        return View('travels.edit', ["travel" => $travel, "moods" => $moods]);
    }

    /**
     * Update the specified travel in storage.
     */
    public function update(Request $request, Travel $travel)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'numberOfDays' => ['required', 'numeric'],
        ]);

        $isPublic = $request->has('isPublic');

        $slug =  str_replace(" ", "-", strtolower($formFields['name']));

        $moods = [
            "nature" => $request->nature ?? 0,
            "relax" => $request->relax ?? 0,
            "history" => $request->history ?? 0,
            "culture" => $request->culture ?? 0,
            "party" => $request->party ?? 0
        ];

        foreach ($moods as $key => $value) {
            if ($value > 100) {
                return redirect()->back()->withErrors([$key => 'The value of ' . $key . ' can\'t be greater than 100.']);
            }
        }

        $travel->update(array_merge($formFields, ['isPublic' => $isPublic, 'slug' => $slug, 'moods' => json_encode($moods)]));

        return redirect("travels/" . $travel->id);
    }

    /**
     * Remove the specified travel from storage.
     */
    public function destroy(Travel $travel)
    {
        // Elimina tutti i tour associati al travel
        $travel->tours()->delete();

        $travel->delete();
        return redirect('/');
    }
}
