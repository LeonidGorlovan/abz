@extends('layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 mb-5 text-center">
            <a href="{{ route('user.all', ['page' => request('page', 1)]) }}" class="btn btn-primary">Return</a>
        </div>

        <div class="col-4">
            <p><b>Name:</b> {{ $user->name }}</p>
            <p><b>Email:</b> {{ $user->email }}</p>
            <p><b>Phone:</b> {{ data_get($user, 'additionally.phone') }}</p>
            <p><b>Position:</b> {{ data_get($user, 'position.title') }}</p>
        </div>

        <div class="col-4">
            <img src="{{ asset('storage/photo/' . data_get($user, 'additionally.photo')) }}" alt="Photo of {{ $user->name }}">
        </div>
    </div>
@endsection
