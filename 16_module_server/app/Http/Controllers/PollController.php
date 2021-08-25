<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Vote;
use App\Models\Choice;
use App\Models\Suggest;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::with(['choices', 'votes', 'creator'])->orderBy('created_at', 'DESC')->get();

        return view('index', ['polls' => $polls]);
    }

    public function store(Request $request) {
        $poll = Poll::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'created_by' => auth()->user()->id,
        ]);

        foreach ($request->choices as $choice) {
            Choice::create([
                'choice' => $choice,
                'poll_id' => $poll->id
            ]);
        }

        return redirect('/');
    }

    public function vote($poll_id, $choice_id)
    {
        Vote::create([
            'choice_id' => $choice_id,
            'user_id' => auth()->user()->id,
            'poll_id' => $poll_id,
            'division_id' => auth()->user()->division_id
        ]);

        return redirect('/');
    }

    public function delete($poll_id) {
        Choice::where('poll_id', $poll_id)->delete();
        Poll::find($poll_id)->delete();

        return redirect('/');
    }

    public function indexSuggest() {
        $suggests = Suggest::with(['creator'])->orderBy('created_at', 'DESC')->get();

        return view('suggest.index', ['suggest' => $suggests]);
    }

    public function storeSuggest(Request $request) {
        $suggest = Suggest::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'created_by' => auth()->user()->id,
        ]);

        return redirect('/suggest');
    }

    public function deleteSuggest($suggest_id) {
        Suggest::find($suggest_id)->delete();

        return redirect('/suggest');
    }

    public function edit($poll_id) {
        $polls = Poll::where('id', $poll_id)->get();
        
        return view('edit', ['polls' => $polls]);
    }

    public function update(Request $request, $poll_id) {

        return redirect('/poll');
    }
}
