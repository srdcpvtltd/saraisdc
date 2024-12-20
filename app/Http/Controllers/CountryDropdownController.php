<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryDropdownController extends Controller
{
    /**
     * return states list.
     *
     * @return json
     */
    public function getStates(Request $request)
    {
        $states = DB::table('states')
            ->where('country_id', $request->country_id)
            -> orderBy('name')
            ->get();
        
        if (count($states) > 0) {
            return response()->json($states);
        }
    }

    /**
     * return cities list
     *
     * @return json
     */
    public function getCities(Request $request)
    {
        $cities = \DB::table('cities')
            ->where('state_id', $request->state_id)
            -> orderBy('name')
            ->get();
        
        if (count($cities) > 0) {
            return response()->json($cities);
        }
    }
}
