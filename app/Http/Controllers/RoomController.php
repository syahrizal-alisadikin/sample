<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rooms = \App\Models\Room::paginate(10);
        $filterKeyword = $request->get('name');
        if ($filterKeyword) {
            $rooms = \App\Models\Room::where(
                "name",
                "LIKE",
                "%$filterKeyword%"
            )->paginate(10);
        }
        return view('rooms.index', ['rooms' => $rooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('rooms.create');
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
        $description = $request->get('description');

        $new_room = new \App\Models\Room;
        $new_room->name = $name;
        $new_room->description = $description;

        // $new_room = new \App\Models\Room;
        // $new_room->name = $request->get('name');
        // $new_room->description = $request->get('description');

        $new_room->created_by = Auth::user()->id;
        $new_room->save();
        return redirect()->route('rooms.create')->with(
            'status',
            'Data Kelas berhasil ditambah'
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
        $room = \App\Models\Room::findOrFail($id);
        return view('rooms.edit', ['room' => $room]);
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
        $room = \App\Models\Room::findOrFail($id);
        $room->name = $request->get('name');
        $room->description = $request->get('description');
        $room->save();
        return redirect()->route('rooms.edit', [$id])->with('status', 'Data Kelas berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = \App\Models\Room::findOrFail($id);
        $room->delete();
        return redirect()->route('rooms.index')->with('status', 'Data Kelas berhasil Dihapus');
    }
}
