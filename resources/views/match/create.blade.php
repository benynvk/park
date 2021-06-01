@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Match') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="/match" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">League</label>
                                <select class="form-control" name="league_id">
                                    @foreach($leagues as $league)
                                        <option value="{{$league->id}}">{{ $league->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="">Team 1</label>
                                    <select class="form-control" name="team1_id">
                                        @foreach($teams as $team)
                                            <option value="{{$team->id}}">{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Team 1 Score</label>
                                    <input type="number" name="team1_score" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="">Team 2</label>
                                    <select class="form-control" name="team2_id">
                                        @foreach($teams as $team)
                                            <option value="{{$team->id}}">{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Team 2 Score</label>
                                    <input type="number" name="team2_score" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="">Stadium</label>
                                    <select class="form-control" name="stadium_id">
                                        @foreach($stadiums as $stadium)
                                            <option value="{{$stadium->id}}">{{ $stadium->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Time</label>
                                    <input type="datetime-local" name="time" class="form-control">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
