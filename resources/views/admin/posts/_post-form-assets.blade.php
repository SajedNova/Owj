<link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">

<style>
    .post-form { display: flex; flex-direction: column; gap: 20px; }
    .post-form .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .post-form .form-group { display: flex; flex-direction: column; gap: 8px; }
    .post-form label { font-size: 13.5px; font-weight: 600; color: #1a1a2e; }
    .post-form input[type="text"],
    .post-form input[type="file"],
    .post-form select,
    .post-form textarea {
        width: 100%;
        padding: 12px 14px;
        border-radius: 10px;
        border: 1px solid #e3e7ee;
        font-size: 14px;
        font-family: inherit;
        background: #fafbfe;
        color: #1a1a2e;
        resize: vertical;
    }
    .post-form input:focus, .post-form select:focus, .post-form textarea:focus {
        outline: none;
        border-color: var(--brand-dark, #b51c1c);
    }
    .post-form .field-error { color: #e5484d; font-size: 12px; }
    .post-form .hint-text { color: #8a93a3; font-size: 12px; margin: 0; }
    .post-form .form-actions { display: flex; gap: 12px; justify-content: flex-start; margin-top: 8px; }
    .btn-primary-action {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--brand-dark, #b51c1c); color: #fff;
        border: none; padding: 11px 22px; border-radius: 10px;
        font-size: 14px; font-weight: 600; cursor: pointer; text-decoration: none;
    }
    .btn-secondary-action {
        display: inline-flex; align-items: center; gap: 6px;
        background: #eef2f7; color: #5c6b7a;
        border: none; padding: 11px 22px; border-radius: 10px;
        font-size: 14px; font-weight: 600; cursor: pointer; text-decoration: none;
    }
    @media (max-width: 720px) { .post-form .form-row { grid-template-columns: 1fr; } }

    /* Language tabs */
    .lang-tabs { display: flex; gap: 8px; border-bottom: 1px solid #e3e7ee; margin-bottom: 4px; }
    .lang-tab {
        border: none; background: none; cursor: pointer;
        padding: 10px 18px; font-size: 14px; font-weight: 600; color: #8a93a3;
        border-bottom: 2px solid transparent; margin-bottom: -1px;
        display: flex; align-items: center; gap: 6px;
    }
    .lang-tab.active { color: var(--brand-dark, #b51c1c); border-bottom-color: var(--brand-dark, #b51c1c); }
    .lang-tab .tab-dot { width: 7px; height: 7px; border-radius: 50%; background: #1c7c3f; display: inline-block; }
    .lang-panel { display: flex; flex-direction: column; gap: 20px; }

    /* Rich editor */
    .rich-editor { background: #fafbfe; border-radius: 10px; }
    .rich-editor .ql-toolbar { border-radius: 10px 10px 0 0; border-color: #e3e7ee; }
    .rich-editor .ql-container { border-radius: 0 0 10px 10px; border-color: #e3e7ee; min-height: 260px; font-size: 14px; }
</style>

<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.js"></script>
<script>
    function previewImage(event) {
        const preview = document.getElementById('imagePreview');
        const file = event.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    }

    // --- تب‌های زبان ---
    document.querySelectorAll('.lang-tab').forEach(function (tab) {
        tab.addEventListener('click', function () {
            const lang = tab.dataset.lang;
            document.querySelectorAll('.lang-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.lang-panel').forEach(p => p.style.display = 'none');
            tab.classList.add('active');
            document.querySelector('[data-lang-panel="' + lang + '"]').style.display = 'flex';
        });
    });

    // --- تنظیمات آپلود تصویر داخل ادیتور ---
    const CONTENT_IMAGE_UPLOAD_URL = "{{ route('posts.upload-content-image') }}";
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.content
        || document.querySelector('input[name="_token"]').value;

    function imageHandler() {
        const quill = this.quill;
        const input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.click();

        input.onchange = () => {
            const file = input.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append('image', file);
            formData.append('_token', CSRF_TOKEN);

            fetch(CONTENT_IMAGE_UPLOAD_URL, { method: 'POST', body: formData })
                .then(res => res.json())
                .then(data => {
                    const range = quill.getSelection(true);
                    quill.insertEmbed(range.index, 'image', data.location);
                    quill.setSelection(range.index + 1);
                })
                .catch(() => alert('آپلود تصویر با خطا مواجه شد.'));
        };
    }

    function makeEditor(id, textareaId) {
        const container = document.getElementById(id);
        if (!container) return null;

        const quill = new Quill('#' + id, {
            theme: 'snow',
            modules: {
                toolbar: {
                    container: [
                        [{ header: [2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        ['blockquote', 'link', 'image'],
                        ['clean'],
                    ],
                    handlers: { image: imageHandler },
                },
            },
        });

        const textarea = document.getElementById(textareaId);
        // مقدار اولیه (برای ویرایش پست)
        if (textarea.value) {
            quill.root.innerHTML = textarea.value;
        }
        // قبل از ارسال فرم، محتوای HTML ادیتور در textarea واقعی قرار می‌گیرد
        document.getElementById('postForm').addEventListener('submit', function () {
            textarea.value = quill.root.innerHTML;
        });

        return quill;
    }

    makeEditor('editor_fa', 'content_fa');
    makeEditor('editor_en', 'content_en');
</script>
