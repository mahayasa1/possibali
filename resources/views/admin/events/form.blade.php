@extends('layouts.admin')

@section('title', $event ? 'Edit Event' : 'Tambah Event')
@section('page-title', $event ? 'Edit Event' : 'Tambah Event')
@section('page-subtitle', $event ? 'Perbarui informasi event' : 'Buat event baru')


@section('content')

<form
    action="{{ $event
        ? route('admin.events.update',$event)
        : route('admin.events.store') }}"
    method="POST">

    @csrf

    @if($event)
        @method('PUT')
    @endif

    <div class="admin-card">

        <div class="admin-card-header">
            <h2 class="admin-card-title">

                {{ $event ? 'Edit Event' : 'Tambah Event' }}

            </h2>
        </div>

        <div class="admin-card-body">

            <div class="admin-form-group">
                <label class="admin-form-label">
                    Judul Event
                </label>

                <input
                    type="text"
                    name="title"
                    class="admin-input"
                    value="{{ old('title',$event?->title) }}"
                    required>
            </div>

            <div class="form-row-2">

                <div class="admin-form-group">
                    <label class="admin-form-label">
                        Tipe
                    </label>

                    <select
                        name="type"
                        class="admin-input"
                        required>

                        <option value="kompetisi">Kompetisi</option>
                        <option value="pelatihan">Pelatihan</option>
                        <option value="sosial">Sosial</option>
                        <option value="seminar">Seminar</option>

                    </select>

                </div>

                <div class="admin-form-group">

                    <label class="admin-form-label">
                        Icon
                    </label>

                    <input
                        type="text"
                        name="icon"
                        class="admin-input"
                        value="{{ old('icon',$event?->icon) }}"
                        placeholder="🏊">

                </div>

            </div>

            <div class="admin-form-group">

                <label class="admin-form-label">
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    class="admin-input"
                    rows="6"
                    required>{{ old('description',$event?->description) }}</textarea>

            </div>

            <div class="admin-form-group">

                <label class="admin-form-label">
                    Lokasi
                </label>

                <input
                    type="text"
                    name="location"
                    class="admin-input"
                    value="{{ old('location',$event?->location) }}"
                    required>

            </div>

            <div class="form-row-3">

                <div class="admin-form-group">

                    <label class="admin-form-label">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        name="event_date"
                        class="admin-input"
                        value="{{ old('event_date',
                        optional($event?->event_date)->format('Y-m-d')) }}"
                        required>

                </div>

                <div class="admin-form-group">

                    <label class="admin-form-label">
                        Mulai
                    </label>

                    <input
                        type="time"
                        name="start_time"
                        class="admin-input"
                        value="{{ old('start_time',$event?->start_time) }}"
                        required>

                </div>

                <div class="admin-form-group">

                    <label class="admin-form-label">
                        Selesai
                    </label>

                    <input
                        type="time"
                        name="end_time"
                        class="admin-input"
                        value="{{ old('end_time',$event?->end_time) }}">

                </div>

            </div>

            <div class="form-row-3">

                <div class="admin-form-group">

                    <label class="admin-form-label">
                        Maks Peserta
                    </label>

                    <input
                        type="number"
                        name="max_participants"
                        class="admin-input"
                        value="{{ old('max_participants',$event?->max_participants) }}"
                        required>

                </div>

                <div class="admin-form-group">

                    <label class="admin-form-label">
                        Peserta Terdaftar
                    </label>

                    <input
                        type="number"
                        name="registered_participants"
                        class="admin-input"
                        value="{{ old('registered_participants',$event?->registered_participants ?? 0) }}">

                </div>

                <div class="admin-form-group">

                    <label class="admin-form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="admin-input"
                        required>

                        <option value="open">Open</option>
                        <option value="hampir penuh">Hampir Penuh</option>
                        <option value="penuh">Penuh</option>
                        <option value="selesai">Selesai</option>

                    </select>

                </div>

            </div>

            <div class="toggle-wrap">

                <label class="toggle-switch">

                    <input
                        type="checkbox"
                        name="is_published"
                        value="1"
                        {{ old('is_published',$event?->is_published) ? 'checked' : '' }}>

                    <span class="toggle-slider"></span>

                </label>

                <span class="toggle-label">
                    Publish Event
                </span>

            </div>

        </div>

        <div class="admin-card-body"
             style="border-top:1px solid var(--glass-border)">

            <button
                type="submit"
                class="btn-primary">

                <span>
                    {{ $event ? 'Update Event' : 'Simpan Event' }}
                </span>

            </button>

            <a
                href="{{ route('admin.events.index') }}"
                class="btn-outline">

                Batal

            </a>

        </div>

    </div>

</form>

@endsection