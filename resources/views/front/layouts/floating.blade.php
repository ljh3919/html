<div class="wrap-floating">
  <!-- ToDo: 전화번호 나오면 번호 바꿔야 함. -->
  <a class="float-item" href="tel:010-1234-5678">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width="40"
      height="40"
      viewBox="0 0 40 40"
      fill="none"
    >
      <path
        d="M11.6856 11.7625C7.87312 16.7875 15.7981 24.1875 15.7981 24.1875C15.7981 24.1875 23.1856 32.1125 28.2231 28.3C28.2231 28.3 29.5981 27.2375 29.2856 25.7875C29.2856 25.7875 28.9856 24.95 28.0606 24.5625L24.9606 23.2875C24.9606 23.2875 24.1356 23 23.4356 23.5875L22.6481 24.25C22.6481 24.25 22.0731 24.9375 21.1481 24.2625C21.1481 24.2625 20.0856 23.5 18.2731 21.6875C16.4606 19.875 15.6981 18.8125 15.6981 18.8125C15.0356 17.875 15.7106 17.3125 15.7106 17.3125L16.3731 16.525C16.9606 15.825 16.6731 15 16.6731 15L15.3981 11.9C15.0106 10.9875 14.1731 10.675 14.1731 10.675C12.7231 10.375 11.6606 11.7375 11.6606 11.7375L11.6856 11.7625Z"
        fill="#fff"
      />
    </svg>
    <div class="tooltip">전화상담</div>
  </a>
  <!-- ToDo: 카카오 체널주소 나오면 바꿔야 함. -->
  <a class="float-item kakao" href="https://pf.kakao.com/_xxxxxx/chat">
    <div class="tooltip">카카오 상담</div></a
  >
  <!-- ToDo: 브로슈어 신청으로 연결 해야 함. -->
  <a class="float-item" href="{{ route('front.brochure') }}">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width="40"
      height="40"
      viewBox="0 0 40 40"
      fill="none"
    >
      <path
        d="M28.25 8.75H11.75C10.7875 8.75 10 9.53749 10 10.5V29.5C10 30.4625 10.7875 31.25 11.75 31.25H28.25C29.2125 31.25 30 30.4625 30 29.5V10.5C30 9.53749 29.2125 8.75 28.25 8.75ZM25.4625 19.225H14.55C14.0125 19.225 13.5875 18.8 13.5875 18.2625C13.5875 17.725 14.0125 17.3 14.55 17.3H25.4625C26 17.3 26.425 17.725 26.425 18.2625C26.425 18.8 26 19.225 25.4625 19.225ZM25.4625 14.75H14.55C14.0125 14.75 13.5875 14.325 13.5875 13.7875C13.5875 13.25 14.0125 12.825 14.55 12.825H25.4625C26 12.825 26.425 13.25 26.425 13.7875C26.425 14.325 26 14.75 25.4625 14.75Z"
        fill="#fff"
      />
    </svg>
    <div class="tooltip">브로슈어 신청</div>
  </a>
  <a class="float-item" href="#top">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width="40"
      height="40"
      viewBox="0 0 40 40"
      fill="none"
    >
      <path
        d="M19.7986 13L12 26.7348L12.2686 27C16.6811 23.1827 23.3285 23.1827 27.7314 27L28 26.7348L20.211 13H19.9424H19.8082H19.7986Z"
        fill="#fff"
      />
    </svg>
    <div class="tooltip">맨 위로</div>
  </a>
</div>

<!-- 전화상담 모달창 (PC 전용) -->
<div class="popup-overlay" id="popupOverlayCall" aria-hidden="true">
  <div class="wrap-popup w400 client" role="dialog" aria-labelledby="popupPreviewTitleCall">
    <div class="popup-header">
      <h3 class="popup-tit" id="popupPreviewTitleCall">전화상담</h3>
      <button type="button" class="popup-close" id="popupCloseCall" aria-label="닫기">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
          <path d="M4 28L28 4" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" />
          <path d="M4 4L28 28" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" />
        </svg>
      </button>
    </div>
    <div class="popup-body">
      <div class="popup-cont" id="popupContentCall">
        <div class="wrap-cont">
          <p>전화 상담 031-9999-9999</p>
          <div class="wrap-btn">
            <button type="button" class="btn primary popup-confirm-btn"><span>확인</span></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  (function () {
    const callOverlay = document.getElementById("popupOverlayCall");
    const callCloseBtn = document.getElementById("popupCloseCall");
    const callContentEl = document.getElementById("popupContentCall");
    const callTitleEl = document.getElementById("popupPreviewTitleCall");

    if (!callOverlay) return;

    function openCallPopup() {
      callOverlay.classList.add("active");
      callOverlay.setAttribute("aria-hidden", "false");
    }

    function closeCallPopup() {
      callOverlay.classList.remove("active");
      callOverlay.setAttribute("aria-hidden", "true");
    }

    const isMobileResolution = () =>
      window.matchMedia && window.matchMedia("(max-width: 768px)").matches;

    const floatingCallLink = document.querySelector(".wrap-floating a.float-item[href^='tel:']");
    if (floatingCallLink) {
      floatingCallLink.addEventListener("click", function (e) {
        if (isMobileResolution()) return;
        e.preventDefault();
        openCallPopup();
      });
    }

    if (callCloseBtn) callCloseBtn.addEventListener("click", closeCallPopup);
    callOverlay.addEventListener("click", function (e) {
      if (e.target === callOverlay) closeCallPopup();
      if (e.target.closest(".popup-confirm-btn")) closeCallPopup();
    });
  })();
</script>

