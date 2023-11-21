<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Attachment;
use App\Mail\InvoiceEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\SmtpTransport;


class SendInvoiceEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emailData;

    /**
     * Create a new job instance.
     *
     * @param  User  $user
     * @param  Payment  $payment
     * @return void
     */
    public function __construct(array $emailData)
    {
        $this->emailData = $emailData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
{
    $transport_factory = new \Symfony\Component\Mailer\Transport\Smtp\EsmtpTransportFactory;
    $transport = $transport_factory->create(new \Symfony\Component\Mailer\Transport\Dsn(
        'smtp',
        'mail.tspsolution.com',
        'support@tspsolution.com',
        'wy)w]Qj,PfOH',
        '465',
    ));

    $mailer = new \Symfony\Component\Mailer\Mailer($transport);
    $mail = new InvoiceEmail($this->emailData);

    $email = (new \Symfony\Component\Mime\Email())
        ->from('support@tspsolution.com')
        ->to($this->emailData['email'])
        ->subject('Syphonic mail testing')
        // ->text('Plain Text Content')
        ->cc('saqikhankmt@gmail.com')
        ->bcc('saqikhankmt@gmail.com')
        ->html($mail->render())
        ->replyTo(new Address('alisaqi@gmail.com', 'Ali saqi'));
        $email->attachFromPath($this->emailData['file']);

    $mailer->send($email);
}

}
