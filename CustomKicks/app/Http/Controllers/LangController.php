<?php

// Emanuel Patiño

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LangController extends Controller
{
    public function switchLanguage(): RedirectResponse
    {
        $currentLocale = session('locale', config('app.locale'));

        if ($currentLocale === 'es') {
            session()->put('locale', 'en');
        } else {
            session()->put('locale', 'es');
        }

        return redirect()->back();
    }
}
