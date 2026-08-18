<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>درخواست پروژه جدید</title>
</head>
<body style="font-family: Tahoma, Arial, sans-serif; background:#f5f5f7; padding:24px;">
    <div style="max-width:560px;margin:0 auto;background:#fff;border-radius:12px;padding:24px;border:1px solid #eee;">
        <h2 style="color:#1a1a2e;margin-top:0;">یک درخواست پروژه جدید ثبت شد</h2>

        <p><strong>نام:</strong> {{ $projectRequest->name }}</p>
        <p><strong>ایمیل:</strong> {{ $projectRequest->email }}</p>
        <p><strong>تاریخ ثبت:</strong> {{ $projectRequest->created_at->format('Y-m-d H:i') }}</p>

        <hr style="border:none;border-top:1px solid #eee;margin:16px 0;">

        <p><strong>پیام:</strong></p>
        <p style="white-space:pre-line;line-height:1.8;">{{ $projectRequest->message }}</p>
    </div>
</body>
</html>
