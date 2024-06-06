<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\LinkRedirect;


class RedirectUrlController extends Controller
{
    public function redirect($url_code)
    {
        if ($url_code) {
            $redirectUrl = LinkRedirect::where('redirect_to', $url_code)->value('redirect_from');

            if ($redirectUrl) {
                return Redirect::to($redirectUrl);
            } else {
                return redirect()->route('404-code');
            }
        }
    }
}
