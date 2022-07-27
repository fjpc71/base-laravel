<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Routing\RouteUrlGenerator;
use App\Exceptions\MessageException;

class SendPaswordToken extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $name = "")
    {
      $this->name = $name;
      $this->url = url("password/token/" . $token);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("reset-password@admin.com")->view('mail.reset-password');
    }
}
