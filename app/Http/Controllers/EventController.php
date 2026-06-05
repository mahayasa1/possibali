<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PUBLIC (FRONTEND)
    |--------------------------------------------------------------------------
    */

    public function publicIndex(Request $request)
    {
        $query = Event::where('is_published', true)
            ->latest('event_date');

        $query = $this->applyFilter($query, $request);

        $events = $query->get();

        // UPCOMING EVENT (untuk banner countdown)
        $upcoming = Event::where('is_published', true)
            ->where('event_date', '>=', now())
            ->where('status', '!=', 'selesai')
            ->orderBy('event_date')
            ->first();

        return view('events.index', compact('events', 'upcoming'));
    }

    public function show(Event $event)
    {
        abort_if(!$event->is_published, 404);

        return view('events.show', compact('event'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN (BACKEND)
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = Event::latest();

        $query = $this->applyFilter($query, $request);

        $events = $query->paginate(10)->withQueryString();

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.form', ['event' => null]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $data['slug'] = Str::slug($request->title) . '-' . Str::random(4);
        $data['is_published'] = $request->boolean('is_published');
        $data['registered_participants'] = $request->integer('registered_participants', 0);

        Event::create($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil ditambahkan!');
    }

    public function edit(Event $event)
    {
        return view('admin.events.form', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $this->validateData($request);

        $data['is_published'] = $request->boolean('is_published');

        $event->update($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil dihapus!');
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER (BIAR RAPI)
    |--------------------------------------------------------------------------
    */

    private function applyFilter($query, Request $request)
    {
        return $query
            ->when($request->filled('search'), fn($q) =>
                $q->where('title', 'like', '%' . $request->search . '%')
            )
            ->when($request->filled('type') && $request->type !== 'semua', fn($q) =>
                $q->where('type', $request->type)
            );
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'title'                   => 'required|string|max:255',
            'type'                    => 'required|in:kompetisi,pelatihan,sosial,seminar',
            'icon'                    => 'nullable|string|max:10',
            'description'             => 'required|string',
            'location'                => 'required|string|max:255',
            'event_date'              => 'required|date',
            'start_time'              => 'required',
            'end_time'                => 'nullable',
            'max_participants'        => 'required|integer|min:1',
            'registered_participants' => 'nullable|integer|min:0',
            'status'                  => 'required|in:open,hampir penuh,penuh,selesai',
            'is_published'            => 'nullable|boolean',
        ]);
    }
}