<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FindPwMail extends Mailable
{
    use Queueable, SerializesModels;

    public $memberName;
    public $tempPassword;

    /**
     * Create a new message instance.
     */
    public function __construct($memberName, $tempPassword)
    {
        $this->memberName = $memberName;
        $this->tempPassword = $tempPassword;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '하늘누리 추모공원 임시 비밀번호 안내',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.find_pw',
            with: [
                'memberName' => $this->memberName,
                'tempPassword' => $this->tempPassword,
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
