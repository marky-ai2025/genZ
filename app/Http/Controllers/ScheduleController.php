<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function store(Request $request)
{
    $schedule = new Schedule();
    $schedule->requested_by = $request->input('requested_by');
    $schedule->description = $request->input('description');
    $schedule->start_time = $request->input('start_time');
    $schedule->end_time = $request->input('end_time');
    $schedule->status = 'Pending';
    $schedule->save();

    return response()->json(['success' => 'Schedule saved successfully!'], 201);
}

   
    public function index()
    {
        return view('admin.schedule');
    }

  
    public function fetchSchedules()
    {
        $schedules = Schedule::all();
        return response()->json($schedules, 200);
    }

   
    public function update(Request $request, $id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['error' => 'Schedule not found!'], 404);
        }

        $schedule->requested_by = $request->input('requested_by');
        $schedule->description = $request->input('description');
        $schedule->start_time = $request->input('start_time');
        $schedule->end_time = $request->input('end_time');
        $schedule->date = $request->input('date');
        $schedule->status = $request->input('status');
        $schedule->save();

        return response()->json(['success' => 'Schedule updated successfully!'], 200);
    }

    public function destroy($id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['error' => 'Schedule not found.'], 404);
        }

        $schedule->delete();
        return response()->json(['success' => 'Request close successfully.'], 200);
    }

    public function approveRequest($id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['error' => 'Request not found.'], 404);
        }

        $schedule->status = 'Approved';
        $schedule->save();

        return response()->json(['success' => 'Request approved successfully!', 'schedule' => $schedule], 200);
    }

    public function fetchApprovedRequests()
    {
        $approvedSchedules = Schedule::where('status', 'Approved')->get();
        return response()->json($approvedSchedules, 200);
    }
}
