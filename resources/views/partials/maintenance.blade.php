<!-- WARNING BAR (1-LINE SLIM BOTTOM BANNER) -->
<div id="maintenanceWarningToast" class="mnt-toast mnt-hidden">
    <div class="mnt-toast-content">
        <div class="mnt-toast-left">
            <span class="mnt-toast-badge">
                <span class="mnt-toast-pulse"></span>
                <span>PERINGATAN</span>
            </span>
            <span class="mnt-toast-text">
                <strong id="toastMaintJudul">Pemeliharaan Server &amp; Update Sistem</strong> — Mulai pukul <strong id="toastMaintMulai">21:00 WIB</strong>. Harap simpan pekerjaan Anda!
            </span>
        </div>
        <div class="mnt-toast-right">
            <div class="mnt-toast-timer-pill">
                <span style="color: #94a3b8;">Mulai dalam:</span>
                <span id="toastMaintCountdown" class="mnt-toast-countdown">00:00:00</span>
            </div>
            <button onclick="dismissMaintToast()" type="button" class="mnt-toast-close" title="Tutup peringatan ini">✕</button>
        </div>
    </div>
</div>

<!-- FULLSCREEN SYSTEM LOCK OVERLAY -->
<div id="maintenanceLockOverlay" class="mnt-overlay mnt-hidden">

    <div class="mnt-card">

        <!-- LOGO & GLOW RING HEADER -->
        <div class="mnt-logo-ring">
            <img src="{{ asset('assets/images/info_desa/logo.png') }}" onerror="this.onerror=null; this.src='https://cdn-icons-png.flaticon.com/512/3067/3067257.png';" alt="Logo Desa Jalatrang" class="mnt-logo-img">
        </div>

        <!-- BADGE -->
        <div class="mnt-badge">
            <span class="mnt-dot-amber"></span>
            🔒 PEMELIHARAAN SISTEM TERJADWAL
        </div>

        <!-- TITLE -->
        <h1 class="mnt-title" id="lockTitle">
            Pemeliharaan Server &amp; Update Sistem
        </h1>

        <!-- DESCRIPTION -->
        <p class="mnt-desc" id="lockDesc">
            Perbaikan module ketahanan pangan
        </p>

        <!-- LIVE COUNTDOWN GRID -->
        <div class="mnt-grid">
            <div class="mnt-box">
                <span class="mnt-num" id="cdDays">00</span>
                <span class="mnt-label">Hari</span>
            </div>
            <div class="mnt-box">
                <span class="mnt-num" id="cdHours">00</span>
                <span class="mnt-label">Jam</span>
            </div>
            <div class="mnt-box">
                <span class="mnt-num" id="cdMins">00</span>
                <span class="mnt-label">Menit</span>
            </div>
            <div class="mnt-box">
                <span class="mnt-num" id="cdSecs">00</span>
                <span class="mnt-label">Detik</span>
            </div>
        </div>

        <!-- ESTIMATED COMPLETION & INFO -->
        <div class="mnt-info-pill">
            <span>🕒 Perkiraan Selesai: <strong id="lockSelesaiTime">16 Aug 2026, 21:15 WIB</strong></span>
        </div>

        <!-- FOOTER / LOGIN / LOGOUT ACTION -->
        <div class="mnt-footer">
            <span class="mnt-footer-text">
                                    Pemerintah Desa Jalatrang
                            </span>
            <div style="display: flex !important; align-items: center !important; gap: 8px !important;">
                                    <a href="{{ url('/login') }}" class="mnt-btn-login">
                        Login Administrator &rarr;
                    </a>
                            </div>
        </div>
    </div>
</div>
