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
        
        // 제목 인코딩 (한글 깨짐 방지)
        $subject = '=?UTF-8?B?' . base64_encode($email->getSubject()) . '?=';
        
        // 메일 본문 추출
        $body = $email->getHtmlBody() ?: $email->getTextBody();
        $contentType = $email->getHtmlBody() ? 'text/html' : 'text/plain';
        
        // 발신자 정보
        $from = $email->getFrom();
        $senderAddress = !empty($from) ? $from[0]->getAddress() : config('mail.from.address');
        $senderName = !empty($from) && $from[0]->getName() ? $from[0]->getName() : config('mail.from.name');
        
        // 헤더 단순화 및 최적화 (Dothome 등 공유 호스팅용)
        $headers = [];
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: $contentType; charset=utf-8";
        $headers[] = "From: =?UTF-8?B?" . base64_encode($senderName) . "?= <$senderAddress>";
        $headers[] = "Reply-To: $senderAddress";
        $headers[] = "X-Mailer: PHP/" . phpversion();

        $headerString = implode("\r\n", $headers);

        // Envelope Sender 설정
        $extraParams = "-f" . $senderAddress;

        // 발송 시도
        if (!mail($to, $subject, $body, $headerString, $extraParams)) {
            \Log::error("PHP mail() native call failed to $to");
            throw new \RuntimeException('PHP mail() 함수를 통한 메일 발송에 실패했습니다.');
        }
    }
}
