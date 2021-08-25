<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index() {
        $divisions = Division::all();

        return view('division.index', ['divisions' => $divisions]);
    }

    public function store(Request $request) {
        Division::create([
            'name' => $request->name
        ]);

        return redirect('/division');
    }

    public function edit($division_id) {
        $divisions = Division::where('id', $division_id)->get();
        
        return view('division.edit', ['divisions' => $divisions]);
    }

    public function update(Request $request, $division_id) {
        $division = Division::find($division_id);
        $division->name = $request->name;
        $division->save();

        return redirect('/division');
    }

    public function delete($division_id) {
        Division::find($division_id)->delete();

        return redirect('/division');
    }
}
