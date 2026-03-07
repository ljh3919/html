@component('mail::message')
# 안녕하세요, {{ $memberName }}님.

하늘누리 추모공원입니다.
요청하신 아이디 찾기 결과를 안내해 드립니다.

@component('mail::panel')
**회원님의 아이디는 [ {{ $userId }} ] 입니다.**
@endcomponent

로그인 후 하늘누리의 다양한 서비스를 이용해 보세요.

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
