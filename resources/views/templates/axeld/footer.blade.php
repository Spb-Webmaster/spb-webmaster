<footer class="spb-footer">
  <div class="spb-footer__stripe"></div>
  <div class="spb-footer__glow spb-footer__glow--right"></div>
  <div class="spb-footer__glow spb-footer__glow--left"></div>
  <div class="spb-footer__shape spb-footer__shape--square"></div>
  <div class="spb-footer__shape spb-footer__shape--circle"></div>
  <div class="spb-footer__shape spb-footer__shape--dot-left"></div>
  <div class="spb-footer__shape spb-footer__shape--dot-right"></div>
  <div class="spb-footer__inner">
    <div class="spb-footer__grid">
      <div>
        <div class="spb-footer__brand">
          <svg width="28" height="30" viewBox="0 0 32 34" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 14.4333C0.254261 12.4089 1.67504 8.5982 3.81392 6.08238C6.6108 2.79261 8.6897 0.75307 14.0292 0.500011C18.3008 0.297564 22.036 1.82519 23.3921 2.50001C25.5957 3.68095 29.2401 5.77871 30.2571 9.6252C31.2742 13.4717 31.2742 15.4456 30.2571 18.9884C29.2401 22.5312 25.6804 24.8087 23.3921 26.074C21.1037 27.3393 17.544 27.0863 15.0014 26.5802C12.4588 26.074 10.4247 22.5312 9.9162 21.2659C9.50506 20.2429 9.42632 18.5583 9.41125 17.9506C9.32146 17.8313 9.31234 17.7503 9.40768 17.7231C9.40768 17.7231 9.40768 17.8066 9.41125 17.9506C9.87541 18.5672 12.4954 20.2089 13.9844 20.7598C15.7614 21.4173 18.5611 21.772 20.8494 20.7598C20.8494 20.7598 24.6634 18.9884 25.1719 16.2047C25.6804 13.4211 25.1719 10.4628 23.3921 8.43836C21.6122 6.41389 20.3409 6.16673 18.5611 5.57626C16.7813 4.98578 15.0014 4.81708 13.4759 4.81708C11.9503 4.81708 10.679 4.81708 8.39063 6.08238C6.10228 7.34768 5.33949 8.10684 3.81392 9.6252C2.28835 11.1436 0 14.4333 0 14.4333Z" fill="#FF5200"/>
            <path d="M32 19.6317C31.8729 21.668 30.6934 25.5594 28.7161 28.2029C26.1305 31.6596 24.1953 33.3011 18.8821 33.8847C14.6314 34.3515 10.7774 33.2893 9.38179 32.6998C7.10857 31.6578 3.27909 28.8192 2.02332 25.0432C0.767546 21.2672 0.723207 20.56 1.51658 16.961C2.30995 13.362 5.72018 10.8683 7.92492 9.4636C10.1297 8.0589 13.6982 8.09084 16.2676 8.43836C18.8369 8.78588 20.6131 9.63866 21.5 11.5C22.3869 13.3614 22.3339 16.0991 22.3869 16.7047C22.4804 16.6716 22.484 16.8182 22.3869 16.7047C21.8851 16.118 19.1675 14.6419 17.6469 14.1844C15.8322 13.6383 12.5969 13.2505 10.4247 14.4333C10.4247 14.4333 7.09947 16.6143 6.76613 19.4241C6.43279 22.2338 6.54363 24.0018 8.44669 25.912C10.3498 27.8222 11.6978 29.0063 14.0292 29.6221C16.3606 30.238 17.9612 30.1963 19.6596 30.0331C21.358 29.8699 22.4047 29.6221 24.1482 28.4866C25.8917 27.351 27.0668 26.2769 28.4944 24.6669C29.922 23.0569 32 19.6317 32 19.6317Z" fill="#FF5200"/>
          </svg>
          <span class="spb-footer__brand-name">SPB-WEBMASTER</span>
        </div>
        <p class="spb-footer__text">Онлайн-студия разработки сайтов для частных специалистов и компаний.</p>
      </div>
      <div>
        <div class="spb-footer__title">Навигация</div>
        <div class="spb-footer__links">
          <x-menu.site-menu variant="footer" />
        </div>
      </div>
      <div>
        <div class="spb-footer__title">Контакты</div>
        <div class="spb-footer__links">
          <a href="tel:+{{ phone($settings['phone'] ?? '') }}" class="spb-footer-link">{{ format_phone(phone($settings['phone'] ?? '')) }}</a>
          <a href="mailto:{{ $settings['email'] ?? '' }}" class="spb-footer-link">{{ $settings['email'] ?? '' }}</a>
          <a href="#" class="spb-footer-link open-fancybox" data-form="call_me">Оставить заявку</a>
        </div>
      </div>
    </div>
    <div class="spb-footer__bottom">
      <span>© {!! date("Y") !!} {{ $settings['copy'] ?? '' }}</span>
      <span>{{ $settings['city'] ?? '' }}</span>
    </div>
  </div>
</footer>
