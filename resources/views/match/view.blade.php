@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Match Detail') }}</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">League: </label>
                            {{ $match->league->name }}
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">Team 1: </label>
                                {{ $match->team1->name }}
                            </div>
                            <div class="col-md-6">
                                <label for="">Team 1 Score: </label>
                                {{ $match->team1_score }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">Team 2: </label>
                                {{ $match->team2->name }}
                            </div>
                            <div class="col-md-6">
                                <label for="">Team 2 Score: </label>
                                {{ $match->team2_score }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">Stadium: </label>
                                {{ $match->stadium->name }}
                            </div>
                            <div class="col-md-6">
                                <label for="">Time: </label>
                                {{ date('H:i d/m/Y',strtotime($match->time)) }}
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ $match->id }}/event/create" class="btn btn-primary mt-5 mb-3">Add event</a>
                <div class="card">
                    <div class="card-header">{{ __('Match Event') }}</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($events as $event)
                                <li class="list-group-item">
                                    <span class="font-weight-bold">{{ $event->minutes }}' </span>
                                    @switch($event->type)
                                        @case(1)
                                        <span class="font-weight-bold text-uppercase">Bàn thắng cho {{$event->team-> name}}, người ghi bàn là {{ $event->player->name }}</span>
                                        @break
                                        @case(2)
                                        Thẻ vàng cho <span class="font-weight-bold">{{ $event->player->name }}</span> của {{$event->team-> name}}
                                        @break
                                        @case(3)
                                        Thẻ đỏ cho <span class="font-weight-bold">{{ $event->player->name }}</span> của {{$event->team-> name}}
                                        @break
                                        @case(4)
                                        Thay người bên phía {{$event->team-> name}}: <span class="font-weight-bold">{{ $event->related_player->name }}</span> vào sân, <span class="font-weight-bold">{{ $event->player->name }}</span> rời sân
                                        @break
                                    @endswitch
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
