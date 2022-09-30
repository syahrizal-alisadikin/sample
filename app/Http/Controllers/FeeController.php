<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Level;
use App\Models\Rombel;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $fees = Fee::query();
            $fees->with('level', 'years')->get();

            return DataTables::of($fees)
                ->addIndexColumn()
                // ->addColumn('actions', function ($transactions) {
                //     $button = " <a class='btn btn-primary text-white btn-sm' id='".$transactions->id."'>Ubah</a>";
                //     $button .= " <a class='btn btn-danger text-white btn-sm' id='".$transactions->id."'>Hapus</a>";
                //     return $button;
                // })
                ->addColumn('actions', function ($item) {
                    return '
                   <form  action="' . route('fees.destroy', $item->id) . '" method="POST">' . method_field('delete') . csrf_field() . '<button type="submit" class="btn btn-danger text-white btn-sm mr-2">Hapus</button><a class="btn btn-primary text-white btn-sm" type="hidden" href="' . route('fees.edit', $item->id) . '">Ubah</a>';
                })


                ->rawColumns(['actions'])

                ->make(true);
        }
        return view('fees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::all();
        $years = SchoolYear::all();
        return view('fees.create', compact('levels', 'years'));
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
        $level_id = $request->get('level_id');
        $school_year_id = $request->get('school_year_id');

        $new_fees = new \App\Models\Fee();
        $new_fees->name = $name;
        $new_fees->nominal = $nominal;
        $new_fees->level_id = $level_id;
        $new_fees->school_year_id = $school_year_id;
        $new_fees->save();
        return redirect()->route('fees.index')->with(
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
        $levels = Level::all();
        $years = SchoolYear::all();
        $fee = \App\Models\Fee::findOrFail($id);
        return view('fees.edit', compact('fee', 'years', 'levels'));
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
        $fee = \App\Models\Fee::findOrFail($id);
        $fee->name = $request->get('name');
        $fee->nominal = $request->get('nominal');
        $fee->level_id = $request->get('level_id');
        $fee->school_year_id = $request->get('school_year_id');

        $fee->save();
        return redirect()->route('fees.index', [$id])->with('status', 'Data Biaya berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fee = \App\Models\Fee::findOrFail($id);
        $fee->delete();

        return redirect()->route('fees.index')->with('status', 'Data Biaya Berhasil Dihapus');
    }
}
