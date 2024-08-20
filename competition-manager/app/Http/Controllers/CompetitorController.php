<?php

namespace App\Http\Controllers;

use App\Models\Competitor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CompetitorController extends Controller
{
    public function index() {

        //
    }

    public function findByRoundId($roundId) {
        $validator = Validator::make(['roundId' => $roundId], ['roundId' => 'required|integer']);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $competitors = Competitor::where('round_id', $roundId)
            ->with('user')
            ->get();

        $competitorUserIds = $competitors->pluck('user_id')->toArray();

        $users = User::whereNotIn('id', $competitorUserIds)->get();

        return view('competitors.competitor-index', [
            'competitors' => $competitors,
            'users' => $users,
            'roundId' => $roundId
        ]);
    }

    public function addCompetitor(Request $request) {
        $validationRules = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'round_id' => 'required|integer|exists:rounds,id',
        ]);

        $competitor = new Competitor();
        $competitor->user_id = $validationRules['user_id'];
        $competitor->round_id = $validationRules['round_id'];
        $competitor->save();

        $competitors = Competitor::where('round_id', $validationRules['round_id'])->with('user')->get();
        $competitorUserIds = $competitors->pluck('user_id')->toArray();
        $users = User::whereNotIn('id', $competitorUserIds)->get();

        $competitorsList = view('partials.competitorsList', ['competitors' => $competitors])->render();
        $usersDropdown = view('partials.usersDropdown', ['users' => $users])->render();

        return response()->json([
            'html' => $competitorsList,
            'usersDropdown' => $usersDropdown,
        ]);
    }

    public function destroy(Request $request) {

        $validator = Validator::make($request->all(), ['id' => 'required|integer']);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }

        $competitor = Competitor::find($request->id);

        $roundId = $competitor->round_id;

        $competitor->delete();

        $competitors = Competitor::where('round_id', $roundId)->get();

        $competitorsList = view('partials.competitorsList', ['competitors' => $competitors])->render();

        $competitorUserIds = $competitors->pluck('user_id')->toArray();

        $users = User::whereNotIn('id', $competitorUserIds)->get();
        $usersDropdown = view('partials.usersDropdown', ['users' => $users])->render();

        return response()->json([
            'html' => $competitorsList,
            'usersDropdown' => $usersDropdown,
        ]);

    }
}
