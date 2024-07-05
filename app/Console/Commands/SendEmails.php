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

    public function handle()
    {
        $dateNow = Carbon::now()->toDateString();

        $thresholds = [
            '60 days' => Carbon::now()->addDays(60)->toDateString(),
            '30 days' => Carbon::now()->addDays(30)->toDateString(),
            '8 days' => Carbon::now()->addDays(8)->toDateString()
        ];

        $toEmail = 'faouzi.bekri@stiet.com.tn';
        $subject = 'Notification de Fin Prochaine de Contrat de Maintenance';
        $files = [
            // public_path('attachments/test_image.jpeg'),
            // public_path('C:\xampp\htdocs\stage\projet-GMAO-master\public\Storage\Catalog_ESE.pdf'),
            // Absolute path to the file
            'C:\xampp\htdocs\projet-GMAO\public\storage\lettre.docx',
        ];

        // Array to keep track of already processed contracts
        $processedContracts = [];

        foreach ($thresholds as $days => $dateThreshold) {
            $contracts = Contrat::whereBetween('date_fin', [$dateNow, $dateThreshold])->get();

            if ($contracts->isEmpty()) {
                Log::info("No contracts found expiring within $days.");
                continue;
            }

            foreach ($contracts as $contract) {
                // Skip contracts that have already been processed
                if (in_array($contract->id, $processedContracts)) {
                    continue;
                }

                try {
                    $daysLeft = Carbon::now()->diffInDays($contract->date_fin);
                    Mail::send([], [], function ($message) use ($toEmail, $subject, $contract, $daysLeft, $files) {
                        $body = '
                            <p>Le contrat de maintenance du client : ' . $contract->client->name . ' approche de son expiration le ' . $contract->date_fin . '.</p>
                            <p>Il reste ' . $daysLeft . ' pour l’expiration du contrat.</p>
                            <p>Merci de prendre les mesures nécessaires pour assurer le suivi de ce dossier.</p>
                            <p>Ci-joint, vous trouverez le modèle de lettre à envoyer pour le client.</p>
                            <p>Cordialement,</p>
                            <p>GMAO</p>';

                        $message->to($toEmail)
                                ->subject($subject)
                                ->setBody($body, 'text/html');

                        try {
                            foreach ($files as $file) {
                                $message->attach($file);
                            }
                        } catch (\Exception $e) {
                            Log::error('Failed to attach file: ' . $e->getMessage());
                            print('Failed to attach file');
                        }
                    });

                    Log::info('Email sent to: ' . $toEmail . ' for contract expiring in ' . $days);

                    // Mark contract as processed
                    $processedContracts[] = $contract->id;
                } catch (\Exception $e) {
                    Log::error('Failed to send email to ' . $toEmail . ': ' . $e->getMessage());
                    print('Failed to send email to');
                }
            }
        }

        $this->info('Emails sent successfully!');
    }
}
