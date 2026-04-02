@component('mail::message')
# 안녕하세요, 하늘누리 관리자님.

요청하신 관리자 계정의 임시 비밀번호를 안내해 드립니다.
보안을 위해 로그인 후 반드시 비밀번호를 변경해 주시기 바랍니다.

@component('mail::panel')
**임시 비밀번호: {{ $tempPassword }}**
@component('mail::button', ['url' => route('HNA_Login_001')])
관리자 로그인하러 가기
@endcomponent
@endcomponent

감사합니다,<br>
하늘누리 팀

@slot('footer')
@component('mail::footer')
Copyright 2026 haneulnuri. All Right Reserved
@endcomponent
@endslot
@endcomponent
