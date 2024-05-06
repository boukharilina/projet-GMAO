<?php

namespace App\Console\Commands;

use App\Models\Contrat;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;

class SendContractExpirationReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contract:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails for contracts expiring in 60 days';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $contrats = Contrat::whereDate('date_fin', now()->addDays(60))->get();
        $adminUsers = User::whereHas('role', function ($query) {
            $query->where('name', 'administrateur');
        })->get();
        foreach ($adminUsers as $adminUser) {
            foreach ($adminUser->contrats as $contrat) {
                if ($contrat->date_fin->diffInDays(now()) === 60) {
                    // Send email logic
                    Mail::to($adminUser->email)->send(new \App\Mail\ContractExpirationReminder($contrat));        
                }
            }
        }
    }
}
