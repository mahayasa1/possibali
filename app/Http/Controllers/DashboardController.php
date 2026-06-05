<?php

namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Event;
use App\Models\Club;
use App\Models\Satgas;
use App\Models\User;
 
class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'news'    => News::count(),
            'events'  => Event::count(),
            'clubs'   => Club::count(),
            'satgas'  => Satgas::count(),
            'members' => User::count(),
            'published_news'   => News::where('is_published', true)->count(),
            'upcoming_events'  => Event::where('event_date', '>=', now())->where('is_published', true)->count(),
            'active_clubs'     => Club::where('is_active', true)->count(),
        ];
 
        $latestNews   = News::latest()->take(5)->get();
        $latestEvents = Event::latest()->take(5)->get();
 
        return view('admin.dashboard', compact('stats', 'latestNews', 'latestEvents'));
    }
}
 