<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * @param Request $request
     * @param string $locale
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $locale = 'en_GB')
    {
        // If a matching locale is found, set it and return the correct translations (could also be done with sessions)
        app()->setLocale($locale);

        return view('welcome');
    }

}
