<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('student')) {

            $rooms = Room::all();
            return Inertia::render('Student/StudentDashboard',[
                'rooms' => $rooms,
            ]);

        }elseif(Auth::user()->hasRole('teacher')) {

            $rooms = Room::all();
            return Inertia::render('Teacher/TeacherDashboard',[
                'rooms' => $rooms,
            ]);

        }elseif(Auth::user()->hasRole('admin')) {

            $rooms = Room::all();
            return Inertia::render('Admin/AdminDashboard',[
                'rooms' => $rooms,
            ]);
        }
    }
}
