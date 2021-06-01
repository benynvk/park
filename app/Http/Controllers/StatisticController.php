<?php

namespace App\Http\Controllers;

use App\Models\Match;
use App\Models\MatchEvent;
use App\Models\Player;

class StatisticController extends Controller
{
    const HANOI_ID = 1;
    const EVENT_GOAL = 1;
    const EVENT_YELLOW_CARD = 2;
    const EVENT_RED_CARD = 3;

    public function index()
    {
        $matches = Match::query()->where(function ($query) {
            return $query->where('team1_id', self::HANOI_ID)
                ->orWhere('team2_id', self::HANOI_ID);
        })->orderBy('time')->get();
        $matchStatistic = [
            'match_count' => $matches->count(),
            'win_count' => 0,
            'draw_count' => 0,
            'lose_count' => 0,
            'home_count' => 0,
            'home_win_count' => 0,
            'home_draw_count' => 0,
            'home_lose_count' => 0,
            'away_count' => 0,
            'away_win_count' => 0,
            'away_draw_count' => 0,
            'away_lose_count' => 0,
            'goal_score' => 0,
            'goal_conceded' => 0,
            'home_goal_score' => 0,
            'home_goal_conceded' => 0,
            'away_goal_score' => 0,
            'away_goal_conceded' => 0,

        ];
        foreach ($matches as $match) {
            if ($match->team1_id == self::HANOI_ID) {
                $matchStatistic['home_count']++;
                $matchStatistic['goal_score'] += $match->team1_score;
                $matchStatistic['home_goal_score'] += $match->team1_score;
                $matchStatistic['goal_conceded'] += $match->team2_score;
                $matchStatistic['home_goal_conceded'] += $match->team2_score;
                if ($match->team1_score > $match->team2_score) {
                    $matchStatistic['win_count']++;
                    $matchStatistic['home_win_count']++;
                } elseif ($match->team1_score == $match->team2_score) {
                    $matchStatistic['draw_count']++;
                    $matchStatistic['home_draw_count']++;
                } else {
                    $matchStatistic['lose_count']++;
                    $matchStatistic['home_lose_count']++;
                }
            }
            if ($match->team2_id == self::HANOI_ID) {
                $matchStatistic['away_count']++;
                $matchStatistic['goal_score'] += $match->team2_score;
                $matchStatistic['away_goal_score'] += $match->team2_score;
                $matchStatistic['goal_conceded'] += $match->team1_score;
                $matchStatistic['away_goal_conceded'] += $match->team1_score;
                if ($match->team2_score > $match->team1_score) {
                    $matchStatistic['win_count']++;
                    $matchStatistic['away_win_count']++;
                } elseif ($match->team1_score == $match->team2_score) {
                    $matchStatistic['draw_count']++;
                    $matchStatistic['away_draw_count']++;
                } else {
                    $matchStatistic['lose_count']++;
                    $matchStatistic['away_lose_count']++;
                }
            }
        }

        $playerStatistic = [
            'goal' => [],
            'yellow_card' => [],
            'red_card' => [],
        ];
        $events = MatchEvent::query()->where('team_id', self::HANOI_ID)->get()->groupBy('type');
        foreach ($events as $type => $group) {
            $group = $group->groupBy('player_id');
            $playerIDs = array_keys($group->toArray());
            $playerData = Player::query()->whereIn('id', $playerIDs)->pluck('name', 'id');
            foreach ($group as $playerID => $data) {
                if ($type == self::EVENT_GOAL) {
                    $playerStatistic['goal'][$playerData[$playerID]] = $data->count();
                }
                if ($type == self::EVENT_YELLOW_CARD) {
                    $playerStatistic['yellow_card'][$playerData[$playerID]] = $data->count();
                }
                if ($type == self::EVENT_RED_CARD) {
                    $playerStatistic['red_card'][$playerData[$playerID]] = $data->count();
                }
            }
        }
        foreach ($playerStatistic as $key => $stat) {
            arsort($stat);
            $playerStatistic[$key] = $stat;
        }

        return view('statistic.index', compact('matchStatistic', 'playerStatistic'));
    }
}
