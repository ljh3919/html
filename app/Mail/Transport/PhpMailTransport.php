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
        
        // Symfony Email 객체로부터 전체 MIME 데이터 생성
        $messageString = $message->getMessage()->toString();
        
        // PHP mail() 함수는 To와 Subject를 별도로 받으므로, 헤더에서 이를 분리해야 함
        // 줄바꿈 형식을 정규화 (CRLF or LF)
        $messageString = str_replace("\r\n", "\n", $messageString);
        
        // 헤더와 본문 분리
        [$headerData, $body] = explode("\n\n", $messageString, 2);
        
        // To, Subject 헤더 제거 (mail() 함수의 인자로 전달되므로 중복 방지)
        $headers = explode("\n", $headerData);
        $filteredHeaders = array_filter($headers, function($header) {
            $lowerHeader = strtolower($header);
            return !str_starts_with($lowerHeader, 'to:') && !str_starts_with($lowerHeader, 'subject:');
        });
        
        $headerString = implode("\n", $filteredHeaders);

        // 발송 시도
        if (!mail($to, $subject, $body, $headerString)) {
            \Log::error("PHP mail() failed to $to");
            throw new \RuntimeException('PHP mail() 함수를 통한 메일 발송에 실패했습니다.');
        }
    }
}
