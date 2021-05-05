<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MarkController extends Controller
{
    public function mark($id)
    {
        $teacher = Auth::user()->id;
        $room = Room::whereId($id)->with([
            'students' => function ($query) use ($id){
                $query->where('room_id', $id);
            }
        ])->whereTeacherId($teacher)->firstOrFail();

        return Inertia::render('Teacher/Marks',[
            'room' => $room,
            // 'stds' => $stds,
        ]);

    }

    public function mark_store(Request $request, $room_id)
    {

        $request->validate([
            'first' => 'nullable|numeric|min:0|max:30',
            'mid' => 'nullable|numeric|min:0|max:30',
            'final' => 'nullable|numeric|min:0|max:40',
        ]);

        if ($request->first) {
            $data['first']   = $request->first;
        }
        if ($request->mid) {
            $data['mid']       = $request->mid;
        }
        if ($request->final) {
            $data['final']        = $request->final;
        }


        $data['student_id']        = $request->student_id;
        $data['room_id'] = $room_id;
        $mark = Mark::whereStudentId($request->student_id)->whereRoomId($room_id)->first();
        if ($mark->first == null && $mark->mid == null && $mark->final == null) {
            $mark->update($data);
        }

        return Redirect::route('students.show', $room_id);
    }

    public function mark_edit($room_id, $std_id)
    {
        $student = User::whereId($std_id)->with([
            'mark' => function ($query) use ($room_id){
                $query->where('room_id', $room_id);
            }
        ])->firstOrFail();
        $teacher = Auth::user()->id;
        $room = Room::whereId($room_id)->with([
            'students' => function ($query) use ($room_id){
                $query->where('room_id', $room_id);
            }
        ])->whereTeacherId($teacher)->firstOrFail();

        return Inertia::render('Teacher/EditMarks',[
            'room' => $room,
            'student' => $student,
        ]);
    }

    public function mark_update(Request $request, $room_id, $std_id)
    {

        $request->validate([
            'first' => 'nullable|numeric|min:0|max:30',
            'mid' => 'nullable|numeric|min:0|max:30',
            'final' => 'nullable|numeric|min:0|max:40',
        ]);

        if ($request->first) {
            $data['first']   = $request->first;
        }
        if ($request->mid) {
            $data['mid']       = $request->mid;
        }
        if ($request->final) {
            $data['final']        = $request->final;
        }


        $data['student_id']        = $std_id;
        $data['room_id'] = $room_id;
        $mark = Mark::whereStudentId($std_id)->whereRoomId($room_id)->first();
        $mark->update($data);

        return Redirect::route('students.show', $room_id);
    }
}
