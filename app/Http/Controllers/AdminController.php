<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{

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
        return Inertia::render('Admin/ShowRoom',[
            'room' => $room,
        ]);
    }

    public function show_students($id)
    {
        $room = Room::whereId($id)->with([
            'students.mark' => function ($query) use ($id) {
                $query->where('room_id', $id);
            }
        ])->first();
        return Inertia::render('Admin/ShowStudents',[
            'room' => $room,

        ]);
    }


    public function room_lesson($lesson_id)
    {

        $lesson = Lesson::whereId($lesson_id)->first();
        return Inertia::render('Admin/ShowLesson',[
            'lesson' => $lesson,
        ]);
    }

    public function file_download($id)
    {
        $lesson = Lesson::whereId($id)->first();
        $file_name = $lesson->file;
        return response()->download(storage_path("app/{$file_name}"));
    }

    public function all_users()
    {
        $users = User::all();

        return Inertia::render('Admin/AllUsers',[
            'users' => $users,
        ]);
    }
}
