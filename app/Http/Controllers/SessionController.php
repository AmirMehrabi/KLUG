<?php

namespace App\Http\Controllers;

use App\Support\SessionCatalog;
use Illuminate\Contracts\View\View;

class SessionController extends Controller
{
    public function index(SessionCatalog $catalog): View
    {
        $sessions = $catalog->all();

        return view('sessions.index', [
            'upcoming' => $catalog->upcoming(),
            'past' => $sessions->where('is_upcoming', false)->values(),
        ]);
    }

    public function show(string $slug, SessionCatalog $catalog): View
    {
        $session = $catalog->find($slug);
        abort_if($session === null, 404);

        return view('sessions.show', ['session' => $session, 'reports' => $catalog->reports($session)]);
    }
}
