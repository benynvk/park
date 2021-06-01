@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <a href="/match/create" class="btn btn-primary mb-2">Create match</a>
                <br>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>League</th>
                        <th>Team 1</th>
                        <th>Score</th>
                        <th>Team 2</th>
                        <th>Time</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($matches as $match)
                        <tr>
                            <td>{{ $match->league->name }}</td>
                            <td>{{ $match->team1->name }}</td>
                            <td class="text-center">{{ $match->team1_score }}:{{ $match->team2_score }}</td>
                            <td>{{ $match->team2->name }}</td>
                            <td>{{ date('H:i d/m/Y',strtotime($match->time)) }}</td>
                            <td class="text-center">
                                <a href="/match/{{$match->id}}" class="btn btn-success">View</a>
                                <a href="/match/{{$match->id}}/edit" class="btn btn-primary">Edit</a>
                                <form action="/match/{{$match->id}}" method="post" class="d-inline">
                                    {{ csrf_field() }}
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
