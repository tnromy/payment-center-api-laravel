<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailConfig;
use App\Mail\MailProvider;

class ProcessMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
           public $configId,
           public $from,
        public $replyTo,
        public $to,
        public $subject,
        public $template,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
           $config = EmailConfig::find($this->configId);

        \Config::set('mail.mailers.dynamics' . $this->configId, [
            'transport' => $config->transport,
            'host' => $config->host,
            'port' => $config->port,
            'encryption' => $config->env,
            'username' => $config->username,
            'password' => $config->password,
            'timeout' => null,
        ]);

           $mail = new MailProvider(
                    mailFrom: $this->from,
                    mailReplyTo: $this->replyTo,
                    subject: $this->subject,
                    template: $this->template,
                );

        \Mail::mailer('dynamics' . $this->configId)->to($this->to)->send($mail);
    }
}
