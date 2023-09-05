<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionPurchased;

class SendSubscriptionPurchasedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $payment;

    /**
     * Create a new job instance.
     *
     * @param  User  $user
     * @param  Payment  $payment
     * @return void
     */
    public function __construct($user, $payment)
    {
        $this->user = $user;
        $this->payment = $payment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emailData = [
            'package_name' => $this->payment->package->title,
            'name' => $this->user->name,
            'body' => 'Congratulations! You have successfully subscribed to our package.',
        ];

        $mail = new SubscriptionPurchased($emailData);
        Mail::to($this->user->email)->send($mail);
    }
}
