<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class StudentController extends Controller
{
    public function student_profile($student_id)
    {
        $student = User::whereId($student_id)->first();
        // dd($student);
        return Inertia::render('Student/StudentProfile',[
            'student' => $student,
        ]);
    }


    public function show_room($id)
    {
        $room = Room::with([
            'teacher',
            'lessons' => function ($query) {
                $query->orderBy('id', 'desc');
            }
        ])->whereId($id)->first();
            // dd($room);
        return Inertia::render('Student/StudentRoom',[
            'room' => $room,
        ]);
    }

    public function student_room($id)
    {
        $student = Auth::user()->id;
        $room_enroll = Room::find($id);

        if ($room_enroll->students->contains($student)) {
            $room = Room::with([
                'teacher',
                'lessons' => function ($query) {
                    $query->orderBy('id', 'desc');
                }
            ])->whereId($id)->first();
                // dd($room);
            return Inertia::render('Student/StudentRoom',[
                'room' => $room,
            ]);
        }
        return redirect()->back();


    }

    public function show_lesson($lesson_id)
    {

        $lesson = Lesson::whereId($lesson_id)->first();
        return Inertia::render('Student/ShowLesson',[
            'lesson' => $lesson,
        ]);
    }

    public function download($id)
    {
        $lesson = Lesson::whereId($id)->first();
        $file_name = $lesson->file;
        return response()->download(storage_path("app/{$file_name}"));
    }

    public function my_class()
    {
        Auth::user()->load('student_classes');

            return Inertia::render('Student/MyClasses');
    }


}
