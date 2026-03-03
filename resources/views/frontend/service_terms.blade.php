@extends('frontend.layouts.layout')

@section('title', '서비스 이용약관')

@section('content')
<main>
  <div class="main">
    <div class="breadcrumb">
      <a href="{{ route('frontend.index') ?? '#' }}" class="item">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" style="width: 16px; height: 16px;">
          <path
            d="M2 5.99992L8 1.33325L14 5.99992V13.3333C14 13.6869 13.8595 14.026 13.6095 14.2761C13.3594 14.5261 13.0203 14.6666 12.6667 14.6666H3.33333C2.97971 14.6666 2.64057 14.5261 2.39052 14.2761C2.14048 14.026 2 13.6869 2 13.3333V5.99992Z"
            stroke="#333333"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
          <path
            d="M6 14.6667V8H10V14.6667"
            stroke="#333333"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
      </a>
      <a href="{{ route('frontend.service_terms') ?? '#' }}" class="item">서비스 이용약관</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">서비스 이용약관</h2>
    </div>
    <div class="wrap-c-terms">
      <div class="tit">제 1 조 (목적)</div>
      <div class="desc">
        이 약관은 재단법인 하늘누리(이하 '회사'라 표기합니다)가 제공하는 홈페이지 서비스의 이용조건 및 절차, 기타 필요한 사항을 규 정함을 목적으로 합니다.
      </div>

      <div class="tit">제 2 조 (약관의 효력과 변경)</div>
      <ul class="term-lists">
        <li class="item">1. 이 약관은 이용자에게 공지함으로써 효력을 발생합니다.</li>
        <li class="item">2. 이 약관의 내용은 서비스 화면 내에 게시하며 약관의 변경 사항이 있을 경우 회사의 온라인 공지사항을 통해 공지합니다.</li>
        <li class="item">3. 회사는 필요하다고 인정되는 경우 이 약관을 개정할 수 있으며 변경된 약관은 제 1 항과 같은 방법으로 효력을 발생합니다.</li>
      </ul>

      <div class="tit">제 3 조 (약관적용외 준칙)</div>
      <ul class="term-lists">
        <li class="item">1. 이 약관은 당사가 제공하는 서비스에 관한 이용규정 및 별도 약관과 함께 적용됩니다.</li>
        <li class="item">2. 이 약관에 명시되지 않은 사항이 관계법령에 규정되어 있을 경우에는 그 규정에 따릅니다.</li>
      </ul>

      <div class="tit">제 4 조 (정의)</div>
      <div class="desc">이 약관에서 사용하는 용어의 정의는 다음과 같습니다.</div>
      <ul class="term-lists">
        <li class="item">1. "이용자"란 "홈페이지"에 접속하여 이 약관에 따라 "홈페이지" 가 제공하는 서비스를 받는 개인회원 및 법인회원을 말합니다.</li>
        <li class="item">2. "가입"이란 당사가 제공하는 신청서 양식에 해당 정보를 가입하고,본 약관에 동의하여 서비스 이용계약을 완료시키는 행위를 말합니다.</li>
        <li class="item">3. "회원"이란 "홈페이지"에 개인 및 법인정보를 제공하여 회원등록을 한 이용자로서 "홈페이지 "의 정보를 지속적으로 제공받으며 해당 서비스를 계속적으로 이용할 수 있는 자를 말합니다.</li>
        <li class="item">4. "ID"란 회원식별과 회원의 서비스 이용을 위하여 회원이 신청하고 당사가 승인하는 이메일을 말합니다.</li>
        <li class="item">5. "비밀번호"란 이용자가 회원ID와 일치하는지를 확인하고 통신상의 자신의 비밀보호를 위하여 이용자 자신이 선정한 문자와 숫자의 조합을 말합니다.</li>
        <li class="item">6. "탈퇴"란 회원이 이용계약을 종료 시키는 행위를 말합니다.</li>
        <li class="item">7. 본 약관에서 정의하지 않은 용어는 개별서비스에 대한 별도 약관 및 이용규정에서 정의합니다.</li>
      </ul>

      <div class="tit">제 5 조 (회원자격 및 이용신청)</div>
      <ul class="term-lists">
        <li class="item">1. 회원가입은 이용자가 본 약관에 동의하고, 회사에서 요구하는 소정의 가입절차에 응한 후 이루어집니다</li>
        <li class="item">2. 회사는 새로운 회원이 가입시 회원 ID를 무료로 제공하며 서비스 이용신청자는 반드시 실명으로 이용신청을 하여야 합니다.</li>
        <li class="item">3. 회원가입은 이용자의 이용신청에 대한 회사의 이용 승낙과 이용자의 약관내용에 대한 동의로 성립됩니다.</li>
      </ul>

      <div class="tit">제 6 조 (회원자격 탈퇴 및 자격상실)</div>
      <ul class="term-lists">
        <li class="item">1. 다음 각호의 사유에 해당하는 경우 회원자격을 제한 및 정지시킬 수 있습니다.</li>
        <li class="item">가. 타인의 명의를 도용하여 신청하였을 때</li>
        <li class="item">나. 이용 계약 신청서의 내용을 허위로 기재하거나 허위서류를 첨부하여 신청하였을 때</li>
        <li class="item">다. 사회의 안녕이나 혹은 미풍양속을 저해할 목적으로 신청하였을 때</li>
        <li class="item">라. 다른 사람의 당사서비스 이용을 방해하거나 그 정보를 도용하는 등의 행위를 하였을때</li>
        <li class="item">마. 당사 사이트를 이용하여 법령과 본 약관이 금지하는 행위를 하는 경우</li>
        <li class="item">바. 기타 당사가 정한 이용신청요건이 미비 되었을 때</li>
      </ul>

      <div class="tit">제 7 조 (서비스의 제공 및 이용)</div>
      <ul class="term-lists">
        <li class="item">1. 서비스의 이용은 회사의 업무상 또는 기술상 특별한 지장이 없는 한 연중무휴 1일 24시간을 원칙으로 합니다.</li>
        <li class="item">2. 회사는 다음 각 호에 해당하는 경우 서비스 제공을 중지할 수 있습니다. 가. 시스템 정비를 위하여 부득이한 경우</li>
        <li class="item">나. 전기통신사업법에 규정된 기간통신사업자가 전기통신 서비스를 중지하는 경우</li>
        <li class="item">다. 기타 회사가 서비스를 제공할 수 없는 사유가 발생할 경우</li>
        <li class="item">3. 당사가 제공하는 서비스는 아래와 같으며,그 변경될 서비스의 내용을 이용자에게 공지하고 아래에서 정한 서비스를 변경하 여 제공 할 수 있습니다.</li>
        <li class="item">가. 홈페이지(회원약관)</li>
        <li class="item">나. 기타 회사가 자체 개발하거나 다른 회사와의 협력 계약 등을 통해 제공하는 일체의 서비스</li>
      </ul>

      <div class="tit">제 8 조 (회원정보 사용에 대한 동의)</div>
      <ul class="term-lists">
        <li class="item">1. 회원의 개인정보에 대해서는 당사의 개인정보 보호정책이 적용됩니다.</li>
        <li class="item">2. 당사의 회원 정보는 다음과 같이 수집, 사용, 관리, 보호됩니다.</li>
        <li class="item">가. 개인정보의 수집 : 당사는 귀하의 당사 서비스 가입 시 귀하가 제공하는 정보, 커뮤니티 활동을 위하여 귀하가 제공하는 정보, 각종 이벤트 참가를 위하여 귀하가 제공하는 정보, 광고나 경품의 취득을 위하여 귀하가 제공하는 정보 등을 통하여 귀하에 관한 정보를 수집합니다.</li>
        <li class="item">나. 개인정보의 사용 : 당사는 당사 서비스 제공과 관련해서 수집된 회원의 신상정보를 본인의 승낙 없이 제3자에게 누설, 배포하지 않습니다.</li>
        <li class="item">다. 개인정보의 관리 : 귀하는 개인정보의 보호 및 관리를 위하여 홈페이지 회원정보에서 수시로 귀하의 개인정보를 수정/삭제할 수 있습니다.</li>
        <li class="item">라. 개인정보의 보호 : 귀하의 개인정보는 오직 귀하만이 열람/수정/삭제 할 수 있으며, 이는 전적으로 귀하의ID와 비밀번호에 의해 관리되고 있습니다.</li>
      </ul>

      <div class="tit">제 9 조 (사용자의 정보 보안)</div>
      <ul class="term-lists">
        <li class="item">1. 가입 신청자가 당사 서비스 가입 절차를 완료하는 순간부터 귀하는 입력한 정보의 비밀을 유지할 책임이 있으며, 회원의 ID와 비밀번호를 사용하여 발생하는 모든 결과에 대한 책임은 회원본인에게 있습니다.</li>
        <li class="item">2. ID 와 비밀번호에 관한 모든 관리의 책임은 회원에게 있으며, 회원의 ID나 비밀번호가 부정하게 사용되었다는 사실을 발견한 경우에는 즉시 당사에 신고하여야 합니다.</li>
      </ul>

      <div class="tit">부칙</div>
      <ul class="term-lists">
        <li class="item">1. (시행일) 이 약관은 2026년 3월 1일부터 시행된다.</li>
      </ul>
    </div>
  </div>
</main>
@endsection
