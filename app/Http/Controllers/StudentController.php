<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\SchoolYear;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $students = Student::with(['rooms'])->paginate(10);
        // dd($students);


        return view('students.index', \compact('students'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $kelas = Room::get();
        $tahun = SchoolYear::get();
        //dd($kelas);
        return view('students.create', \compact('kelas', 'tahun'));

        // return view('students.create', \compact('tahun'));
        // dd($tahun);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $students = Student::create([
            'name' => $request->name,
            'nisn' => $request->nisn,
            'address' => $request->address,
            'gender' => $request->gender,
            'room_id' => $request->room_id,
            'school_year_id' => $request->school_year_id,
            'created_by' => auth()->user()->id,
        ]);

        return redirect()->route('students.create')->with(
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
