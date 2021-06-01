@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Thống kê trận đấu') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">Tổng số trận</div>
                            <div class="col-md-1">{{$matchStatistic['match_count']}}</div>
                            <div class="col-md-1">Thắng</div>
                            <div class="col-md-1">{{$matchStatistic['win_count']}}</div>
                            <div class="col-md-1">Hoà</div>
                            <div class="col-md-1">{{$matchStatistic['draw_count']}}</div>
                            <div class="col-md-1">Bại</div>
                            <div class="col-md-1">{{$matchStatistic['lose_count']}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Số trận sân nhà</div>
                            <div class="col-md-1">{{$matchStatistic['home_count']}}</div>
                            <div class="col-md-1">Thắng</div>
                            <div class="col-md-1">{{$matchStatistic['home_win_count']}}</div>
                            <div class="col-md-1">Hoà</div>
                            <div class="col-md-1">{{$matchStatistic['home_draw_count']}}</div>
                            <div class="col-md-1">Bại</div>
                            <div class="col-md-1">{{$matchStatistic['home_lose_count']}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Số trận sân khách</div>
                            <div class="col-md-1">{{$matchStatistic['away_count']}}</div>
                            <div class="col-md-1">Thắng</div>
                            <div class="col-md-1">{{$matchStatistic['away_win_count']}}</div>
                            <div class="col-md-1">Hoà</div>
                            <div class="col-md-1">{{$matchStatistic['away_draw_count']}}</div>
                            <div class="col-md-1">Bại</div>
                            <div class="col-md-1">{{$matchStatistic['away_lose_count']}}</div>
                        </div>
                    </div>
                </div>
                <div class="card mt-5">
                    <div class="card-header">{{ __('Bàn thắng') }}</div>
                    <div class="card-body">
                        @foreach($playerStatistic['goal'] as $playerName => $goal)
                            <div class="row">
                                <div class="col-md-4">{{$playerName}}</div>
                                <div class="col-md-1">{{$goal}}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card mt-5">
                    <div class="card-header">{{ __('Thẻ vàng') }}</div>
                    <div class="card-body">
                        @foreach($playerStatistic['yellow_card'] as $playerName => $goal)
                            <div class="row">
                                <div class="col-md-4">{{$playerName}}</div>
                                <div class="col-md-1">{{$goal}}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
