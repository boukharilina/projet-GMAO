<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Contrat;
use App\Mail\test;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */ 
    protected $commands = [
<<<<<<< HEAD
        Commands\SendEmails::class,
=======
        Commands\SendContractExpirationReminder::class,
>>>>>>> 47b76151798c524b609dda64e1386535604792a0
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
<<<<<<< HEAD
        $schedule->command('emails:send')->weeklyOn(2, '12:19');
=======
        // $schedule->command('inspire')->hourly();
        $schedule->command('contrat:reminder')->daily();
        
>>>>>>> 47b76151798c524b609dda64e1386535604792a0
    }


    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
