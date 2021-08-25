@extends('lay.app')

@section('main')
    <div class="d-flex justify-content-center align-items-center">
        <div class="card mt-5">
            <div class="card-body" style="width:20em">
                <div class="text-center">Change Password</div>
                <form action="/postChangePassword" method="post">
                @csrf
                <div class="form-group mt-2">
                    <div class="form-group">
                    <label >Old Password</label>
                    <input type="text" class="form-control" name="old_password" required>
                    </div>
                    <div class="form-group mt-2">
                    <label >New Password</label>
                    <input type="text" class="form-control" name="new_password" required>
                    </div>
                    <div class="form-group mt-2">
                    <label >Confirm Password</label>
                    <input type="text" class="form-control" name="conf_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Change Password</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection