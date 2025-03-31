<?php

namespace App\Http\Controllers;

use App\Events\ClassCanceled;
use App\Models\ClassType;
use App\Models\ScheduledClass;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ScheduledClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $scheduledClasses = $request->user()->scheduledClasses()
            ->upcomming()
            ->with('classType')
            ->oldest('date_time')
            ->get();
        return Inertia::render('Instructor/Upcomming', [
            'scheduledClasses' => $scheduledClasses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Instructor/Schedule', [
            'classTypes' => ClassType::all(),
            'tomorrow' => date('Y-m-d', strtotime('tomorrow')),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date_time = $request->input('date') . ' ' . $request->input('time');
        $request->merge([
            'date_time' => $date_time,
            'instructor_id' => $request->user()->id,
        ]);

        $validated = $request->validate([
            'class_type_id' => 'required',
            'instructor_id' => 'required',
            'date_time' => 'required|unique:scheduled_classes|after:now'
        ]);

        ScheduledClass::create($validated);

        return redirect()->route('schedule.index')->with('success', 'Class scheduled successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ScheduledClass $schedule)
    {
        // if($request->user()->id !== $schedule->instructor_id){
        //     abort(403, 'Unauthorized action.');
        // }
        if ($request->user()->cannot('delete', $schedule)) {
            abort(403, 'Unauthorized action.');
        }
        ClassCanceled::dispatch($schedule);
        $schedule->members()->detach();
        $schedule->delete();


        return redirect()->back()->with('success', 'Class canceled successfully');
    }
}
