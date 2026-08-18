<?php

namespace App\Mail;

use App\Models\ProjectRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewProjectRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public ProjectRequest $projectRequest;

    /**
     * Create a new message instance.
     */
    public function __construct(ProjectRequest $projectRequest)
    {
        $this->projectRequest = $projectRequest;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('درخواست پروژه جدید از ' . $this->projectRequest->name)
            ->replyTo($this->projectRequest->email, $this->projectRequest->name)
            ->view('emails.project-request');
    }
}
