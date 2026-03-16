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
        
        // 헤더 복제 및 To, Subject 제거 (mail 함수 오동작 방지)
        $headers = clone $email->getHeaders();
        $headers->remove('To');
        $headers->remove('Subject');
        
        // 발신자 주소 추출 (Dothome의 -f 옵션용)
        $fromAddress = config('mail.from.address');
        if ($from = $email->getFrom()) {
            $fromAddress = $from[0]->getAddress();
        }
        
        // 헤더 문자열 생성
        $headerString = $headers->toString();
        
        // 본문 데이터 추출
        $body = $email->getBody()->toString();
        
        // 닷홈(Linux) 환경의 mail() 함수는 \n을 선호하므로 줄바꿈 통일
        $headerString = str_replace("\r\n", "\n", $headerString);
        $body = str_replace("\r\n", "\n", $body);
        
        // Dothome 등 일부 호스팅에서는 발신자 주소 고정(-f) 옵션이 필수적인 경우가 많음
        $extraParams = "-f" . $fromAddress;

        // 발송 시도
        if (!mail($to, $subject, $body, $headerString, $extraParams)) {
            \Log::error("PHP mail() failed to $to with params: $extraParams");
            // 디버깅을 위해 에러 로그 상세화
            \Log::error("Failed headers: " . $headerString);
            throw new \RuntimeException('PHP mail() 함수를 통한 메일 발송에 실패했습니다.');
        }
    }
}
