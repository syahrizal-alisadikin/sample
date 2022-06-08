<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $costs = \App\Models\Cost::paginate(10);
        $filterKeyword = $request->get('name');
        if ($filterKeyword) {
            $costs = \App\Models\Cost::where(
                "name",
                "LIKE",
                "%$filterKeyword%"
            )->paginate(10);
        }
        return view('costs.index', ['costs' => $costs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('costs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->get('name');
        $nominal = $request->get('nominal');
        $description = $request->get('description');

        $new_cost = new \App\Models\Cost;
        $new_cost->name = $name;
        $new_cost->nominal = $nominal;
        $new_cost->description = $description;

        $new_cost->created_by = Auth::user()->id;
        $new_cost->save();
        return redirect()->route('costs.create')->with(
            'status',
            'Data Biaya berhasil ditambah'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cost = \App\Models\Cost::findOrFail($id);
        return view('costs.edit', ['cost' => $cost]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cost = \App\Models\Cost::findOrFail($id);
        $cost->name = $request->get('name');
        $cost->nominal = $request->get('nominal');
        $cost->description = $request->get('description');
        $cost->save();
        return redirect()->route('costs.edit', [$id])->with('status', 'Data Biaya berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cost = \App\Models\Cost::findOrFail($id);
        $cost->delete();
        return redirect()->route('costs.index')->with('status', 'Data Biaya berhasil Dihapus');
    }
}
