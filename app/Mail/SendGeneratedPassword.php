<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendGeneratedPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $password;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $password, $url)
    {
        $this->name = $name;
        $this->password = $password;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("send-password@admin.com")->view('mail.send-password');
    }
}
