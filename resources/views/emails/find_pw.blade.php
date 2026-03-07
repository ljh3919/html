@component('mail::message')
# 안녕하세요, {{ $memberName }}님.

하늘누리 추모공원입니다.
요청하신 비밀번호 찾기 결과를 안내해 드립니다.
보안을 위해 발급된 임시 비밀번호로 로그인하신 후, 반드시 비밀번호를 변경하시기 바랍니다.

@component('mail::panel')
**임시 비밀번호: {{ $tempPassword }}**
@endcomponent

@component('mail::button', ['url' => route('front.login')])
로그인하러 가기
@endcomponent

감사합니다,<br>
하늘누리 팀

@slot('footer')
@component('mail::footer')
Copyright 2026 haneulnuri. All Right Reserved
@endcomponent
@endslot
@endcomponent
