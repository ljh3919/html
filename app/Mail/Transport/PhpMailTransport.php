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
        
        // 발신자 주소
        $from = $email->getFrom();
        $senderAddress = !empty($from) ? $from[0]->getAddress() : config('mail.from.address');
        
        $html = $email->getHtmlBody();
        $text = $email->getTextBody();
        $attachments = $email->getAttachments();
        
        $headers = [];
        $headers[] = "From: $senderAddress";
        $headers[] = "Reply-To: $senderAddress";
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "X-Mailer: PHP/" . phpversion();

        if (empty($attachments)) {
            // 첨부파일이 없는 경우 기존의 단순 발송 방식 유지
            $contentType = $html ? 'text/html' : 'text/plain';
            $headers[] = "Content-type: $contentType; charset=utf-8";
            $body = $html ?: $text;
        } else {
            // 첨부파일이 있는 경우 Multipart/Mixed 구조 생성
            $boundary = "----=_NextPart_" . md5(time());
            $headers[] = "Content-Type: multipart/mixed; boundary=\"$boundary\"";
            
            $body = "This is a multi-part message in MIME format.\r\n\r\n";
            
            // 본문 파트
            $body .= "--$boundary\r\n";
            $contentType = $html ? 'text/html' : 'text/plain';
            $body .= "Content-Type: $contentType; charset=\"utf-8\"\r\n";
            $body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
            $body .= ($html ?: $text) . "\r\n\r\n";
            
            // 첨부파일 파트들
            foreach ($attachments as $attachment) {
                $filename = '=?UTF-8?B?' . base64_encode($attachment->getPreparedHeaders()->get('Content-Disposition')?->getParameter('filename') ?: 'attachment') . '?=';
                $content = chunk_split(base64_encode($attachment->getBody()));
                
                $body .= "--$boundary\r\n";
                $body .= "Content-Type: application/octet-stream; name=\"$filename\"\r\n";
                $body .= "Content-Description: $filename\r\n";
                $body .= "Content-Disposition: attachment; filename=\"$filename\"\r\n";
                $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
                $body .= $content . "\r\n";
            }
            $body .= "--$boundary--";
        }

        $headerString = implode("\r\n", $headers);

        // 발송 시도
        if (!mail($to, $subject, $body, $headerString)) {
            \Log::error("PHP mail() failed to $to");
            throw new \RuntimeException('PHP mail() 함수를 통한 메일 발송에 실패했습니다.');
        }
    }
}
