<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use App\Models\Student;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $students = Student::with('room', 'years')->paginate(10);


        //dd($students);
        return view('students.index', \compact('students'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $school_years = SchoolYear::all();
        $rooms = Room::all();
        return view('students.create', compact('school_years', 'rooms'));
        // $kelas = Room::get();
        // $tahun = SchoolYear::get();
        //dd($kelas);
        //return view('students.create', \compact('kelas', 'tahun'));

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
        // $students = Student::create([
        //     'name' => $request->name,
        //     'nisn' => $request->nisn,
        //     'address' => $request->address,
        //     'gender' => $request->gender,
        //     'room_id' => $request->room_id,
        //     'school_year_id' => $request->school_year_id,
        //     'created_by' => auth()->user()->id,
        // ]);
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'nisn' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'room_id' => ['required', 'integer'],
            'school_year_id' => ['required', 'integer'],
            'gender' => ["required"],
            'address' => ["required"]
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles' => "SISWA",
        ]);

        $student = Student::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'nisn' => $request->nisn,
            'room_id' => $request->room_id,
            'school_year_id' => $request->school_year_id,
            'gender' => $request->gender,
            'address' => $request->address,
            'created_by' => auth()->user()->id

        ]);

        return redirect()->route('students.create')->with(
            'status',
            'Data Siswa berhasil ditambah'
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
        $school_years = SchoolYear::all();
        $rooms = Room::all();
        $student = \App\Models\Student::findOrFail($id);
        $user = \App\Models\User::findOrFail($student->user_id);
        return view('students.edit', compact('school_years', 'rooms', 'student', 'user'));
        //return view('students.edit', ['student' => $student_edit]);
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
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'nisn' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'room_id' => ['required', 'integer'],
            'school_year_id' => ['required', 'integer'],
            'gender' => ["required"],
            'address' => ["required"],


        ]);
        $student = Student::findOrFail($id);
        $user = User::find($student->user_id);
        if ($request->input('password') == "") {
            $user->update([
                'name'          => $request->input('name'),
                //'username'          => $request->input('username'),
                'email'         => $request->input('email'),

            ]);
        } else {
            $user->update([
                'name'          => $request->input('name'),
                //'username'          => $request->input('username'),
                'email'         => $request->input('email'),
                'password'      => bcrypt($request->input('password'))
            ]);
        }
        $student->name = $request->input('name');
        $student->nisn = $request->input('nisn');
        $student->room_id = $request->input('room_id');
        $student->school_year_id = $request->input('school_year_id');
        $student->gender = $request->input('gender');
        $student->address = $request->input('address');
        $student->save();
        return redirect()->route('students.edit', [$id])->with('status', 'Data Siswa berhasil Diubah');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = \App\Models\Student::findOrFail($id);
        User::find($student->user_id)->delete();
        $student->delete();
        return redirect()->route('students.index')->with('status', 'Data Siswa berhasil Dihapus');
    }
}
