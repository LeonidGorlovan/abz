@extends('layout')

@section('content')
    <div class="row">
        <div class="col-12 mb-3  text-center">
            <a href="{{ route('user.create') }}" class="btn btn-primary">Create new user</a>
        </div>

        <div class="col-12 mb-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Position</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><a href="{{ route('user.view', ['id' => $user->id, 'page' => request('page')]) }}">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ data_get($user, 'additionally.phone') }}</td>
                        <td>{{ data_get($user, 'position.title') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-12 text-center">
            <a href="{{ route('user.all', ['page' => $page]) }}" class="btn btn-success">Show more</a>
        </div>
    </div>
@endsection
