@extends('layouts.admin')

@section('title', 'نمونه‌کارها')
@section('subtitle', 'مدیریت پروژه‌ها، گالری تصاویر و اعضای مرتبط با هر پروژه')

@section('content')
    <div class="table-card">
        <div class="table-toolbar">
            <div class="topbar-search">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                <input type="text" id="searchInput" placeholder="جستجو بر اساس عنوان..." onkeyup="filterTable()">
            </div>
            <a href="{{ route('portfolios.create') }}" class="btn btn-primary btn-sm">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                افزودن نمونه‌کار
            </a>
        </div>
        <table class="table" id="portfolioTable">
            <thead>
                <tr>
                    <th>عنوان پروژه</th>
                    <th>دسته‌بندی</th>
                    <th>کارفرما</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($portfolios as $portfolio)
                    <tr>
                        <td class="searchable">{{ $portfolio->title }}</td>
                        <td>{{ $portfolio->category == 'website' ? 'وب‌سایت' : 'اپلیکیشن' }}</td>
                        <td>{{ $portfolio->client_name }}</td>
                        <td>
                            <form action="{{ route('portfolios.toggle-publish', $portfolio->id) }}" method="POST">
                                @csrf
                                <label class="switch">
                                    <input type="checkbox" onchange="this.form.submit()" {{ $portfolio->is_published ? 'checked' : '' }}>
                                    <span class="switch-track"></span>
                                </label>
                            </form>
                        </td>
                        <td>
                            <div class="row-actions">
                                <a href="{{ route('portfolios.edit', $portfolio->id) }}" class="icon-action">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4Z"/></svg>
                                </a>
                                <form action="{{ route('portfolios.destroy', $portfolio->id) }}" method="POST" id="delete-form-{{ $portfolio->id }}">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete('{{ $portfolio->id }}')" class="icon-action danger">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m3 0-1 14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2L4 6h16Z"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
            const td = tr[i].getElementsByClassName("searchable")[0];
            if (td) {
                const txtValue = td.textContent || td.innerText;
                tr[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
            }
        }
    }
</script>
@endsection
