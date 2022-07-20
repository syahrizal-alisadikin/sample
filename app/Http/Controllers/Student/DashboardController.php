<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Auth;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard');
    }

    public function friend()
    {
        if (request()->ajax()) {
            $friend = Student::where('room_id', Auth::user()->student->room_id)->where('id', "!=", Auth::user()->student->id)->with('user');

            return DataTables::of($friend)
                ->make();
        }
        return view('pages.friend');
    }
}
