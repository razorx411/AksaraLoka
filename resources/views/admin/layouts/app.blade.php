<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — AksaraLoka Admin</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* ── Admin Layout ───────────────────────────────── */
        .admin-sidebar {
            background: #3d1f00;
            width: 220px;
            min-height: 100vh;
            position: fixed;
            left: 0; top: 0;
            display: flex;
            flex-direction: column;
            z-index: 50;
        }
        .admin-sidebar .brand {
            padding: 1.5rem 1.25rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .admin-sidebar .brand-title {
            font-family: 'Lexend', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: #fff;
            line-height: 1.2;
        }
        .admin-sidebar .brand-sub {
            font-size: 0.65rem;
            color: rgba(255,255,255,0.45);
            font-weight: 500;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }
        .admin-sidebar .nav-section-label {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.35);
            padding: 0.75rem 1.25rem 0.25rem;
        }
        .admin-nav-item {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.6rem 1.25rem;
            margin: 0.1rem 0.6rem;
            border-radius: 0.6rem;
            font-size: 0.82rem;
            font-weight: 500;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            transition: all 0.15s ease;
        }
        .admin-nav-item:hover {
            background: rgba(255,255,255,0.08);
            color: #fff;
        }
        .admin-nav-item.active {
            background: rgba(244,215,161,0.15);
            color: #f4d7a1;
            font-weight: 600;
            border-left: 3px solid #f4d7a1;
            margin-left: 0.4rem;
            padding-left: calc(1.25rem + 0.2rem);
        }
        .admin-nav-item .material-symbols-outlined {
            font-size: 1.1rem;
            opacity: 0.8;
        }
        .admin-nav-item.active .material-symbols-outlined {
            opacity: 1;
        }
        .admin-main {
            margin-left: 220px;
            min-height: 100vh;
            background: #f6f3f2;
        }
        .admin-topbar {
            background: #fff;
            border-bottom: 1px solid #e4e2e1;
            padding: 0.8rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 40;
        }
        .admin-content {
            padding: 1.5rem;
        }
        /* ── Admin Cards ─────────────────────────────────── */
        .a-card {
            background: #fff;
            border-radius: 0.875rem;
            border: 1px solid #eae8e7;
            overflow: hidden;
        }
        .a-card-header {
            padding: 1rem 1.25rem 0.75rem;
            border-bottom: 1px solid #f0eded;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .a-card-body {
            padding: 1.25rem;
        }
        /* ── Stat card ───────────────────────────────────── */
        .stat-card {
            background: #fff;
            border-radius: 0.875rem;
            border: 1px solid #eae8e7;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.9rem;
        }
        .stat-icon {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.6rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .stat-icon.brown  { background: #f4d7a1; color: #6b3f00; }
        .stat-icon.amber  { background: #ffc64133; color: #795900; }
        .stat-icon.green  { background: #a4f79233; color: #005503; }
        .stat-icon.red    { background: #ffdad633; color: #ba1a1a; }
        .stat-value { font-size: 1.4rem; font-weight: 700; color: #1b1c1c; line-height: 1; }
        .stat-label { font-size: 0.72rem; color: #404943; font-weight: 500; margin-top: 0.15rem; }
        /* ── Table ───────────────────────────────────────── */
        .a-table { width: 100%; border-collapse: collapse; }
        .a-table th {
            text-align: left;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #707973;
            padding: 0.6rem 0.75rem;
            background: #f6f3f2;
            border-bottom: 1px solid #e4e2e1;
        }
        .a-table td {
            padding: 0.75rem 0.75rem;
            font-size: 0.82rem;
            color: #1b1c1c;
            border-bottom: 1px solid #f0eded;
            vertical-align: middle;
        }
        .a-table tbody tr:last-child td { border-bottom: none; }
        .a-table tbody tr:hover td { background: #f6f3f2; }
        /* ── Badge ───────────────────────────────────────── */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.15rem 0.5rem;
            border-radius: 99px;
            font-size: 0.68rem;
            font-weight: 600;
        }
        .badge-active  { background: #a4f79233; color: #005503; }
        .badge-inactive{ background: #ffdad6;   color: #93000a; }
        .badge-brown   { background: #f4d7a1;   color: #6b3f00; }
        .badge-amber   { background: #ffc64133; color: #5c4300; }
        /* ── Btn ─────────────────────────────────────────── */
        .btn-primary {
            display: inline-flex; align-items: center; gap: 0.4rem;
            background: #6b3f00; color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 0.6rem;
            font-size: 0.8rem; font-weight: 600;
            border: none; cursor: pointer;
            text-decoration: none;
            transition: background 0.15s;
        }
        .btn-primary:hover { background: #8c5a12; }
        .btn-secondary {
            display: inline-flex; align-items: center; gap: 0.4rem;
            background: #f0eded; color: #1b1c1c;
            padding: 0.5rem 1rem;
            border-radius: 0.6rem;
            font-size: 0.8rem; font-weight: 600;
            border: none; cursor: pointer;
            text-decoration: none;
            transition: background 0.15s;
        }
        .btn-secondary:hover { background: #e4e2e1; }
        .btn-danger {
            display: inline-flex; align-items: center; gap: 0.4rem;
            background: #ffdad6; color: #93000a;
            padding: 0.5rem 1rem;
            border-radius: 0.6rem;
            font-size: 0.8rem; font-weight: 600;
            border: none; cursor: pointer;
            text-decoration: none;
            transition: background 0.15s;
        }
        .btn-danger:hover { background: #ffb4ab; }
        .btn-icon {
            display: inline-flex; align-items: center; justify-content: center;
            width: 1.9rem; height: 1.9rem;
            border-radius: 0.45rem;
            border: none; cursor: pointer;
            text-decoration: none;
            transition: background 0.15s;
            font-size: 1rem;
        }
        .btn-icon-edit   { background: #f4d7a133; color: #6b3f00; }
        .btn-icon-edit:hover { background: #f4d7a1; }
        .btn-icon-del    { background: #ffdad633; color: #93000a; }
        .btn-icon-del:hover  { background: #ffdad6; }
        /* ── Form ────────────────────────────────────────── */
        .a-form-group { margin-bottom: 1.1rem; }
        .a-label {
            display: block;
            font-size: 0.75rem; font-weight: 600;
            color: #404943;
            margin-bottom: 0.35rem;
        }
        .a-input, .a-select, .a-textarea {
            width: 100%;
            padding: 0.6rem 0.85rem;
            background: #f6f3f2;
            border: 1.5px solid #e4e2e1;
            border-radius: 0.6rem;
            font-size: 0.85rem;
            color: #1b1c1c;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: border-color 0.15s;
            outline: none;
        }
        .a-input:focus, .a-select:focus, .a-textarea:focus {
            border-color: #6b3f00;
            background: #fff;
        }
        .a-textarea { resize: vertical; min-height: 100px; }
        .a-error { font-size: 0.72rem; color: #ba1a1a; margin-top: 0.25rem; font-weight: 500; }
        /* ── Alert/flash ─────────────────────────────────── */
        .a-alert {
            padding: 0.75rem 1rem;
            border-radius: 0.6rem;
            font-size: 0.82rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .a-alert-success { background: #a4f79233; color: #005503; border: 1px solid #89da7944; }
        .a-alert-error   { background: #ffdad6;   color: #93000a; border: 1px solid #ffb4ab55; }
        /* ── Pagination override ─────────────────────────── */
        .pagination-admin nav { display: flex; justify-content: flex-end; }
        /* ── Chapter card ────────────────────────────────── */
        .chapter-card {
            background: #fff;
            border: 1.5px solid #e4e2e1;
            border-radius: 0.875rem;
            padding: 1rem 1.1rem;
            transition: border-color 0.15s, box-shadow 0.15s;
        }
        .chapter-card:hover { border-color: #f4d7a1; box-shadow: 0 2px 12px #6b3f0015; }
        .chapter-card-add {
            border: 1.5px dashed #bfc9c1;
            border-radius: 0.875rem;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            gap: 0.5rem;
            padding: 1.5rem;
            cursor: pointer;
            transition: border-color 0.15s, background 0.15s;
            text-decoration: none;
            min-height: 120px;
        }
        .chapter-card-add:hover { border-color: #6b3f00; background: #f6f3f2; }
        /* ── Search bar ──────────────────────────────────── */
        .search-bar {
            display: flex;
            align-items: center;
            background: #f6f3f2;
            border: 1.5px solid #e4e2e1;
            border-radius: 0.6rem;
            padding: 0.45rem 0.75rem;
            gap: 0.4rem;
        }
        .search-bar input {
            background: transparent;
            border: none;
            outline: none;
            font-size: 0.82rem;
            color: #1b1c1c;
            font-family: 'Plus Jakarta Sans', sans-serif;
            width: 200px;
        }
        .search-bar .material-symbols-outlined { font-size: 1rem; color: #707973; }
        /* ── Avatar circle ───────────────────────────────── */
        .a-avatar {
            width: 2rem; height: 2rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #f4d7a1, #6b3f00);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.75rem; font-weight: 700; color: #fff;
            flex-shrink: 0;
        }
        /* ── Page title area ─────────────────────────────── */
        .page-header {
            margin-bottom: 1.25rem;
        }
        .page-title { font-size: 1.2rem; font-weight: 700; color: #1b1c1c; }
        .page-sub   { font-size: 0.78rem; color: #707973; margin-top: 0.1rem; }
    </style>
</head>
<body style="font-family: 'Plus Jakarta Sans', sans-serif; background: #f6f3f2; color: #1b1c1c;">

<!-- ── Admin Sidebar ─────────────────────────────────────── -->
<aside class="admin-sidebar">
    <!-- Brand -->
    <div class="brand">
        <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.25rem;">
            <div style="width:1.8rem;height:1.8rem;background:linear-gradient(135deg,#f4d7a1,#8c5a12);border-radius:0.4rem;display:flex;align-items:center;justify-content:center;">
                <span class="material-symbols-outlined" style="font-size:1rem;color:#fff;font-variation-settings:'FILL' 1">auto_stories</span>
            </div>
            <div>
                <div class="brand-title">AksaraLoka</div>
            </div>
        </div>
        <div class="brand-sub">Admin Panel</div>
    </div>

    <!-- Navigation -->
    <div style="flex:1;padding:0.75rem 0;overflow-y:auto;">
        <div class="nav-section-label">Utama</div>

        <a href="{{ route('admin.dashboard') }}"
           class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="material-symbols-outlined">dashboard</span>
            Dashboard
        </a>

        <div class="nav-section-label" style="margin-top:0.5rem;">Konten</div>

        <a href="{{ route('admin.chapters.index') }}"
           class="admin-nav-item {{ request()->routeIs('admin.chapters*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">layers</span>
            Chapter
        </a>

        <a href="{{ route('admin.sub-chapters.index') }}"
           class="admin-nav-item {{ request()->routeIs('admin.sub-chapters*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">format_list_bulleted</span>
            Sub-Chapter
        </a>

        <a href="{{ route('admin.levels.index') }}"
           class="admin-nav-item {{ request()->routeIs('admin.levels*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">format_list_numbered</span>
            Level
        </a>

        <a href="{{ route('admin.questions.index') }}"
           class="admin-nav-item {{ request()->routeIs('admin.questions*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">quiz</span>
            Soal
        </a>

        <a href="{{ route('admin.libraries.index') }}"
           class="admin-nav-item {{ request()->routeIs('admin.libraries*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">auto_stories</span>
            Perpustakaan
        </a>

        <div class="nav-section-label" style="margin-top:0.5rem;">Pengguna</div>

        <a href="{{ route('admin.users.index') }}"
           class="admin-nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">group</span>
            Pengguna
        </a>

        <div class="nav-section-label" style="margin-top:0.5rem;">Sistem</div>

        <a href="{{ route('admin.notifications.index') }}"
           class="admin-nav-item {{ request()->routeIs('admin.notifications*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">notifications</span>
            Notifikasi
        </a>
    </div>

    <!-- Bottom: back to app + logout -->
    <div style="padding:0.75rem 0.75rem 1rem;border-top:1px solid rgba(255,255,255,0.08);display:flex;flex-direction:column;gap:0.4rem;">
        <a href="{{ route('home') }}"
           style="display:flex;align-items:center;gap:0.6rem;padding:0.5rem 0.75rem;border-radius:0.5rem;font-size:0.78rem;font-weight:500;color:rgba(255,255,255,0.55);text-decoration:none;transition:color 0.15s;"
           onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.55)'">
            <span class="material-symbols-outlined" style="font-size:1rem;">arrow_back</span>
            Ke Aplikasi
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    style="display:flex;align-items:center;gap:0.6rem;padding:0.5rem 0.75rem;border-radius:0.5rem;font-size:0.78rem;font-weight:500;color:rgba(255,120,120,0.75);background:none;border:none;cursor:pointer;width:100%;transition:color 0.15s;"
                    onmouseover="this.style.color='#ff8a80'" onmouseout="this.style.color='rgba(255,120,120,0.75)'">
                <span class="material-symbols-outlined" style="font-size:1rem;">logout</span>
                Keluar
            </button>
        </form>
    </div>
</aside>

<!-- ── Main Content ───────────────────────────────────────── -->
<div class="admin-main">
    <!-- Topbar -->
    <div class="admin-topbar">
        <div style="display:flex;align-items:center;gap:0.5rem;">
            <span style="font-size:0.75rem;color:#707973;">Admin Panel</span>
            <span class="material-symbols-outlined" style="font-size:0.85rem;color:#bfc9c1;">chevron_right</span>
            <span style="font-size:0.82rem;font-weight:600;color:#1b1c1c;">@yield('breadcrumb', 'Dashboard')</span>
        </div>
        <div style="display:flex;align-items:center;gap:0.75rem;">
            <div style="display:flex;align-items:center;gap:0.5rem;">
                <div style="width:1.8rem;height:1.8rem;border-radius:50%;background:linear-gradient(135deg,#f4d7a1,#6b3f00);display:flex;align-items:center;justify-content:center;">
                    <span style="font-size:0.7rem;font-weight:700;color:#fff;">{{ strtoupper(substr(auth()->user()->username, 0, 1)) }}</span>
                </div>
                <span style="font-size:0.8rem;font-weight:600;color:#1b1c1c;">{{ auth()->user()->username }}</span>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="admin-content">
        @if(session('success'))
        <div class="a-alert a-alert-success">
            <span class="material-symbols-outlined" style="font-size:1rem;vertical-align:middle;margin-right:0.25rem;">check_circle</span>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="a-alert a-alert-error">
            <span class="material-symbols-outlined" style="font-size:1rem;vertical-align:middle;margin-right:0.25rem;">error</span>
            {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </div>
</div>

@stack('scripts')
</body>
</html>
