@extends('layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 mb-3 text-center">
            <a href="{{ route('user.all') }}" class="btn btn-primary">Return</a>
        </div>
        <div class="col-4">
            <form action="{{ route('user.save') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" aria-describedby="nameError" value="{{ old('name') }}">
                    @error('name')
                        <div id="nameError" class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email" class="form-control" aria-describedby="emailError" value="{{ old('email') }}">
                    @error('email')
                        <div id="emailError" class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" aria-describedby="phoneError" value="{{ old('phone') }}">
                    @error('phone')
                        <div id="phoneError" class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" aria-describedby="passwordError">
                    @error('password')
                        <div id="passwordError" class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="passwordConfirmation" class="form-label">Re.-Password</label>
                    <input type="password" name="password_confirmation" id="passwordConfirmation" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="position" class="form-label">Position</label>
                    <select class="form-select" name="position_id" aria-describedby="positionError">
                        @foreach($positions as $id => $position)
                            <option value="{{ $id }}"
                            @if(old('position') == $id) selected @endif
                            >{{ $position }}</option>
                        @endforeach
                    </select>
                    @error('position')
                        <div id="positionError" class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" name="photo" id="photo" aria-describedby="photoError" class="form-control">
                    @error('photo')
                        <div id="photoError" class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
