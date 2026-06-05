<?php

namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
 
class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::latest();
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->type) {
            $query->where('type', $request->type);
        }
        $events = $query->paginate(10)->withQueryString();
        return view('admin.events.index', compact('events'));
    }
 
    public function create()
    {
        return view('admin.events.form', ['event' => null]);
    }
 
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'                   => 'required|string|max:255',
            'type'                    => 'required|in:kompetisi,pelatihan,sosial,seminar',
            'icon'                    => 'nullable|string|max:10',
            'description'             => 'required|string',
            'location'                => 'required|string|max:255',
            'event_date'              => 'required|date',
            'start_time'              => 'required',
            'end_time'                => 'nullable',
            'max_participants'        => 'required|integer|min:1',
            'registered_participants' => 'integer|min:0',
            'status'                  => 'required|in:open,hampir penuh,penuh,selesai',
            'is_published'            => 'boolean',
        ]);
 
        $data['slug']         = Str::slug($request->title) . '-' . Str::random(4);
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
        $data = $request->validate([
            'title'                   => 'required|string|max:255',
            'type'                    => 'required|in:kompetisi,pelatihan,sosial,seminar',
            'icon'                    => 'nullable|string|max:10',
            'description'             => 'required|string',
            'location'                => 'required|string|max:255',
            'event_date'              => 'required|date',
            'start_time'              => 'required',
            'end_time'                => 'nullable',
            'max_participants'        => 'required|integer|min:1',
            'registered_participants' => 'integer|min:0',
            'status'                  => 'required|in:open,hampir penuh,penuh,selesai',
            'is_published'            => 'boolean',
        ]);
 
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
}
 