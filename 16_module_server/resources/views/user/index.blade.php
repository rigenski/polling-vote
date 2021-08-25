@extends('lay.app')

@section('main')
<div class="navbar bg-primary">
    <div class="container">
        <a class="navbar-brand text-white" href="/">
            Yuk Pilih
        </a>
        <div class="d-flex">
            <a href="/user" class="btn btn-warning mx-2">User</a>
            <a href="/division" class="btn btn-warning mx-2">Division</a>
            <a href="/suggest" class="btn btn-warning mx-2">Suggest Poll</a>
            <a href="/logout" class="btn btn-danger mx-2">Logout</a>
        </div>
    </div>
</div>

<div class="content mt-5">
    <div class="container">
        <div class="btn btn-success" onclick="showForm()">+</div>
        <div class="mt-4" id="form-poll" style="display: none">
                <div class="card">
                    <div class="card-body">
                        <form action="/user/store" method="post">
                            @csrf
                            <div class="form-group mt-2">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group mt-2">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="form-group mt-2">
                            <label>Role</label>
                            <select name="role" class="form-control" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                            </div>
                            <div class="form-group mt-2">
                            <label>Division</label>
                    <select name="division" class="form-control" required>
                    @foreach($divisions as $division)
                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                    @endforeach
                    </select>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="/" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
    </div>
    <div class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>
                        <a href="/user/{{ $user->id }}" class="btn btn-warning">Edit</a>
                        <a href="/user/{{ $user->id }}/delete"  class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>