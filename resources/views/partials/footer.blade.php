  <!-- ===== FOOTER ===== -->
  <footer class="site-footer" role="contentinfo">
    <div class="ft-top">
      <div class="ft-brand">
        <div class="ft-logo">OWJcode</div>
        <p data-i18n="footer.desc">We design and build digital products — from strategy and UI to launch and long-term support.</p>
        <div class="ft-social">
          @if($siteSetting->twitter_url)
          <a href="{{ $siteSetting->twitter_url }}" target="_blank" aria-label="X (Twitter)">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.9 2H22l-7.6 8.7L23.3 22h-6.9l-5.4-6.9L4.8 22H1.6l8.1-9.3L1 2h7.1l4.9 6.3L18.9 2zm-1.2 18h1.9L7.4 4H5.4l12.3 16z"/></svg>
          </a>
          @endif
          @if($siteSetting->github_url)
          <a href="{{ $siteSetting->github_url }}" target="_blank" aria-label="GitHub">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.58 2 12.2c0 4.5 2.87 8.32 6.84 9.67.5.1.68-.22.68-.49 0-.24-.01-.87-.01-1.71-2.78.62-3.37-1.37-3.37-1.37-.45-1.18-1.11-1.49-1.11-1.49-.91-.64.07-.63.07-.63 1 .07 1.53 1.05 1.53 1.05.89 1.56 2.34 1.11 2.91.85.09-.66.35-1.11.63-1.37-2.22-.26-4.56-1.14-4.56-5.05 0-1.12.39-2.03 1.03-2.75-.1-.26-.45-1.3.1-2.71 0 0 .84-.28 2.75 1.05a9.29 9.29 0 0 1 5 0c1.9-1.33 2.74-1.05 2.74-1.05.56 1.41.21 2.45.1 2.71.65.72 1.03 1.63 1.03 2.75 0 3.92-2.34 4.78-4.57 5.04.36.32.68.94.68 1.9 0 1.37-.01 2.47-.01 2.81 0 .27.18.6.69.49A10.02 10.02 0 0 0 22 12.2C22 6.58 17.52 2 12 2z"/></svg>
          </a>
          @endif
          @if($siteSetting->instagram_url)
          <a href="{{ $siteSetting->instagram_url }}" target="_blank" aria-label="Instagram">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.2c3.2 0 3.58.01 4.85.07 1.17.05 1.97.24 2.43.4a4.9 4.9 0 0 1 1.77 1.15 4.9 4.9 0 0 1 1.15 1.77c.16.46.35 1.26.4 2.43.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.05 1.17-.24 1.97-.4 2.43a4.9 4.9 0 0 1-1.15 1.77 4.9 4.9 0 0 1-1.77 1.15c-.46.16-1.26.35-2.43.4-1.27.06-1.65.07-4.85.07s-3.58-.01-4.85-.07c-1.17-.05-1.97-.24-2.43-.4a4.9 4.9 0 0 1-1.77-1.15 4.9 4.9 0 0 1-1.15-1.77c-.16-.46-.35-1.26-.4-2.43C2.21 15.58 2.2 15.2 2.2 12s.01-3.58.07-4.85c.05-1.17.24-1.97.4-2.43a4.9 4.9 0 0 1 1.15-1.77A4.9 4.9 0 0 1 5.6 1.8c.46-.16 1.26-.35 2.43-.4C9.3 1.34 9.68 1.33 12 1.33m0 2c-3.15 0-3.5.01-4.73.07-.96.04-1.48.2-1.83.34-.46.18-.79.39-1.13.73-.34.34-.55.67-.73 1.13-.14.35-.3.87-.34 1.83C3.18 8.33 3.17 8.68 3.17 11.83s.01 3.5.07 4.73c.04.96.2 1.48.34 1.83.18.46.39.79.73 1.13.34.34.67.55 1.13.73.35.14.87.3 1.83.34 1.23.06 1.58.07 4.73.07s3.5-.01 4.73-.07c.96-.04 1.48-.2 1.83-.34.46-.18.79-.39 1.13-.73.34-.34.55-.67.73-1.13.14-.35.3-.87.34-1.83.06-1.23.07-1.58.07-4.73s-.01-3.5-.07-4.73c-.04-.96-.2-1.48-.34-1.83a3 3 0 0 0-.73-1.13 3 3 0 0 0-1.13-.73c-.35-.14-.87-.3-1.83-.34C15.5 4.18 15.15 4.17 12 4.17z"/><circle cx="12" cy="12" r="3.2"/></svg>
          </a>
          @endif
          @if($siteSetting->telegram_url)
          <a href="{{ $siteSetting->telegram_url }}" target="_blank" aria-label="Telegram">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.56-.99-.71-.35-1.1.22-1.68.15-.15 2.71-2.48 2.76-2.69.01-.03.01-.14-.07-.2-.08-.06-.19-.04-.27-.02-.11.02-1.93 1.23-5.46 3.46-.51.35-.98.53-1.4.51-.46-.01-1.35-.27-2.01-.48-.81-.26-1.45-.4-1.39-.85.03-.24.31-.48.84-.71 5.19-2.26 8.66-3.75 10.42-4.47 4.96-2.04 5.99-2.39 6.66-2.4.15 0 .48.04.7.21.18.15.24.36.26.5.01.06.01.19 0 .26z"/></svg>
          </a>
          @endif
        </div>
      </div>

      <div class="ft-col">
        <h4 data-i18n="footer.company.title">Company</h4>
        <ul>
          <li><a href="#" data-i18n="footer.company.l1">About us</a></li>
          <li><a href="#careers" data-i18n="footer.company.l2">Careers</a></li>
          <li><a href="#" data-i18n="footer.company.l3">Blog</a></li>
          <li><a href="#contact" data-i18n="footer.company.l4">Contact</a></li>
        </ul>
      </div>

      <div class="ft-col">
        <h4 data-i18n="footer.services.title">Services</h4>
        <ul>
          <li><a href="#" data-i18n="footer.services.l1">Product Strategy</a></li>
          <li><a href="#" data-i18n="footer.services.l2">UI / UX Design</a></li>
          <li><a href="#" data-i18n="footer.services.l3">Web Development</a></li>
          <li><a href="#" data-i18n="footer.services.l4">Mobile Development</a></li>
        </ul>
      </div>

      <div class="ft-col">
        <h4 data-i18n="footer.resources.title">Resources</h4>
        <ul>
          <li><a href="#" data-i18n="footer.resources.l1">Documentation</a></li>
          <li><a href="#" data-i18n="footer.resources.l2">Case Studies</a></li>
          <li><a href="#" data-i18n="footer.resources.l3">Support</a></li>
          <li><a href="#" data-i18n="footer.resources.l4">Status</a></li>
        </ul>
      </div>

      <div class="ft-newsletter">
        <h4 data-i18n="footer.newsletter.title">Stay in the loop</h4>
        <p data-i18n="footer.newsletter.desc">Product notes and case studies, sent occasionally — no spam.</p>
        <form class="ft-nl-form" onsubmit="return false;">
          <label for="ft-nl-email" class="sr-only" data-i18n="footer.newsletter.label">Email address</label>
          <input id="ft-nl-email" type="email" data-i18n-placeholder="footer.newsletter.placeholder" placeholder="you@company.com">
          <button type="submit" data-i18n="footer.newsletter.btn">Subscribe</button>
        </form>
      </div>
    </div>

    <div class="ft-bottom">
      <p data-i18n="footer.copyright">© 2026 OWJcode. All rights reserved.</p>
      <div class="ft-legal">
        <a href="#" data-i18n="footer.legal.privacy">Privacy Policy</a>
        <a href="#" data-i18n="footer.legal.terms">Terms of Service</a>
        <a href="#" data-i18n="footer.legal.cookies">Cookies</a>
      </div>
    </div>
  </footer>
