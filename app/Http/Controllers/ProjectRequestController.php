<?php

namespace App\Http\Controllers;

use App\Mail\NewProjectRequestMail;
use App\Models\ProjectRequest;
use App\Http\Requests\StoreProjectRequestRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProjectRequestController extends Controller
{
    /**
     * ذخیره‌ی یک درخواست پروژه‌ی جدید که از فرم تماس ارسال شده است.
     */
    public function store(StoreProjectRequestRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        unset($validated['website']); // حذف فیلد هانی‌پات قبل از ذخیره

        $projectRequest = ProjectRequest::create([
            ...$validated,
            'ip_address' => $request->ip(),
        ]);

        // ارسال ایمیل اطلاع‌رسانی به ادمین (در صورت خطا، ثبت درخواست را متوقف نمی‌کند)
        try {
            $adminEmail = config('mail.project_request_to', config('mail.from.address'));
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new NewProjectRequestMail($projectRequest));
            }
        } catch (\Throwable $e) {
            Log::error('ارسال ایمیل درخواست پروژه با خطا مواجه شد: ' . $e->getMessage());
        }

        return back()
            ->with('success', 'پیام شما با موفقیت ارسال شد. به‌زودی با شما تماس می‌گیریم.');
    }
}
