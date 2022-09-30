<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Rombel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $rombels = Rombel::query();
            $rombels->with('level')->get();

            return DataTables::of($rombels)
                ->addIndexColumn()
                // ->addColumn('actions', function ($transactions) {
                //     $button = " <a class='btn btn-primary text-white btn-sm' id='".$transactions->id."'>Ubah</a>";
                //     $button .= " <a class='btn btn-danger text-white btn-sm' id='".$transactions->id."'>Hapus</a>";
                //     return $button;
                // })
                ->addColumn('kelas', function (Rombel $rombel) {
                    return $rombel->level->name . $rombel->name;
                })
                ->addColumn('actions', function ($item) {
                    return '
                   <form  action="' . route('rombels.destroy', $item->id) . '" method="POST">' . method_field('delete') . csrf_field() . '<button type="submit" class="btn btn-danger text-white btn-sm mr-2">Hapus</button><a class="btn btn-primary text-white btn-sm" type="hidden" href="' . route('rombels.edit', $item->id) . '">Ubah</a>';
                })



                ->rawColumns(['actions'])

                ->make(true);
        }
        return view('rombels.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::all();
        return view('rombels.create', compact('levels'));
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
        $level_id = $request->get('level_id');

        $new_rombels = new \App\Models\Rombel();
        $new_rombels->name = $name;
        $new_rombels->level_id = $level_id;
        $new_rombels->save();
        return redirect()->route('rombels.index')->with(
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
        $levels = Level::all();
        $rombel = \App\Models\Rombel::findOrFail($id);
        return view('rombels.edit', compact('rombel', 'levels'));
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
        $rombel = \App\Models\Rombel::findOrFail($id);
        $rombel->name = $request->get('name');
        $rombel->level_id = $request->get('level_id');

        $rombel->save();
        return redirect()->route('rombels.index', [$id])->with('status', 'Data Kelas berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rombel = \App\Models\Rombel::findOrFail($id);
        $rombel->delete();

        return redirect()->route('rombels.index')->with('status', 'Data Kelas Berhasil Dihapus');
    }
}
