@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <a href="league/create" class="btn btn-primary mb-2">Create league</a>
                <br>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Year</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($leagues as $league)
                        <tr>
                            <td>{{ $league->id }}</td>
                            <td>{{ $league->name }}</td>
                            <td class="text-center"><img height="40" src="{{ $league->image }}"></td>
                            <td>{{ $league->year }}</td>
                            <td>
                                <a href="leagues/{{$league->id}}/edit" class="btn btn-primary">Edit</a>
                                <form action="leagues/{{$league->id}}" method="post" class="d-inline">
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
