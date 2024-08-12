<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CompetitionController extends Controller
{

    public function create()
    {
        return view('competitions.create-competition');
    }

    public function store(Request $request)
    {
        $validationRules = [
            'competition_name' => 'required|string|max:255',
            'competition_year' => 'required',
            'available_languages' => 'required',
            'available_languages.*' => 'required|string|max:255',
            'maximum_points' => 'required|integer|min:1',
        ];

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }


        $competition = new Competition();
        $competition->competition_name = $request->input('competition_name');
        $competition->competition_year = $request->input('competition_year');
        $competition->available_languages = json_encode($request->input('available_languages'));
        $competition->maximum_points = $request->input('maximum_points');
        $competition->save();

        if($request->ajax()) {
            return response()->json(['message' => 'Competition created']);
        }

        return redirect()->route('create-competition')->with('success', 'Competition created successfully!');

    }
}
