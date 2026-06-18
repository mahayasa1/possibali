@extends('layouts.admin')

@section('title', $club ? 'Edit Club' : 'Tambah Club')
@section('page-title', $club ? 'Edit Club' : 'Tambah Club')
@section('page-subtitle', $club ? 'Perbarui informasi club' : 'Buat club baru')

@section('content')

<form
    action="{{ $club
        ? route('admin.clubs.update',$club)
        : route('admin.clubs.store') }}"
    method="POST">

    @csrf

    @if($club)
        @method('PUT')
    @endif

    <div class="admin-card">

        <div class="admin-card-header">

            <h2 class="admin-card-title">

                {{ $club ? 'Edit Club' : 'Tambah Club' }}

            </h2>

        </div>

        <div class="admin-card-body">

            <div class="admin-form-group">

                <label class="admin-form-label">
                    Nama Club
                </label>

                <input
                    type="text"
                    name="name"
                    class="admin-input"
                    value="{{ old('name',$club?->name) }}"
                    required>

            </div>

            <div class="form-row-3">

                <div class="admin-form-group">

                    <label class="admin-form-label">
                        Kota
                    </label>

                    <input
                        type="text"
                        name="city"
                        class="admin-input"
                        value="{{ old('city',$club?->city) }}"
                        required>

                </div>

                <div class="admin-form-group">

                    <label class="admin-form-label">
                        Area
                    </label>

                    <input
                        type="text"
                        name="area"
                        class="admin-input"
                        value="{{ old('area',$club?->area) }}"
                        required>

                </div>

                <div class="admin-form-group">

                    <label class="admin-form-label">
                        Icon
                    </label>

                    <input
                        type="text"
                        name="icon"
                        class="admin-input"
                        value="{{ old('icon',$club?->icon) }}"
                        placeholder="🤿">

                </div>

            </div>

            <div class="form-row-3">

                <div class="admin-form-group">

                    <label class="admin-form-label">
                        Tahun Berdiri
                    </label>

                    <input
                        type="number"
                        name="established_year"
                        class="admin-input"
                        value="{{ old('established_year',$club?->established_year) }}"
                        required>

                </div>

                <div class="admin-form-group">

                    <label class="admin-form-label">
                        Jumlah Member
                    </label>

                    <input
                        type="number"
                        name="member_count"
                        class="admin-input"
                        value="{{ old('member_count',$club?->member_count) }}"
                        required>

                </div>

                <div class="admin-form-group">

                    <label class="admin-form-label">
                        Spesialisasi
                    </label>

                    <input
                        type="text"
                        name="specialty"
                        class="admin-input"
                        value="{{ old('specialty',$club?->specialty) }}">

                </div>

            </div>

            <div class="admin-form-group">

                <label class="admin-form-label">
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    class="admin-input"
                    rows="5">{{ old('description',$club?->description) }}</textarea>

            </div>

            <div class="form-row-2">

                <div class="admin-form-group">

                    <label class="admin-form-label">
                        Telepon
                    </label>

                    <input
                        type="text"
                        name="contact_phone"
                        class="admin-input"
                        value="{{ old('contact_phone',$club?->contact_phone) }}">

                </div>

                <div class="admin-form-group">

                    <label class="admin-form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="contact_email"
                        class="admin-input"
                        value="{{ old('contact_email',$club?->contact_email) }}">

                </div>

            </div>

            <hr style="margin:20px 0;border-color:var(--glass-border);">

            <div style="display:flex;gap:30px;flex-wrap:wrap;">

                <div class="toggle-wrap">

                    <label class="toggle-switch">
                        <input
                            type="checkbox"
                            name="is_verified"
                            value="1"
                            {{ old('is_verified',$club?->is_verified) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>

                    <span class="toggle-label">
                        Club Verified
                    </span>

                </div>

                <div class="toggle-wrap">

                    <label class="toggle-switch">
                        <input
                            type="checkbox"
                            name="is_champion"
                            value="1"
                            {{ old('is_champion',$club?->is_champion) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>

                    <span class="toggle-label">
                        Club Champion
                    </span>

                </div>

                <div class="toggle-wrap">

                    <label class="toggle-switch">
                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            {{ old('is_active',$club?->is_active ?? true) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>

                    <span class="toggle-label">
                        Aktif
                    </span>

                </div>

            </div>

        </div>

        <div class="admin-card-body"
             style="border-top:1px solid var(--glass-border)">

            <button type="submit" class="btn-primary">
                <span>
                    {{ $club ? 'Update Club' : 'Simpan Club' }}
                </span>
            </button>

            <a href="{{ route('admin.clubs.index') }}"
               class="btn-outline">

                Batal

            </a>

        </div>

    </div>

</form>

@endsection