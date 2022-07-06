<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user', 'room', 'years')->paginate(10);

        return view('students.index', compact('students'));
    }
}
