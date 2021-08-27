<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class notificationPost extends Mailable
{
    use Queueable, SerializesModels;
    public $title;

    public $body;
    public $slug;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title,$body,$slug)
    {
        //
        $this->title=$title;

        $this->body=$body;
        $this->slug=$slug;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('laravelblog7@gmail.com')->markdown('mail.notificationPost')->with(['title'=>$this->title,'body'=>$this->body,'url'=>env('APP_URL'),'slug'=>$this->slug])->subject("New Post Added");
    }
}

