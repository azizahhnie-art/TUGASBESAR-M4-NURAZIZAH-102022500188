<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Venue</title>
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
                    <a href="{{ route('dashboard') }}" class="nav-link active">Dashboard</a>
                    <a href="{{ route('lapangan.index') }}" class="nav-link">Data Lapangan</a>
                    @if (in_array(auth()->user()->role, ['admin', 'staff']))
                        <a href="{{ route('pelanggan.index') }}" class="nav-link">Data Pelanggan</a>
                    @endif
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
        <div class="dashboard-hero">
            <div class="hero-content">
                <div class="hero-tag">
                    <span class="status-indicator"></span> Sesi Login Aktif
                </div>
                <h1>Selamat datang, {{ auth()->user()->name }}! 👋</h1>
                <p>
                    Anda masuk ke dalam sistem dengan hak akses sebagai 
                    <span class="hero-role-pill role-{{ auth()->user()->role }}">{{ ucfirst(auth()->user()->role) }}</span>
                </p>
            </div>
            <div class="hero-meta">
                <div class="meta-item">
                    <span class="meta-label">Email Terdaftar</span>
                    <span class="meta-val">{{ auth()->user()->email }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Bergabung Sejak</span>
                    <span class="meta-val">{{ auth()->user()->created_at ? auth()->user()->created_at->format('d M Y') : '-' }}</span>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert-success">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('pesan'))
            <div class="alert-success">
                <span>{{ session('pesan') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="alert-error">
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="dashboard-grid">
            <div class="dashboard-col-main" style="display: flex; flex-direction: column; gap: 20px;">
                <div class="card module-card highlight">
                    <div class="card-icon-wrapper">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                            <line x1="12" y1="4" x2="12" y2="20"></line>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </div>
                    <div class="module-details">
                        <h3>Kelola Data Lapangan & Fasilitas</h3>
                        <p>Akses daftar lapangan, jenis lantai / permukaan, ukuran fisik, status kondisi lapangan, dan foto fasilitas olahraga venue.</p>
                        <div class="module-actions">
                            <a href="{{ route('lapangan.index') }}" class="btn btn-primary">
                                Buka Data Lapangan
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </a>
                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('lapangan.create') }}" class="btn btn-outline">
                                    + Tambah Lapangan
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                @if (in_array(auth()->user()->role, ['admin', 'staff']))
                    <div class="card module-card highlight" style="border-left-color: #10b981;">
                        <div class="card-icon-wrapper" style="background-color: #dcfce7; color: #15803d;">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <div class="module-details">
                            <h3>Kelola Pelanggan & Member Venue</h3>
                            <p>Akses direktori pengguna, data keanggotaan (Basic, Gold, VIP), filter pencarian, dan pengaturan status pelanggan.</p>
                            <div class="module-actions">
                                <a href="{{ route('pelanggan.index') }}" class="btn btn-primary" style="background-color: #10b981;">
                                    Buka Data Pelanggan
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                </a>
                                @can('create', \App\Models\Pelanggan::class)
                                    <a href="{{ route('pelanggan.create') }}" class="btn btn-outline" style="color: #10b981; border-color: #a7f3d0;">
                                        + Tambah Pelanggan
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card member-info-card">
                        <div class="member-card-header">
                            <div class="member-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                            </div>
                            <div>
                                <h3>Informasi Akun Member</h3>
                                <p class="text-muted">Akses Eksklusif Pengguna Venue</p>
                            </div>
                        </div>
                        <div class="member-card-body">
                            <p>Akun Anda terdaftar dengan tingkatan <strong>Member</strong>. Anda dapat melihat informasi fasilitas dan ketersediaan lapangan olahraga.</p>
                            <div class="alert-info">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                <span>Modul pengelolaan pelanggan hanya dapat diakses oleh <strong>Admin</strong> dan <strong>Staff</strong> venue.</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="dashboard-col-side">
                <div class="card permission-card">
                    <div class="card-title-row">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <h4>Ringkasan Hak Akses Anda</h4>
                    </div>
                    <ul class="permission-list">
                        <li class="active">
                            <span class="icon-check">✓</span>
                            <div>
                                <strong>Akses Dashboard</strong>
                                <small>Melihat beranda dan profil akun</small>
                            </div>
                        </li>
                        <li class="active">
                            <span class="icon-check">✓</span>
                            <div>
                                <strong>Lihat Data Lapangan</strong>
                                <small>Melihat daftar & foto lapangan venue</small>
                            </div>
                        </li>
                        <li class="{{ auth()->user()->role === 'admin' ? 'active' : 'disabled' }}">
                            <span class="icon-check">{{ auth()->user()->role === 'admin' ? '✓' : '✕' }}</span>
                            <div>
                                <strong>Kelola Lapangan (CRUD)</strong>
                                <small>Tambah, edit & hapus data lapangan</small>
                            </div>
                        </li>
                        <li class="{{ in_array(auth()->user()->role, ['admin', 'staff']) ? 'active' : 'disabled' }}">
                            <span class="icon-check">{{ in_array(auth()->user()->role, ['admin', 'staff']) ? '✓' : '✕' }}</span>
                            <div>
                                <strong>Lihat & Kelola Pelanggan</strong>
                                <small>Akses daftar member & pelanggan</small>
                            </div>
                        </li>
                        <li class="{{ auth()->user()->role === 'admin' ? 'active' : 'disabled' }}">
                            <span class="icon-check">{{ auth()->user()->role === 'admin' ? '✓' : '✕' }}</span>
                            <div>
                                <strong>Hapus Data Pelanggan</strong>
                                <small>Khusus hak akses Administrator</small>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
