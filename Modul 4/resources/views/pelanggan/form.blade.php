<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($pelanggan) ? 'Ubah Data Pelanggan' : 'Tambah Pelanggan Baru' }} - Sistem Venue</title>
    <link rel="stylesheet" href="{{ asset('css/styling.css') }}">
</head>
<body>

    <header class="app-navbar">
        <div class="nav-container">
            <div class="nav-left">
                <a href="{{ route('dashboard') }}" class="nav-brand">
                    <div class="brand-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <span>Sistem<strong>Venue</strong></span>
                </a>
                <nav class="nav-links">
                    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                    <a href="{{ route('lapangan.index') }}" class="nav-link">Data Lapangan</a>
                    <a href="{{ route('pelanggan.index') }}" class="nav-link active">Data Pelanggan</a>
                </nav>
            </div>

            <div class="nav-right">
                <div class="user-profile-badge">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="user-info">
                        <span class="user-name">{{ auth()->user()->name }}</span>
                        <span class="badge-role role-{{ auth()->user()->role }}">{{ ucfirst(auth()->user()->role) }}</span>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="btn-logout" title="Keluar dari sistem">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="page-header">
            <p class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a> &gt; 
                <a href="{{ route('pelanggan.index') }}">Data Pelanggan</a> &gt; 
                {{ isset($pelanggan) ? 'Ubah Data' : 'Tambah Baru' }}
            </p>
            <h1>{{ isset($pelanggan) ? 'Ubah Data Pelanggan' : 'Tambah Pelanggan Baru' }}</h1>
            <p>Silakan isi detail keanggotaan dan profil pelanggan venue.</p>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-card-wide" style="margin-top: 0;">
            <form action="{{ isset($pelanggan) ? route('pelanggan.update', $pelanggan) : route('pelanggan.store') }}" method="POST">
                @csrf
                @if (isset($pelanggan))
                    @method('PUT')
                @endif

                <div class="form-grid-2">
                    <div class="col-span-2">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', $pelanggan->nama ?? '') }}" placeholder="Contoh: Budi Santoso" required>
                    </div>

                    <div>
                        <label>Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $pelanggan->email ?? '') }}" placeholder="contoh@domain.com">
                    </div>

                    <div>
                        <label>No. HP / WhatsApp</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $pelanggan->no_hp ?? '') }}" placeholder="Contoh: 081234567890">
                    </div>

                    <div>
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pelanggan->tanggal_lahir ?? '') }}">
                    </div>

                    <div>
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="laki-laki" @selected(old('jenis_kelamin', $pelanggan->jenis_kelamin ?? '') == 'laki-laki')>Laki-laki</option>
                            <option value="perempuan" @selected(old('jenis_kelamin', $pelanggan->jenis_kelamin ?? '') == 'perempuan')>Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label>Level Keanggotaan</label>
                        <select name="level_member">
                            <option value="basic" @selected(old('level_member', $pelanggan->level_member ?? 'basic') == 'basic')>Basic</option>
                            <option value="gold" @selected(old('level_member', $pelanggan->level_member ?? 'basic') == 'gold')>Gold</option>
                            <option value="vip" @selected(old('level_member', $pelanggan->level_member ?? 'basic') == 'vip')>VIP</option>
                        </select>
                    </div>

                    <div>
                        <label>Status Keanggotaan</label>
                        <select name="status">
                            <option value="aktif" @selected(old('status', $pelanggan->status ?? 'aktif') == 'aktif')>Aktif</option>
                            <option value="nonaktif" @selected(old('status', $pelanggan->status ?? 'aktif') == 'nonaktif')>Nonaktif</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label>Alamat Domisili</label>
                        <textarea name="alamat" rows="3" placeholder="Alamat lengkap domisili pelanggan...">{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
                    </div>
                </div>

                <div style="display: flex; gap: 12px; margin-top: 24px; padding-top: 18px; border-top: 1px solid var(--border-color);">
                    <button type="submit" class="btn btn-primary">Simpan Data Pelanggan</button>
                    <a href="{{ route('pelanggan.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
