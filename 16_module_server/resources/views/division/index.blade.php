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
                        <form action="/division/store" method="post">
                            @csrf
                            <div class="form-group mt-2">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" required>
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
                @foreach($divisions as $division)
                <tr>
                    <td>{{$division->name}}</td>
                    <td>
                        <a href="/division/{{ $division->id }}" class="btn btn-warning">Edit</a>
                        <a href="/division/{{ $division->id }}/delete"  class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>