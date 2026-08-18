<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectRequestController extends Controller
{
    /**
     * نمایش لیست درخواست‌های پروژه ثبت‌شده از طریق فرم تماس سایت.
     */
    public function index(): View
    {
        $projectRequests = ProjectRequest::latest()->paginate(15);

        return view('admin.project-requests.index', compact('projectRequests'));
    }

    /**
     * نمایش جزئیات کامل یک درخواست، و علامت‌گذاری خودکار به‌عنوان «خوانده‌شده».
     */
    public function show(ProjectRequest $projectRequest): View
    {
        if ($projectRequest->status === ProjectRequest::STATUS_NEW) {
            $projectRequest->update(['status' => ProjectRequest::STATUS_READ]);
        }

        return view('admin.project-requests.show', compact('projectRequest'));
    }

    /**
     * تغییر وضعیت بین «خوانده‌شده» و «خوانده‌نشده» از داخل جدول لیست.
     */
    public function toggleRead(ProjectRequest $projectRequest): RedirectResponse
    {
        $projectRequest->update([
            'status' => $projectRequest->status === ProjectRequest::STATUS_NEW
                ? ProjectRequest::STATUS_READ
                : ProjectRequest::STATUS_NEW,
        ]);

        return back();
    }

    /**
     * حذف یک درخواست پروژه.
     */
    public function destroy(ProjectRequest $projectRequest): RedirectResponse
    {
        $projectRequest->delete();

        return redirect()
            ->route('project-requests.index')
            ->with('success', 'درخواست موردنظر حذف شد.');
    }
}
