<?php

namespace App\Policies;

use App\Models\ScheduledClass;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;

class ScheduledClassPolicy
{
    public function delete(User $user, ScheduledClass $scheduledClass){
        return $user->id === $scheduledClass->instructor_id;
    }
}
