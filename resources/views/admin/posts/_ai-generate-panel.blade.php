{{-- پنل تولید خودکار پست با هوش مصنوعی --}}
<div class="ai-generate-box">
    <div class="ai-generate-header">
        <div>
            <strong>✨ تولید خودکار با هوش مصنوعی</strong>
            <p class="hint-text" style="margin:4px 0 0;">
                یک موضوع یا پرامت بده تا عنوان، خلاصه، دسته‌بندی و متن کامل پست به‌صورت
                خودکار به فارسی و انگلیسی تولید و در فرم زیر پر شود. بعد از تولید، حتماً
                محتوا را بازبینی و در صورت نیاز ویرایش کن.
            </p>
        </div>
        <button type="button" id="aiToggleBtn" class="btn-secondary-action">باز کردن</button>
    </div>

    <div id="aiGeneratePanel" style="display:none; margin-top:14px; flex-direction:column; gap:10px;">
        <textarea id="aiPrompt" placeholder="مثلاً: یک مقاله درباره مزایای استفاده از لاراول برای پروژه‌های استارتاپی بنویس، لحن دوستانه و آموزشی، حدود ۶۰۰ کلمه"></textarea>
        <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
            <button type="button" id="aiGenerateBtn" class="btn-primary-action">تولید مقاله</button>
            <span id="aiStatus" class="hint-text"></span>
        </div>
    </div>
</div>
