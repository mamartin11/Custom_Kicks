<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LangController extends Controller
{
    public function switchLanguage(Request $request): RedirectResponse
    {
        $lang = $request->input('lang');

        if ($lang && in_array($lang, ['en', 'es'])) {
            session()->put('locale', $lang);
        } else {
            // Si no hay parámetro lang, alternar entre idiomas
            $currentLocale = session('locale', config('app.locale'));

            if ($currentLocale === 'es') {
                session()->put('locale', 'en');
            } else {
                session()->put('locale', 'es');
            }
        }

        return redirect()->back();
    }
}
