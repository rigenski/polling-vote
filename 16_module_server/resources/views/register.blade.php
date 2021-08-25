@extends('lay.app')

@section('main')
    <div class="d-flex justify-content-center align-items-center">
        <div class="card mt-5">
            <div class="card-body" style="width:20em">
                <div class="text-center">Register</div>
                <form action="/postRegister" method="post">
                @csrf
                <div class="form-group mt-2">
                    <div class="form-group">
                    <label >Name</label>
                    <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                    <label >Username</label>
                    <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group mt-2">
                    <label >Division</label>
                    <select name="division" class="form-control" required>
                    @foreach($divisions as $division)
                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                    @endforeach
                    </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Register</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection