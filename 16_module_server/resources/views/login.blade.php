@extends('lay.app')

@section('main')
    <div class="d-flex justify-content-center align-items-center">
        <div class="card mt-5">
            <div class="card-body" style="width:20em">
                <div class="text-center">Login</div>
                <form action="/postLogin" method="post">
                @csrf
                <div class="form-group mt-2">
                    <div class="form-group">
                    <label >Username</label>
                    <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group mt-2">
                    <label >Password</label>
                    <input type="text" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Login</button>
                    <a href="/register" class="btn btn-primary mt-2">Register</a>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection