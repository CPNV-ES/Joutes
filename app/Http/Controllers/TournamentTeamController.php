<?php

namespace App\Http\Controllers;

use App\Tournament;
use App\Team;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TournamentTeamController extends Controller
{
    /**
     * Display a listing of the tournaments.
     *
     * @return \Illuminate\Http\Response
     *
     * @author Davide Carboni
     */
    public function index(Request $request , $id)
    {
        $tournament =  Tournament::findOrFail($id);

        // return a list of teams for a selected tournament using ajax
        if ($request->ajax()) {
            return $tournament->completeTeams()->get()->toJson();
        }
    }

    /**
     * Display the specified tournament.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @author Davide Carboni
     */
    public function show(Request $request, $id)
    {
        //
    }


}
