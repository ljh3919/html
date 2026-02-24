<?php

namespace App\Mail\Transport;

use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\MessageConverter;

class PhpMailTransport extends AbstractTransport
{
    /**
     * Get the string representation of the transport.
     */
    public function __toString(): string
    {
        return 'php_mail';
    }

    /**
     * Send the given message.
     */
    protected function doSend(SentMessage $message): void
    {
        $email = MessageConverter::toEmail($message->getOriginalMessage());
        
        $to = implode(', ', array_map(fn($recipient) => $recipient->getAddress(), $email->getTo()));
        
        // 제목 (UTF-8 인코딩 명시)
        $subject = '=?UTF-8?B?' . base64_encode($email->getSubject()) . '?=';
        
        // 메일 본문
        $body = $email->getHtmlBody() ?: $email->getTextBody();
        $contentType = $email->getHtmlBody() ? 'text/html' : 'text/plain';
        
        // 발신자 주소 (Dothome 환경에서는 계정명과 일치하는 메일 주소를 사용하는 것이 필수적일 수 있음)
        $from = $email->getFrom();
        $senderAddress = !empty($from) ? $from[0]->getAddress() : config('mail.from.address');
        
        // 가장 안정적인 최소한의 헤더 구성
        $headers = [];
        // $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: $contentType; charset=utf-8";
        $headers[] = "From: $senderAddress";
        $headers[] = "Reply-To: $senderAddress";

        $headerString = implode("\n", $headers);

        // 발송 시도
        if (!mail($to, $subject, $body, $headerString)) {
            \Log::error("PHP mail() failed to $to");
            throw new \RuntimeException('PHP mail() 함수를 통한 메일 발송에 실패했습니다.');
        }
    }
}
