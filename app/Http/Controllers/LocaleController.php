<?php

namespace App\Http\Controllers;

class LocaleController extends Controller
{
    public function switch(string $locale)
    {
        if (in_array($locale, ['fa', 'en'], true)) {
            session(['locale' => $locale]);
        }

        return back();
    }
}
