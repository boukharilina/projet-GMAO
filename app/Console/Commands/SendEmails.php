<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Contrat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SendEmails extends Command
{
    protected $signature = 'emails:send';
    protected $description = 'Send custom emails';

    public function __construct()
    {
        parent::__construct();
    }

    /*public function handle()
    {
        //$dateThreshold = Carbon::now()->addDays(14)->toDateString();
        //$contracts = Contrat::whereDate('date_fin', '=', $dateThreshold)->get();
        $dateNow = Carbon::now()->toDateString();
        $dateThreshold = Carbon::now()->addDays(39)->toDateString();
         // Fetch contracts expiring within the next 14 days
         $contracts = Contrat::whereBetween('date_fin', [$dateNow, $dateThreshold])->get();


        if ($contracts->isEmpty()) {
            Log::info('No contracts found expiring on ' . $dateThreshold);
            $this->info('No contracts found expiring in the next 41 days.');
            return;
        }

        foreach ($contracts as $contract) {
            $toEmail = 'nasfiwejden18@gmail.com';
            //$ccemail ='faouzi.bekri@stiet.com.tn';
            $subject = 'Notification de Fin Prochaine de Contrat de Maintenance';

            try {
                Mail::send([], [], function ($message) use ($toEmail, $subject, $contract) {
                    $body = '
                       <p>Le contrat de maintenance du client : '.$contract->client->name .' approche de son expiration le '.$contract->date_fin.'</p>
                        <p>Merci de prendre les mesures nécessaires pour assurer le suivi de ce dossier.</p>
                        <p>Cordialement,</p>
                        <p>GMAO</p>';

                    $message->to($toEmail)
                            //->cc($ccemail)
                            ->subject($subject)
                            ->setBody($body, 'text/html');
                });

                Log::info('Email sent to: ' . $toEmail);
            } catch (\Exception $e) {
                Log::error('Failed to send email to ' . $toEmail . ': ' . $e->getMessage());
            }
        }

        $this->info('Emails sent successfully!');
    }*/
    public function handle()
    {
        $dateNow = Carbon::now()->toDateString();

        $thresholds = [
            '60 days' => Carbon::now()->addDays(60)->toDateString(),
            '30 days' => Carbon::now()->addDays(30)->toDateString(),
            '8 days' => Carbon::now()->addDays(8)->toDateString()
        ];

        $toEmail = 'amine.yami@stiet.com.tn';
        $subject = 'Notification de Fin Prochaine de Contrat de Maintenance';

        foreach ($thresholds as $days => $dateThreshold) {
            $contracts = Contrat::whereBetween('date_fin', [$dateNow, $dateThreshold])->get();

            if ($contracts->isEmpty()) {
                Log::info("No contracts found expiring within $days.");
                continue;
            }

            foreach ($contracts as $contract) {
                try {
                     //$daysLeft = Carbon::now()->diffInDays($contract->date_fin);
                     $daysLeft = Carbon::now()->diffInDays($contract->date_fin);
                    Mail::send([], [], function ($message) use ($toEmail, $subject, $contract, $daysLeft) {
                        $body = '
                            <p>Le contrat de maintenance du client : ' . $contract->client->name . ' approche de son expiration le ' . $contract->date_fin . '.</p>
                            <p>Il reste ' . $daysLeft . ' pour l’expiration du contrat.</p>
                            <p>Merci de prendre les mesures nécessaires pour assurer le suivi de ce dossier.</p>
                            <p>Cordialement,</p>
                            <p>GMAO</p>';

                        $message->to($toEmail)
                                ->subject($subject)
                                ->setBody($body, 'text/html');
                    });

                    Log::info('Email sent to: ' . $toEmail . ' for contract expiring in ' . $days);
                } catch (\Exception $e) {
                    Log::error('Failed to send email to ' . $toEmail . ': ' . $e->getMessage());
                }
            }
        }

        $this->info('Emails sent successfully!');
    }


}
