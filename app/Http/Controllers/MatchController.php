<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Match;
use App\Models\MatchEvent;
use App\Models\Stadium;
use App\Models\Team;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $matches = Match::with(['team1', 'team2', 'league'])
            ->orderBy('time', 'desc')->get();
        return view('match.index', compact('matches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $leagues = League::all();
        $teams = Team::all();
        $stadiums = Stadium::all();
        return view('match.create', compact('leagues', 'teams', 'stadiums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'league_id' => 'required',
            'stadium_id' => 'required',
            'team1_id' => 'required',
            'team2_id' => 'required',
            'team1_score' => 'required',
            'team2_score' => 'required',
            'time' => 'required',
        ]);
        if ($validator->fails()) {
            dump($request->all());
            dd($validator->getMessageBag());
        }
        $post = new Match();
        $post->fill($request->all());
        $post->save();

        return redirect('/match')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param Match $match
     * @return Application|Factory|View
     */
    public function show(Match $match)
    {
        $events = MatchEvent::with('player', 'related_player')
            ->where('match_id', $match->id)
            ->orderBy('minutes')->get();

        return view('match.view', compact('match', 'events'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
