@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <a href="stadium/create" class="btn btn-primary mb-2">Create stadium</a>
                <br>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($stadiums as $stadium)
                        <tr>
                            <td>{{ $stadium->id }}</td>
                            <td>{{ $stadium->name }}</td>
                            <td class="text-center"><img height="40" src="{{ $stadium->image }}"></td>
                            <td>
                                <a href="stadiums/{{$stadium->id}}/edit" class="btn btn-primary">Edit</a>
                                <form action="stadiums/{{$stadium->id}}" method="post" class="d-inline">
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
