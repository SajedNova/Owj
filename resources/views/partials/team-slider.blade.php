<section class="tm-section" dir="rtl">
    <div class="tm-band"></div>

    <div class="tm-header">
        <span class="tm-eyebrow">تیم ما</span>
        <div class="tm-title-row">
            <span class="tm-line"></span>
            <h2>درکنار هم، برای شما تلاش می‌کنیم<span class="tm-pennant"></span></h2>
            <span class="tm-line"></span>
        </div>
    </div>

    <div class="tm-slider" id="tmSlider" style="--tm-visible: 5; --tm-card-w: 260px; --tm-gap: 20px;">

        <button class="tm-arrow tm-arrow--prev" type="button" aria-label="قبلی">‹</button>

        <div class="tm-viewport">
            <div class="tm-track" id="tmTrack">

                @forelse($teamMembers as $member)
                    <article class="tm-card">
                        <div class="tm-card__photo">
                            <img src="{{ $member->avatar ? asset('storage/' . $member->avatar) : asset('storage/avatars/default-avatar.jpg') }}"
                                 alt="{{ $member->name }}" loading="lazy">
                        </div>
                        <div class="tm-card__info">
                            <div class="tm-card__name"
                                 data-fa="{{ $member->name }}"
                                 data-en="{{ $member->name_en }}">
                                {{ app()->getLocale() === 'fa' ? $member->name : $member->name_en }}
                            </div>
                            <div class="tm-card__role"
                                 data-fa="{{ $member->role }}"
                                 data-en="{{ $member->role_en }}">
                                {{ app()->getLocale() === 'fa' ? $member->role : $member->role_en }}
                            </div>
                        </div>
                        <span class="tm-card__bar"></span>
                    </article>
                @empty
                    <p style="color:rgba(0,0,0,.4); padding:40px 0;">هنوز عضوی ثبت نشده.</p>
                @endforelse

            </div>
        </div>

        <button class="tm-arrow tm-arrow--next" type="button" aria-label="بعدی">›</button>

    </div>
</section>

<style>
    /* ===== Slider shell: arrows sit beside the track (flex row), always vertically centered ===== */
    .tm-slider{
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0 16px;
        max-width: 1600px;
        margin: 0 auto;
    }

    /* ===== Viewport: hard-caps visible width to exactly N cards (default 5) ===== */
    .tm-viewport{
        overflow: hidden;
        flex: 1 1 auto;
        min-width: 0;
        /* width shown = N cards + (N-1) gaps, but never wider than the available space */
        max-width: calc(
            (var(--tm-card-w) * var(--tm-visible)) +
            (var(--tm-gap) * (var(--tm-visible) - 1))
        );
        margin: 0 auto;
    }

    .tm-track{
        display: flex;
        gap: var(--tm-gap, 20px);
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        padding: 8px 4px 24px;
        scrollbar-width: none;
        -ms-overflow-style: none;
        height: 388px;
        align-items: flex-start;
    }
    .tm-track::-webkit-scrollbar{ display: none; }

    .tm-track .tm-card{
        flex: 0 0 auto;
        scroll-snap-align: start;
        width: var(--tm-card-w, 260px);
        margin-top: 70px;
    }

    @media (max-width: 900px){
        .tm-slider{ --tm-card-w: 220px; --tm-visible: 3; }
        .tm-slider{ padding: 0 12px; gap: 8px; }
    }
    @media (max-width: 560px){
        .tm-slider{ --tm-card-w: 78vw; --tm-visible: 1.15; }
        .tm-slider{ padding: 0 4px; }
        .tm-arrow{ display: none; }
    }

    /* ===== Arrows: static flex items, always centered on the track's height ===== */
    .tm-arrow{
        flex: 0 0 auto;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        border: 1px solid rgba(0,0,0,.08);
        background: #fff;
        box-shadow: 0 6px 18px rgba(0,0,0,.08);
        font-size: 22px;
        line-height: 1;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
        transition: background .2s ease, transform .2s ease;
    }
    .tm-arrow:hover{ background: #f3f3f3; }
    .tm-arrow:active{ transform: scale(.94); }
    .tm-arrow:disabled{
        opacity: .35;
        cursor: default;
        box-shadow: none;
    }
    .tm-arrow:disabled:hover{ background: #fff; }

    body.dark-mode .tm-arrow{
        background: #1f1f1f;
        border-color: rgba(255,255,255,.08);
        color: #fff;
    }
    body.dark-mode .tm-arrow:hover{ background: #2a2a2a; }
    body.dark-mode .tm-arrow:disabled:hover{ background: #1f1f1f; }
</style>

<script>
    (() => {
        const slider = document.getElementById('tmSlider');
        if (!slider) return;

        const track = document.getElementById('tmTrack');
        const prevBtn = slider.querySelector('.tm-arrow--prev');
        const nextBtn = slider.querySelector('.tm-arrow--next');
        const cards = Array.from(track.children).filter(el => el.tagName === 'ARTICLE');
        if (!cards.length) {
            prevBtn.style.display = 'none';
            nextBtn.style.display = 'none';
            return;
        }

        function cardStep() {
            const card = cards[0];
            const style = getComputedStyle(track);
            const gap = parseFloat(style.columnGap || style.gap || 0);
            return card.offsetWidth + gap;
        }

        const isRTL = getComputedStyle(slider).direction === 'rtl';

        function updateArrowState() {
            const maxScroll = track.scrollWidth - track.clientWidth - 1;
            const pos = Math.abs(track.scrollLeft);

            if (isRTL) {
                // In RTL, scrollLeft is 0 at the start and grows negative in most browsers
                prevBtn.disabled = track.scrollLeft >= -1;
                nextBtn.disabled = pos >= maxScroll;
            } else {
                prevBtn.disabled = track.scrollLeft <= 0;
                nextBtn.disabled = track.scrollLeft >= maxScroll;
            }
        }

        nextBtn.addEventListener('click', () => {
            track.scrollBy({ left: isRTL ? -cardStep() : cardStep(), behavior: 'smooth' });
        });
        prevBtn.addEventListener('click', () => {
            track.scrollBy({ left: isRTL ? cardStep() : -cardStep(), behavior: 'smooth' });
        });

        track.addEventListener('scroll', () => {
            window.requestAnimationFrame(updateArrowState);
        }, { passive: true });

        window.addEventListener('resize', updateArrowState);
        updateArrowState();
    })();
</script>
