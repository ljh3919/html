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
        $subject = $email->getSubject();
        
        // 메일 본문 추출 (HTML 우선, 없으면 Text)
        $body = $email->getHtmlBody() ?: $email->getTextBody();
        
        // 헤더 문자열 생성
        $headers = $email->getHeaders()->toString();

        // PHP 내장 mail() 함수 호출
        // Dothome 등 proc_open()이 막힌 환경에서 안전하게 작동합니다.
        if (!mail($to, $subject, $body, $headers)) {
            throw new \RuntimeException('PHP mail() 함수를 통한 메일 발송에 실패했습니다.');
        }
    }
}
