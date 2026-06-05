<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Event;
use App\Models\Club;
use App\Models\Satgas;

class HomeController extends Controller
{
    public function index()
    {
        // 🔹 News terbaru (limit 3)
        $news = News::where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        // 🔹 Event mendatang
        $events = Event::where('is_published', true)
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->take(3)
            ->get();

        // 🔹 Club aktif
        $clubs = Club::where('is_active', true)
            ->take(6)
            ->get();

        // 🔹 Satgas aktif
        $satgas = Satgas::where('is_active', true)
            ->take(6)
            ->get();

        // 🔹 Statistik
        $stats = [
            'members' => Club::sum('member_count'),
            'events' => Event::count(),
            'athletes' => Club::sum('member_count'),
            'coaches' => Satgas::count(),
        ];

        return view('home', compact(
            'news',
            'events',
            'clubs',
            'satgas',
            'stats'
        ));
    }
}