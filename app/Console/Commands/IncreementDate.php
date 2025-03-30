<?php

namespace App\Console\Commands;

use App\Models\ScheduledClass;
use Illuminate\Console\Command;

class IncreementDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:increement-date {--days=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increement all the scheduled classes date.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $scheduledClasses = ScheduledClass::latest('date_time')->get();
        $scheduledClasses->each(function ($class) {
            $class->date_time = $class->date_time->addDays($this->option('days'));
            $class->save();
        });
    }
}
