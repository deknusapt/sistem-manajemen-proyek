<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $project;

    /**
     * Create a new message instance.
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Project Status Updated')
                    ->view('emails.status_updated');
    }
}
