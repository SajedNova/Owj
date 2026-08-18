@extends('layouts.admin')

@section('title', 'درخواست‌های پروژه')
@section('subtitle', 'پیام‌هایی که کاربران از طریق فرم تماس سایت ارسال کرده‌اند')

@section('content')
    <div class="table-card">
        <div class="table-toolbar">
            <div class="topbar-search">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                <input type="text" id="searchInput" placeholder="جستجو بر اساس نام یا ایمیل..." onkeyup="filterTable()">
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success" style="margin:0 0 16px; padding:12px 16px; border-radius:8px; background:#e6f7ec; color:#1c7c3f; font-size:13px;">
                {{ session('success') }}
            </div>
        @endif

        <table class="table" id="portfolioTable">
            <thead>
                <tr>
                    <th>نام</th>
                    <th>ایمیل</th>
                    <th>پیام</th>
                    <th>تاریخ ارسال</th>
                    <th>وضعیت</th>
                    <th>خوانده‌شده</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projectRequests as $projectRequest)
                    <tr>
                        <td class="searchable">{{ $projectRequest->name }}</td>
                        <td class="searchable" style="direction:ltr; text-align:left;">{{ $projectRequest->email }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($projectRequest->message, 60) }}</td>
                        <td>{{ $projectRequest->created_at->format('Y/m/d H:i') }}</td>
                        <td>
                            @if($projectRequest->status === \App\Models\ProjectRequest::STATUS_NEW)
                                <span class="badge" style="background:#fdecea; color:#e5484d; padding:3px 10px; border-radius:999px; font-size:11.5px;">جدید</span>
                            @else
                                <span class="badge" style="background:#eef2f7; color:#5c6b7a; padding:3px 10px; border-radius:999px; font-size:11.5px;">خوانده‌شده</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('project-requests.toggle-read', $projectRequest->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <label class="switch">
                                    <input type="checkbox" onchange="this.form.submit()" {{ $projectRequest->status !== \App\Models\ProjectRequest::STATUS_NEW ? 'checked' : '' }}>
                                    <span class="switch-track"></span>
                                </label>
                            </form>
                        </td>
                        <td>
                            <div class="row-actions">
                                <a href="{{ route('project-requests.show', $projectRequest->id) }}" class="icon-action">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>
                                <form action="{{ route('project-requests.destroy', $projectRequest->id) }}" method="POST" id="delete-form-{{ $projectRequest->id }}">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete('{{ $projectRequest->id }}')" class="icon-action danger">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m3 0-1 14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2L4 6h16Z"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center; padding:24px; color:var(--muted-2);">
                            هنوز هیچ درخواست پروژه‌ای ثبت نشده است.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($projectRequests->hasPages())
            <div style="margin-top:16px;">
                {{ $projectRequests->links() }}
            </div>
        @endif
    </div>
@endsection

@section('scripts')
<script>
    function filterTable() {
        const input = document.getElementById("searchInput");
        const filter = input.value.toUpperCase();
        const table = document.getElementById("portfolioTable");
        const tr = table.getElementsByTagName("tr");
        for (let i = 1; i < tr.length; i++) {
            const cells = tr[i].getElementsByClassName("searchable");
            let match = cells.length === 0; // اگر ردیفی class جستجو نداشت (مثل حالت خالی)، مخفی نکن
            for (const td of cells) {
                const txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) { match = true; break; }
            }
            tr[i].style.display = match ? "" : "none";
        }
    }
</script>
@endsection
