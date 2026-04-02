@component('mail::message')
# 안녕하세요, {{ $name }}님.

하늘누리 추모공원을 찾아주셔서 감사합니다.
요청하신 브로슈어 관련 안내 사항을 전달해 드립니다.

@component('mail::panel')
**신청하신 브로슈어 내용이 정상적으로 처리되었습니다.**
아래 버튼을 통해 홈페이지에서 더 자세한 정보를 확인하실 수 있습니다.
@endcomponent

@component('mail::button', ['url' => route('front.index')])
홈페이지 바로가기
@endcomponent

궁금하신 점이 있으시면 언제든지 고객센터로 문의해 주시기 바랍니다.

감사합니다,<br>
하늘누리 팀

@slot('footer')
@component('mail::footer')
Copyright 2026 haneulnuri. All Right Reserved
@endcomponent
@endslot
@endcomponent
