<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Competitor;
use App\Models\Round;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RoundController extends Controller
{
    public function index() {
        //
    }

    public function findByCompetitionId($competitionId) {
        $validator = Validator::make(['competitionId' => $competitionId], ['competitionId' => 'required|integer']);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $rounds = Round::where('competition_id', $competitionId)->get();

        return view('rounds.rounds-by-competition', ['rounds' => $rounds], ['competitionId' => $competitionId]);
    }

    public function create() {
        //
    }

    public function store(Request $request)
    {
        $validationRules = [
            'competition_id' => 'required|integer',
            'location' => 'required|string',
            'round_number' => 'required|integer|min:1',
            'date' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $competition = Competition::find($request->input('competition_id'));

        if (!$competition) {
            return response()->json(['error' => 'Competition not found'], 404);
        }

        $roundYear = date('Y', strtotime($request->input('date')));
        if ($roundYear != $competition->competition_year) {
            return response()->json(['error' => 'The round year must match the competition year (' . $competition->competition_year . ')'], 422);
        }

        $round = new Round();
        $round->competition_id = $request->input('competition_id');
        $round->round_number = $request->input('round_number');
        $round->location = $request->input('location');
        $round->date = $request->input('date');
        $round->save();

        $rounds = Round::where('competition_id', $round->competition_id)->get();

        $roundsList = view('partials.roundsList', ['rounds' => $rounds])->render();

        return response()->json(['html' => $roundsList]);
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), ['id' => 'required|integer']);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid round ID'], 422);
        }

        $round = Round::find($request->id);

        if (!$round) {
            return response()->json(['error' => 'Round not found'], 404);
        }

        $competitionId = $round->competition_id;

        $round->competitors()->delete();
        $round->delete();

        $rounds = Round::where('competition_id', $competitionId)->get();

        $roundsList = view('partials.roundsList', ['rounds' => $rounds])->render();

        return response()->json(['html' => $roundsList]);
    }

}
