<?php

namespace App\Http\Controllers;

use App\Models\ScheduledClass;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function create()
    {
        $scheduledClasses = ScheduledClass::upcomming()
            ->oldest('date_time')
            ->with('classType')
            ->with('instructor')
            ->notBooked()
            ->get();
        return Inertia::render('Member/Book', [
            'scheduledClasses' => $scheduledClasses,
        ]);
    }
    public function store(Request $request)
    {
        $request->user()->bookings()->attach($request->scheduled_class_id);
        return redirect()->route('booking.index')->with('success', 'Booking created successfully.');
    }
    public function index(Request $request)
    {
        $bookings = $request->user()->bookings()
            ->with('classType')
            ->with('instructor')
            ->get();
        return Inertia::render('Member/Upcomming', [
            'bookings' => $bookings,
        ]);
    }
    public function destroy(Request $request, int $id)
    {
        $request->user()->bookings()->detach($id);
        return redirect()->back()->with('success', 'Booking canceled successfully');
    }
}
