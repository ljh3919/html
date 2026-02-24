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
        
        // 발신자 정보 추출 ( Envelope Sender 설정용 )
        $from = $email->getFrom();
        $senderAddress = !empty($from) ? $from[0]->getAddress() : config('mail.from.address');

        // 헤더 문자열 생성 및 보정
        $headers = $email->getHeaders()->toString();

        // PHP의 mail() 함수는 5번째 인자로 -f 옵션을 주어 Envelope Sender를 명시하는 것이 
        // 공유 호스팅(Dothome 등)에서 발송 성공률을 높입니다.
        $extraParams = "-f" . $senderAddress;

        if (!mail($to, $subject, $body, $headers, $extraParams)) {
            \Log::error("PHP mail() failed for $to with subject: $subject");
            throw new \RuntimeException('PHP mail() 함수를 통한 메일 발송에 실패했습니다.');
        }
    }
}
