<!doctype html>
<html lang="ko">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', '하늘누리 추모공원')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS is loaded from Vite or public/dist, check the actual project setup. Using public/css for now -->
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    @stack('styles')
  </head>
  <body>
    <div class="cont">
      <!-- Header -->
      @include('front.layouts.header')
      
      <!-- Body -->
      @yield('content')
      
      <!-- Footer -->
      @include('front.layouts.footer')
    </div>

    <div class="popup-overlay" id="commonPopupOverlay" aria-hidden="true" style="display: none;">
      <div class="wrap-popup w400" role="dialog" aria-labelledby="commonPopupTitle">
        <div class="popup-header">
          <h3 class="popup-tit" id="commonPopupTitle">알림</h3>
          <button type="button" class="popup-close" id="commonPopupClose" aria-label="닫기">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
              <path d="M4 28L28 4" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" />
              <path d="M4 4L28 28" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" />
            </svg>
          </button>
        </div>
        <div class="popup-body">
          <div class="popup-cont" id="commonPopupContent">
            <div class="wrap-cont">
              <p id="commonPopupMessage"></p>
              <div class="wrap-btn">
                <button type="button" class="btn primary popup-confirm-btn" id="commonPopupConfirm">
                  <span>확인</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script shadow>
      window.commonModal = {
        overlay: null,
        title: null,
        message: null,
        confirmBtn: null,
        closeBtn: null,
        callback: null,

        init: function() {
          this.overlay = document.getElementById('commonPopupOverlay');
          this.title = document.getElementById('commonPopupTitle');
          this.message = document.getElementById('commonPopupMessage');
          this.confirmBtn = document.getElementById('commonPopupConfirm');
          this.closeBtn = document.getElementById('commonPopupClose');

          if (this.confirmBtn) {
            this.confirmBtn.addEventListener('click', () => this.hide(true));
          }
          if (this.closeBtn) {
            this.closeBtn.addEventListener('click', () => this.hide(false));
          }
          if (this.overlay) {
            this.overlay.addEventListener('click', (e) => {
              if (e.target === this.overlay) this.hide(false);
            });
          }
        },

        show: function(title, message, callback) {
          if (!this.overlay) this.init();
          if (this.title) this.title.textContent = title || '알림';
          if (this.message) this.message.innerHTML = message;
          this.callback = callback;
          this.overlay.style.display = 'flex';
          setTimeout(() => {
            this.overlay.classList.add('active');
            this.overlay.setAttribute('aria-hidden', 'false');
          }, 10);
        },

        hide: function(isConfirm) {
          if (this.overlay) {
            this.overlay.classList.remove('active');
            this.overlay.setAttribute('aria-hidden', 'true');
            setTimeout(() => {
              this.overlay.style.display = 'none';
              if (this.callback && typeof this.callback === 'function') {
                this.callback(isConfirm);
              }
            }, 300);
          }
        }
      };
      
      document.addEventListener('DOMContentLoaded', () => commonModal.init());
    </script>
    @stack('scripts')
  </body>
</html>
