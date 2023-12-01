<?php

namespace App\Mail;

use App\Models\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InviteUser extends Mailable
{
    use Queueable, SerializesModels;

    public $fullName = '';
    public $inviter = '';
    public $organizationId = '';
    public $url = '';
    public $company = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invite $invite)
    {
        $this->company = strtoupper(tenant()->company);
        $this->fullName = $invite->first_name . ' ' . $invite->last_name;
        $this->inviter = $invite->inviter_email;
        $this->organizationId = tenant()->organization_id;
        $this->url = route('accept-invite', $invite->token);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'You were invited to the organization ' . $this->company . ' on Impak',
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
            markdown: 'mail.invite-user',
            with: [
                'fullName' => $this->fullName,
                'inviter' => $this->inviter,
                'company' => $this->company,
                'organizationId' => $this->organizationId,
                'url' => $this->url,
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
