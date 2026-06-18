@extends('layouts.admin')

@section('title', 'Club')
@section('page-title', 'Club')
@section('page-subtitle', 'Kelola club POSSI Bali')
@section('content')

<div class="admin-card">

    <div class="admin-card-header">

        <h2 class="admin-card-title">
            Manajemen Club Selam
        </h2>

        <a href="{{ route('admin.clubs.create') }}"
           class="topbar-btn topbar-btn-primary">
            ➕ Tambah Club
        </a>

    </div>

    <div class="admin-card-body">

        <form method="GET" class="admin-filter-bar">

            <div class="admin-search-wrap">
                <input
                    type="text"
                    name="search"
                    class="admin-search-input"
                    placeholder="Cari club..."
                    value="{{ request('search') }}">
            </div>

            <input
                type="text"
                name="area"
                class="admin-input"
                placeholder="Area"
                value="{{ request('area') }}"
                style="max-width:180px;">

            <button class="btn-primary">
                <span>Filter</span>
            </button>

        </form>

    </div>

    <div class="admin-table-wrap">

        <table class="admin-table">

            <thead>
            <tr>
                <th>Club</th>
                <th>Kota</th>
                <th>Area</th>
                <th>Member</th>
                <th>Verified</th>
                <th>Champion</th>
                <th>Status</th>
                <th width="120">Aksi</th>
            </tr>
            </thead>

            <tbody>

            @forelse($clubs as $club)

                <tr>

                    <td>
                        {{ $club->icon }}
                        <strong>{{ $club->name }}</strong>
                    </td>

                    <td>{{ $club->city }}</td>

                    <td>{{ $club->area }}</td>

                    <td>{{ number_format($club->member_count) }}</td>

                    <td>

                        @if($club->is_verified)
                            <span class="badge badge-success">
                                Verified
                            </span>
                        @else
                            <span class="badge badge-muted">
                                No
                            </span>
                        @endif

                    </td>

                    <td>

                        @if($club->is_champion)
                            <span class="badge badge-warning">
                                Champion
                            </span>
                        @else
                            <span class="badge badge-muted">
                                -
                            </span>
                        @endif

                    </td>

                    <td>

                        @if($club->is_active)
                            <span class="badge badge-success">
                                Aktif
                            </span>
                        @else
                            <span class="badge badge-danger">
                                Nonaktif
                            </span>
                        @endif

                    </td>

                    <td>

                        <div style="display:flex;gap:6px">

                            <a href="{{ route('admin.clubs.edit',$club) }}"
                               class="action-btn action-btn-edit">
                                ✏️
                            </a>

                            <form
                                action="{{ route('admin.clubs.destroy',$club) }}"
                                method="POST"
                                onsubmit="return confirm('Hapus club ini?')">

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
                    <td colspan="8">
                        Belum ada data club.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="admin-pagination">
        {{ $clubs->links() }}
    </div>

</div>

@endsection