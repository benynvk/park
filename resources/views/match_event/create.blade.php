@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Match Event') }}</div>
                    <div class="card-body">
                        <form action="{{ route('event.store', $match->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="team_id"
                                           value="{{ $match->team1_id }}" checked>
                                    <label class="form-check-label">
                                        {{ $match->team1->name }}
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="team_id"
                                           value="{{ $match->team2_id }}">
                                    <label class="form-check-label">
                                        {{ $match->team2->name }}
                                    </label>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="">Event Type</label>
                                    <select class="form-control" name="type">
                                        <option value="1">Goal</option>
                                        <option value="2">Yellow Card</option>
                                        <option value="3">Red Card</option>
                                        <option value="4">Substitute</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Minutes</label>
                                    <select class="form-control" name="minutes">
                                        @for ($i = 1;$i<=90;$i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Player Name</label>
                                <input type="text" name="player_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Related Player Name</label>
                                <input type="text" name="related_player_name" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
