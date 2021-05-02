<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TeacherController extends Controller
{
    public function teacher_profile($teacher_id)
    {
        $teacher = User::whereId($teacher_id)->first();
        // dd($teacher);
        return Inertia::render('Teacher/TeacherProfile',[
            'teacher' => $teacher,
        ]);
    }


    public function create()
    {

        return Inertia::render('Teacher/CreateRoom');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|string',
        ]);

        $data['name']              = $request->name;
        $data['description']       = $request->description;
        $data['teacher_id']        = Auth::user()->id;

        Room::create($data);

        return redirect(route('dashboard'));

    }

    public function detiles($id)
    {


        $room = Room::with([
            'teacher',
            'lessons',
            'students' => function ($query) {
                $query->orderBy('id', 'desc');
            }
        ])->whereId($id)->first();
            // dd($room);
        return Inertia::render('Teacher/ShowRoom',[
            'room' => $room,
        ]);
    }

    public function show_students($id)
    {
        $all_students = User::whereRole(0)->get();
        $room = Room::whereId($id)->with([
            'students.mark' => function ($query) use ($id) {
                $query->where('room_id', $id);
            }
        ])->first();
        return Inertia::render('Teacher/ShowStudents',[
            'room' => $room,
            'all_students' => $all_students,

        ]);
    }



    public function add_student(Request $request, $room_id)
    {
        $student_id = $request->student_id;
        $student = User::whereId($student_id)->firstOrFail();
        $room_enroll = Room::find($room_id);

        if (!$room_enroll->students->contains($student)) {
            $room_enroll->students()->attach($student);
        }

        $data['first'] = null;
        $data['mid'] = null;
        $data['final'] = null;
        $data['room_id'] = $room_id;
        $data['student_id'] = $student_id;
        Mark::create($data);

        return Redirect::route('students.show', $room_id);
    }
}
