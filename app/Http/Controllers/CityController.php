<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;

class CityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        //
    }

    public function getCities($state_id)
    {
        //
        try {
        // $data = [];
        // $cities = AlgeriaCity::all()->where('wilaya_code', '=', $state_code);
        // $cities = $cities->map(function($items){
        //     $data['value'] = $items->id;
        //     $data['text'] = App()->currentLocale() == 'ar' ? $items->commune_name : $items->commune_name_ascii;
        //     return $data;
        //     });


        $cities = City::where('state_id', '=', $state_id)->orderBy('name_ar')->get();
        $cities = $cities->map(function ($items) {
            $data['value'] = $items->id;
            $data['text'] = $items->name;
            return $data;
        });


        return response()->json([ 'cities' => $cities]);
    } catch (Throwable $e) {
        report($e);
        Log::error($e->getMessage());

        return false;
    }
    }
}
