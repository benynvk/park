<?php

namespace App\Http\Controllers;

use App\Models\Match;
use App\Models\MatchEvent;
use App\Models\Player;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

class MatchEventController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(int $id)
    {
        $match = Match::with(['team1', 'team2', 'league', 'stadium'])
            ->where('id', $id)->first();
        return view('match_event.create', compact('match'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store($matchID, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'team_id' => 'required',
            'type' => 'required',
            'minutes' => 'required',
            'player_name' => 'required',
            'related_player_name' => 'required_if:type,==4',
        ]);
        if ($validator->fails()) {
            dump($request->all());
            dd($validator->getMessageBag());
        }
        $type = $request->get('type');
        $data = [
            'match_id' => $matchID,
            'team_id' => $request->get('team_id'),
            'type' => $type,
            'player_id' => $this->getPlayerIDByName($request->get('player_name')),
            'minutes' => $request->get('minutes')
        ];
        if (!empty($request->get('related_player_name')) && in_array($type, [1, 4])) {
            $data['related_player_id'] = $this->getPlayerIDByName($request->get('related_player_name'));
        }
        $event = new MatchEvent();
        $event->fill($data);
        $event->save();

        return redirect(route('match.show', $matchID));
    }

    /**
     * @param string $name
     * @return Player|Builder|Model|object|null
     */
    private function getPlayerIDByName(string $name)
    {
        $name = trim($name);
        $player = Player::query()->where('name', $name)->first();
        if (!$player) {
            $player = new Player();
            $player->name = $name;
            $player->save();
        }

        return $player->id;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $match = Match::with(['team1', 'team2', 'league', 'stadium'])
            ->where('id', $id)->first();

        return view('match.view', compact('match'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
