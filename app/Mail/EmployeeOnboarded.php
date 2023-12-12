<?php

namespace App\Mail;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmployeeOnboarded extends Mailable
{
    use Queueable, SerializesModels;

    public $firstName;
    public $url;
    public $companyName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $firstName, Tenant $tenant)
    {
        $this->firstName = $firstName;
        $this->url = $tenant->domain;
        $this->companyName = strtoupper($tenant->company);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Welcome to ' . $this->companyName . '!',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.company.employee.onboarding',
            with: [
                'firstName' => $this->firstName,
                'url' => $this->url,
                'companyName' => $this->companyName,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
