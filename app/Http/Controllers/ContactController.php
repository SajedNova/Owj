<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\ProjectRequest;

class ContactController extends Controller
{
    public function store(StoreContactRequest $request)
    {
        ProjectRequest::create([
            'name'    => $request->input('name'),
            'email'   => $request->input('email'),
            'message' => $request->input('message'),
            'status'  => ProjectRequest::STATUS_NEW,
        ]);

        return back()->with('contact_success', 'پیام شما با موفقیت ارسال شد. به‌زودی با شما تماس می‌گیریم.');
    }
}
