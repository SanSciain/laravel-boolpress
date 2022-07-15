<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPostNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $new_post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($new_post)
    {
        $this->new_post = $new_post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $new_post = $this->new_post;
        return $this->view('mails.new-post-notification', compact('new_post'));
    }
}
