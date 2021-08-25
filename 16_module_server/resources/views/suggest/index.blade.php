@extends('lay.app')

@section('main')
<div class="navbar bg-primary">
    <div class="container">
        <a class="navbar-brand text-white" href="/">Yuk Pilih</a>
        <div class="d-flex">
        @if(auth()->user()->role == 'admin')
            <a href="/user" class="btn btn-warning mx-2">User</a>
            <a href="/division" class="btn btn-warning mx-2">Division</a>
            @endif
            <a href="/suggest" class="btn btn-warning mx-2">Suggest Poll</a>
            <a href="/logout" class="btn btn-danger mx-2">Logout</a>
        </div>
    </div>
</div>

<div class="content mt-5">
    <div class="container">
    @if(auth()->user()->role == 'user')
        <div class="btn btn-success" onclick="showForm()">+</div>
        <div class="mt-4" id="form-poll" style="display: none">
                <div class="card">
                    <div class="card-body">
                        <form action="/suggest/store" method="post">
                            @csrf
                            <div class="form-group mt-2">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                            <div class="form-group mt-2">
                                <label>Description</label>
                                <input type="text" class="form-control" name="description" required>
                            </div>
                            <div class="form-group mt-2">
                                <label>Deadline</label>
                                <input type="datetime-local" class="form-control" name="deadline" required>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="/" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
        @endif
        @foreach($suggest as $suggest)
                <div class="card mt-4">
                    <div class="card-body">
                        @if(auth()->user()->role == 'user')
                        <a href="/suggest/{{$suggest->id}}/" class="text-warning"><b>Edit</b></a>
                        <a href="/suggest/{{$suggest->id}}/delete" class="text-danger"><b>Delete</b></a>
                        @endif
                        <h4>{{$suggest->title}} </h4>    
                        Date :  <b>{{date('d-m-Y h:i A', strtotime($suggest->date))}}</b></small>
                        <p>{{ $suggest->description }}</p>
                    </div>
                </div>
                @endforeach
    </div>

</div>