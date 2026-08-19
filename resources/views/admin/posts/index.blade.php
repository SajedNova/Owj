@extends('layouts.admin')

@section('title', 'مدیریت وبلاگ')
@section('subtitle', 'ایجاد، ویرایش و مدیریت پست‌های دوزبانه وبلاگ سایت')

@section('content')
    <div class="table-card" style="padding: 30px 30px;">
        <div class="table-toolbar">
            <div class="topbar-search">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                <input type="text" id="searchInput" placeholder="جستجو بر اساس عنوان یا دسته‌بندی..." onkeyup="filterTable()">
            </div>

            <a href="{{ route('posts.create') }}"  style="background: var(--brand);color: #fff;box-shadow: 0 8px 20px rgba(245, 48, 3, .22);display: inline-flex;align-items: center;gap: 8px;padding: 10px 20px;border-radius: 99px;font-size: 14px;font-weight: 700;border: 1px solid transparent;transition: .15s;white-space: nowrap;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M12 5v14M5 12h14"></path></svg>
                افزودن پست

            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success" style="margin:0 0 16px; padding:12px 16px; border-radius:8px; background:#e6f7ec; color:#1c7c3f; font-size:13px;">
                {{ session('success') }}
            </div>
        @endif

        <table class="table" id="postsTable">
            <thead>
                <tr>
                    <th>تصویر</th>
                    <th>عنوان</th>
                    <th>دسته‌بندی</th>
                    <th>زبان‌ها</th>
                    <th>نویسنده</th>
                    <th>تاریخ</th>
                    <th>وضعیت</th>
                    <th>انتشار</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>
                            @if($post->image)
                                <img src="{{ $post->image_url }}" alt="{{ $post->title_fa }}" style="width:48px; height:48px; object-fit:cover; border-radius:8px;">
                            @else
                                <div style="width:48px; height:48px; border-radius:8px; background:#eef2f7;"></div>
                            @endif
                        </td>
                        <td class="searchable">{{ $post->title_fa }}</td>
                        <td class="searchable">{{ $post->category_fa ?? '—' }}</td>
                        <td>
                            <span class="badge" style="background:#eef2f7; color:#5c6b7a; padding:3px 10px; border-radius:999px; font-size:11.5px;">FA</span>
                            @if($post->hasEnglishVersion())
                                <span class="badge" style="background:#e6f7ec; color:#1c7c3f; padding:3px 10px; border-radius:999px; font-size:11.5px;">EN</span>
                            @else
                                <span class="badge" style="background:#fbeaea; color:#b51c1c; padding:3px 10px; border-radius:999px; font-size:11.5px;">EN ناقص</span>
                            @endif
                        </td>
                        <td>{{ $post->author->name ?? '—' }}</td>
                        <td>{{ $post->created_at->format('Y/m/d H:i') }}</td>
                        <td>
                            @if($post->status === \App\Models\Post::STATUS_PUBLISHED)
                                <span class="badge" style="background:#e6f7ec; color:#1c7c3f; padding:3px 10px; border-radius:999px; font-size:11.5px;">منتشرشده</span>
                            @else
                                <span class="badge" style="background:#eef2f7; color:#5c6b7a; padding:3px 10px; border-radius:999px; font-size:11.5px;">پیش‌نویس</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('posts.toggle-status', $post->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <label class="switch">
                                    <input type="checkbox" onchange="this.form.submit()" {{ $post->status === \App\Models\Post::STATUS_PUBLISHED ? 'checked' : '' }}>
                                    <span class="switch-track"></span>
                                </label>
                            </form>
                        </td>
                        <td>
                            <div class="row-actions">
                                <a href="{{ route('posts.edit', $post->id) }}" class="icon-action">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z"/></svg>
                                </a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" id="delete-form-{{ $post->id }}">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete('{{ $post->id }}')" class="icon-action danger">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m3 0-1 14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2L4 6h16Z"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align:center; padding:24px; color:var(--muted-2);">
                            هنوز هیچ پستی ثبت نشده است.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($posts->hasPages())
            <div style="margin-top:16px;">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection

@section('scripts')
<script>
    function filterTable() {
        const input = document.getElementById("searchInput");
        const filter = input.value.toUpperCase();
        const table = document.getElementById("postsTable");
        const tr = table.getElementsByTagName("tr");
        for (let i = 1; i < tr.length; i++) {
            const cells = tr[i].getElementsByClassName("searchable");
            let match = cells.length === 0;
            for (const td of cells) {
                const txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) { match = true; break; }
            }
            tr[i].style.display = match ? "" : "none";
        }
    }

    function confirmDelete(id) {
        if (confirm('آیا از حذف این پست مطمئن هستید؟')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection
