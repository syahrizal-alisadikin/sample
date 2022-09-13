<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SchoolYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $years = \App\Models\SchoolYear::paginate(10);
        // $filterKeyword = $request->get('year');
        // if ($filterKeyword) {
        //     $years = \App\Models\SchoolYear::where(
        //         "year",
        //         "LIKE",
        //         "%$filterKeyword%"
        //     )->paginate(10);
        // }
        // return view('school-years.index', ['years' => $years]);
        if (request()->ajax()) {

            $years = SchoolYear::query();

            return DataTables::of($years)
                ->addIndexColumn()

                ->addColumn('actions', function ($item) {
                    return '
                   <form  action="' . route('school-years.destroy', $item->id) . '" method="POST">' . method_field('delete') . csrf_field() . '<button type="submit" class="btn btn-danger dropdown-item text-white">Hapus</button><a class="btn btn-primary text-white btn-sm" type="hidden" href="' . route('school-years.edit', $item->id) . '">Ubah</a>';
                })


                ->rawColumns(['actions'])

                ->make(true);
        }
        return view('school-years.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (\view('school-years.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $year = $request->get('year');
        $description = $request->get('description');

        $new_year = new \App\Models\SchoolYear();
        $new_year->year = $year;
        $new_year->description = $description;

        $new_year->created_by = Auth::user()->id;
        $new_year->save();
        return redirect()->route('school-years.index')->with(
            'status',
            'Data Tahun berhasil ditambah'
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
        $year = \App\Models\SchoolYear::findOrFail($id);
        return \view('school-years.edit', ['year' => $year]);
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
        $year = \App\Models\SchoolYear::findOrFail($id);
        $year->year = $request->get('year');
        $year->description = $request->get('description');
        $year->save();
        return redirect()->route('school-years.index', [$id])->with('status', 'Data Tahun berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $year = \App\Models\SchoolYear::findOrFail($id);
        $year->delete();
        return redirect()->route('school-years.index')->with('status', 'Data Tahun berhasil Dihapus');
    }
}
