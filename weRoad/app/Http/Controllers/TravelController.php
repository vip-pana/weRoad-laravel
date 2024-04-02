<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Travel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TravelController extends Controller
{
    /**
     * Display a listing of the travel.
     */
    public function index(Request $request)
    {
        $travels = Travel::with('tours')->paginate(4);

        return View("dashboard", ["travels" => $travels]);
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
            'numberOfDays' => ['required', 'numeric', 'gt:0'],
            'nature' => ['required', 'numeric', 'between:0,100'],
            'relax' => ['required', 'numeric', 'between:0,100'],
            'history' => ['required', 'numeric', 'between:0,100'],
            'culture' => ['required', 'numeric', 'between:0,100'],
            'party' => ['required', 'numeric', 'between:0,100'],
        ]);

        $isPublic = $request->has('isPublic');

        $slug =  str_replace(" ", "-", strtolower($formFields['name']));
        if (Travel::where('slug', Str::slug($request->name))->exists()) {
            return redirect()->back()->withErrors(['name' => 'Element already exists.']);
        }

        $moods = [
            "nature" => $request->nature,
            "relax" => $request->relax,
            "history" => $request->history,
            "culture" => $request->culture,
            "party" => $request->party
        ];

        Travel::create(array_merge($formFields, ['isPublic' => $isPublic, 'slug' => $slug, 'moods' => json_encode($moods)]));

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified travel.
     */
    public function show(Request $request, string $slug)
    {
        $travel = Travel::where('slug', $slug)->firstOrFail();
        $tours = Tour::where('travelId', $travel->id);

        // search filters
        if ($request->has('dateFrom') && $request->input('dateFrom') != null) {
            $dateFrom = Carbon::createFromFormat('Y-m-d', $request->input('dateFrom'));
            $tours->where('dateStart', '>=', $dateFrom);
        }
        if ($request->has('dateTo') && $request->input('dateTo') != null) {
            $dateTo = Carbon::createFromFormat('Y-m-d', $request->input('dateTo'));
            $tours->where('dateStart', '<=', $dateTo);
        }

        if ($request->has('priceFrom') && $request->input('priceFrom') != null) {
            $tours->where('price', '>=', $request->input('priceFrom') * 100);
        }
        if ($request->has('priceTo') && $request->input('priceTo') != null) {
            $tours->where('price', '<=', $request->input('priceTo') * 100);
        }

        if ($request->has('orderBy') && $request->input('orderBy') != "") {
            $tours->orderBy('price', $request->input('orderBy'));
        } else {
            $tours->orderBy('dateStart', 'ASC');
        }

        $tours = $tours->paginate(5);

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
            'numberOfDays' => ['required', 'numeric', 'gt:0'],
            'nature' => ['required', 'numeric', 'between:0,100'],
            'relax' => ['required', 'numeric', 'between:0,100'],
            'history' => ['required', 'numeric', 'between:0,100'],
            'culture' => ['required', 'numeric', 'between:0,100'],
            'party' => ['required', 'numeric', 'between:0,100'],
        ]);

        $isPublic = $request->has('isPublic');

        $slug =  str_replace(" ", "-", strtolower($formFields['name']));

        $moods = [
            "nature" => $request->nature,
            "relax" => $request->relax,
            "history" => $request->history,
            "culture" => $request->culture,
            "party" => $request->party
        ];

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
