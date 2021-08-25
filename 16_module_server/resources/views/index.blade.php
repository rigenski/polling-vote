@extends('lay.app')

@section('main')
<div class="navbar bg-primary">
    <div class="container">
        <div class="navbar-brand text-white">Yuk Pilih</div>
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
    @if(auth()->user()->role == 'admin')
        <div class="btn btn-success" onclick="showForm()">+</div>
        <div class="mt-4" id="form-poll" style="display: none">
                <div class="card">
                    <div class="card-body">
                        <form action="/poll" method="post">
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
                            <div class="form-group mt-2">
                                <label>Choice</label>
                                <div class="copy after">
                                    <input type="text" class="form-control mt-2" name="choices[]" required>
                                </div>
                                <div class="add btn btn-success mt-2">Add Choice</div>
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
        @foreach($polls as $poll)
                <div class="card mt-4">
                    <div class="card-body">
                        @if(auth()->user()->role == 'admin')
                        <a href="/poll/{{$poll->id}}/edit" class="text-warning"><b>Edit</b></a>
                        <a href="/poll/{{$poll->id}}/delete" class="text-danger"><b>Delete</b></a>
                        @endif
                        <h4>{{$poll->title}} </h4>    
                        Deadline :  <b>{{date('d-m-Y h:i A', strtotime($poll->deadline))}}</b></small>
                        <p>{{ $poll->description }}</p>
                        <div class="choice row">
                            @if(date('d-m-Y h:i A', strtotime($poll->deadline)) >= date('d-m-Y h:i A') && auth()->user()->role == 'user')
                            <div class="col-md-4">
                                @if(!$poll->votes->where('user_id', auth()->user()->id)->count())
                                @foreach($poll->choices as $choice)
                                <a href="/poll/{{$poll->id}}/vote/{{$choice->id}}" class="btn btn-primary d-block mt-2">{{$choice->choice}}</a>
                                @endforeach
                                @endif
                            </div>
                            @endif
                            @if(date('d-m-Y h:i A', strtotime($poll->deadline)) <= date('d-m-Y h:i A') || auth()->user()->role == 'admin')
                            <div class="col-md-8 row">
                                @foreach($poll->choices as $choice)
                                <div class="col-4 my-auto">
                                    {{ $choice->choice }} 
                                    | 
                                    @if($poll->votes->count())
                                    {{substr($poll->votes->where('choice_id', $choice->id)->count() * 100 / $poll->votes->count(), 0, 5)}}%
                                    @else
                                    0%
                                    @endif
                                    
                                </div>  
                                <div class="col-8 my-auto">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width:@if($poll->votes->count())
                                            {{substr($poll->votes->where('choice_id', $choice->id)->count() * 100 / $poll->votes->count(), 0, 5)}}%
                                            @else
                                            0%
                                            @endif"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
    </div>

</div>