<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FindIdMail extends Mailable
{
    use Queueable, SerializesModels;

    public $memberName;
    public $userId;

    /**
     * Create a new message instance.
     */
    public function __construct($memberName, $userId)
    {
        $this->memberName = $memberName;
        $this->userId = $userId;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '하늘누리 추모공원 아이디 안내',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.find_id',
            with: [
                'memberName' => $this->memberName,
                'userId' => $this->userId,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
