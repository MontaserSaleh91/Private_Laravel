<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class LessonController extends Controller
{
    public function lesson_create($room_id)
    {
        $teacher = Auth::user()->id;
        $room = Room::whereId($room_id)->whereTeacherId($teacher)->firstOrFail();
        if ($room->whereTeacherId($teacher)) {
            return Inertia::render('Teacher/CreateLesson',[
                'room' => $room,
            ]);
        }
        return Inertia::render('dashboard');


    }

    public function lesson_store(Request $request, $room_id)
    {

        $request->validate([
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string',
            'file' => 'mimes:pdf,ppt,pptx',
        ]);

        $name = time().'.'.$request->file('file')->getClientOriginalName();

        $path = $request->file('file')->store('public/files');



        $data['file'] = $path;
        $data['title'] = $request->title;
        $data['content'] = $request->content;
        $data['room_id'] = $room_id;
        Lesson::create($data);

        return redirect(route('dashboard'));
    }

    public function room_lesson($lesson_id)
    {

        $lesson = Lesson::whereId($lesson_id)->first();
        return Inertia::render('Teacher/ShowLesson',[
            'lesson' => $lesson,
        ]);
    }

    public function file_download($id)
    {
        $lesson = Lesson::whereId($id)->first();
        $file_name = $lesson->file;
        return response()->download(storage_path("app/{$file_name}"));
    }
}
