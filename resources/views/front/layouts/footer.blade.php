<footer class="footer">
  <div class="wrap-footer">
    <h2 class="tit2">하늘누리 추모공원</h2>
    <div class="wrap-compony">
      <div class="wrap-terms">
        <a class="item" href="{{ route('front.service_terms') ?? '#' }}">서비스 이용약관</a>
        <a class="item" href="{{ route('front.personal_terms') ?? '#' }}">개인정보 처리방침</a>
      </div>
      <div class="wrap-info">
        <div class="text">
          <strong>재단법인 하늘누리 추모공원</strong>
        </div>
        <div class="wrap-text">
          <div class="text">
            <span>사업자등록번호</span><strong>155-77-88888</strong>
          </div>
          <div class="text">
            <span>대표번호</span><strong>031-999-9999</strong>
          </div>
          <div class="text">
            <span>주소</span><strong>경기도 양주시 산북동 산67-20</strong>
          </div>
        </div>
      </div>
      <div class="copyright">
        Copyright 2026 haneulnuri. All Right Reserved
      </div>
    </div>
  </div>
@include('front.layouts.floating')
</footer>
