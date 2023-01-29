<?php

namespace App\Http\Controllers\FragmentHandlers;

use App\Http\Controllers\Controller;
use App\Languages\Language;
use Illuminate\Http\Request;

/**
 * Handles requests from htmx to populate fragments in html. This one updates the list of langauges in select dropdown based on search criteria.
 */
class LanguageSelect extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $search = $request->input('language-search');
        $languages = Language::getIsoLanguages();
        $search_result = array_filter($languages, function ($language) use ($search) {
            return stripos($language, $search) !== false;
        });

        return view('create-project', [
            'languages' => $search_result
        ])->fragment('language-select');
    }
}
