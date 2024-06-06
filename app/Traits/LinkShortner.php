<?php

namespace App\Traits;

use App\Models\LinkRedirect;

trait LinkShortner
{
    /**
     * Creates a short link with the given ID, original URL, and redirect URL.
     *
     * @param int|null $id The ID of the link redirect. If null, a new link redirect will be created.
     * @param string $originalUrl The original URL of the link.
     * @param string $redirectUrl The redirect URL of the link.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the link redirect with the given ID is not found.
     * @return void
     */
    public static function createShortLink(int $id = null, string $originalUrl, string $redirectUrl): void
    {
        $linkRedirect = $id ? LinkRedirect::findOrFail($id) : new LinkRedirect();
        $linkRedirect->redirect_from = $originalUrl;
        $linkRedirect->redirect_to = $redirectUrl;
        $linkRedirect->save();
    }
}
