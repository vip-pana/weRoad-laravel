<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Travel;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TravelController extends Controller
{
    /**
     * Display a listing of the travel.
     */
    public function index(): View
    {
        return View("dashboard", ["travels" => Travel::with('tours')->paginate(4)]);
    }

    /**
     * Show the form for creating a new travel.
     */
    public function create(): View
    {
        return View('travels.create');
    }

    /**
     * Store a newly created travel in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $formFields = $this->validateTravel($request);

        $slug = Str::slug($formFields['name']);
        if (Travel::where('slug', $slug)->exists()) {
            return redirect()->back()->withErrors(['name' => 'Element already exists.']);
        }

        // If is checked it will be true, if it's unchecked or false will return false
        $isPublic = $request->has(key: 'isPublic');

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
    public function show(Request $request, string $slug): View
    {
        $travel = Travel::where('slug', $slug)->firstOrFail();
        $tours = Tour::where('travelId', $travel->id);

        $tours = $this->applyFilters($tours, $request);

        return View("travels.show", [
            "travel" => $travel,
            "tours" => $tours->paginate(5),
            "moods" => json_decode($travel->moods),
        ]);
    }

    private function applyFilters($tours, Request $request)
    {
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

        return $tours;
    }


    /**
     * Show the form for editing the specified travel.
     */
    public function edit(string $slug): View
    {
        $travel = Travel::where('slug', $slug)->firstOrFail();

        return View('travels.edit', ["travel" => $travel, "moods" => json_decode($travel->moods)]);
    }

    /**
     * Update the specified travel in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $travel = Travel::where('id', $id)->firstOrFail();

        $formFields = $this->validateTravel($request);

        $isPublic = $request->has('isPublic');

        $slug =  Str::slug($formFields['name']);
        if (Travel::where('slug', $slug)->where('id', '!=', $travel->id)->exists()) {
            return redirect()->back()->withErrors(['name' => 'Element already exists.']);
        }

        $moods = [
            "nature" => $request->nature,
            "relax" => $request->relax,
            "history" => $request->history,
            "culture" => $request->culture,
            "party" => $request->party
        ];

        $travel->update(array_merge($formFields, ['isPublic' => $isPublic, 'slug' => $slug, 'moods' => json_encode($moods)]));

        return redirect()->route('travels.show', ['slug' => $travel->slug]);
    }

    private function validateTravel(Request $request): array
    {
        return $request->validate([
            'name' => 'required',
            'description' => 'required',
            'numberOfDays' => ['required', 'numeric', 'gt:0'],
            'nature' => ['required', 'numeric', 'between:0,100'],
            'relax' => ['required', 'numeric', 'between:0,100'],
            'history' => ['required', 'numeric', 'between:0,100'],
            'culture' => ['required', 'numeric', 'between:0,100'],
            'party' => ['required', 'numeric', 'between:0,100'],
        ]);
    }

    /**
     * Remove the specified travel from storage.
     */
    public function destroy(Travel $travel): RedirectResponse
    {
        $travel->tours()->delete();
        $travel->delete();
        return redirect()->route('dashboard');
    }
}
