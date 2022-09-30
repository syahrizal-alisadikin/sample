<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $levels = Level::query();

            return DataTables::of($levels)
                ->addIndexColumn()
                // ->addColumn('actions', function ($transactions) {
                //     $button = " <a class='btn btn-primary text-white btn-sm' id='".$transactions->id."'>Ubah</a>";
                //     $button .= " <a class='btn btn-danger text-white btn-sm' id='".$transactions->id."'>Hapus</a>";
                //     return $button;
                // })
                ->addColumn('actions', function ($item) {
                    return '
                   <form  action="' . route('levels.destroy', $item->id) . '" method="POST">' . method_field('delete') . csrf_field() . '<button type="submit" class="btn btn-danger text-white btn-sm mr-2">Hapus</button><a class="btn btn-primary text-white btn-sm" type="hidden" href="' . route('levels.edit', $item->id) . '">Ubah</a>';
                })


                ->rawColumns(['actions'])

                ->make(true);
        }
        return view('levels.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("levels.create");
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

        $new_levels = new \App\Models\Level();
        $new_levels->name = $name;
        $new_levels->save();
        return redirect()->route('levels.index')->with(
            'status',
            'Data Tingkat berhasil ditambah'
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
        $level = \App\Models\Level::findOrFail($id);
        return view('levels.edit', ['level' => $level]);
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
        $level = \App\Models\Level::findOrFail($id);
        $level->name = $request->get('name');

        $level->save();
        return redirect()->route('levels.index', [$id])->with('status', 'Data Tingkat berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = \App\Models\Level::findOrFail($id);
        $level->delete();

        return redirect()->route('levels.index')->with('status', 'Data Tingkat Berhasil Dihapus');
    }
}
