@extends('layouts.admin')

@section('title', 'Event')
@section('page-title', 'Event')
@section('page-subtitle', 'Kelola event POSSI Bali')

@section('content')

<div class="admin-card">

    <div class="admin-card-header">

        <div>
            <h2 class="admin-card-title">Manajemen Event</h2>
        </div>

        <a href="{{ route('admin.events.create') }}"
           class="topbar-btn topbar-btn-primary">
            ➕ Tambah Event
        </a>

    </div>

    <div class="admin-card-body">

        <form method="GET" class="admin-filter-bar">

            <div class="admin-search-wrap">
                <input
                    type="text"
                    name="search"
                    class="admin-search-input"
                    placeholder="Cari event..."
                    value="{{ request('search') }}"
                >
            </div>

            <select name="type" class="admin-filter-select">
                <option value="semua">Semua Tipe</option>
                <option value="kompetisi" @selected(request('type')=='kompetisi')>Kompetisi</option>
                <option value="pelatihan" @selected(request('type')=='pelatihan')>Pelatihan</option>
                <option value="sosial" @selected(request('type')=='sosial')>Sosial</option>
                <option value="seminar" @selected(request('type')=='seminar')>Seminar</option>
            </select>

            <button class="btn-primary">
                <span>Filter</span>
            </button>

        </form>

    </div>

    <div class="admin-table-wrap">

        <table class="admin-table">

            <thead>
            <tr>
                <th>Judul</th>
                <th>Tipe</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Peserta</th>
                <th>Publish</th>
                <th width="120">Aksi</th>
            </tr>
            </thead>

            <tbody>

            @forelse($events as $event)

                <tr>

                    <td>
                        <strong>{{ $event->title }}</strong>
                        <br>
                        <small>{{ $event->location }}</small>
                    </td>

                    <td>
                        <span class="badge badge-info">
                            {{ ucfirst($event->type) }}
                        </span>
                    </td>

                    <td>
                        {{ $event->event_date->format('d M Y') }}
                    </td>

                    <td>

                        @if($event->status == 'open')
                            <span class="badge badge-success">Open</span>
                        @elseif($event->status == 'hampir penuh')
                            <span class="badge badge-warning">Hampir Penuh</span>
                        @elseif($event->status == 'penuh')
                            <span class="badge badge-danger">Penuh</span>
                        @else
                            <span class="badge badge-muted">Selesai</span>
                        @endif

                    </td>

                    <td>
                        {{ $event->registered_participants }}
                        /
                        {{ $event->max_participants }}
                    </td>

                    <td>

                        @if($event->is_published)
                            <span class="badge badge-success">
                                Publish
                            </span>
                        @else
                            <span class="badge badge-muted">
                                Draft
                            </span>
                        @endif

                    </td>

                    <td>

                        <div style="display:flex;gap:6px">

                            <a
                                href="{{ route('admin.events.edit',$event) }}"
                                class="action-btn action-btn-edit">
                                ✏️
                            </a>

                            <form
                                action="{{ route('admin.events.destroy',$event) }}"
                                method="POST"
                                onsubmit="return confirm('Hapus event ini?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="action-btn action-btn-delete"
                                    type="submit">
                                    🗑️
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7">
                        Belum ada data event.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="admin-pagination">
        {{ $events->links() }}
    </div>

</div>

@endsection