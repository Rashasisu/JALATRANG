{{--
    Variabel $maintenance dibagikan lewat View Composer (lihat AppServiceProvider):
    ['status' => NORMAL|WARNING|LOCKED, 'judul', 'deskripsi', 'mulai', 'selesai',
     'seconds_until_start', 'seconds_until_end', 'bypassed']
--}}

{{-- Banner bypass untuk admin --}}
<div id="maintenanceBypassBanner" class="mnt-bypass mnt-hidden">
    <span class="mnt-dot-green"></span>
    <span>Mode pemeliharaan aktif — Anda melihat situs sebagai administrator</span>
</div>

{{-- Peringatan (bar bawah) --}}
<div id="maintenanceWarningToast" class="mnt-toast mnt-hidden">
    <div class="mnt-toast-content">
        <div class="mnt-toast-left">
            <span class="mnt-toast-badge"><span class="mnt-toast-pulse"></span><span>PERINGATAN</span></span>
            <span class="mnt-toast-text">
                <strong id="toastMaintJudul">{{ $maintenance['judul'] }}</strong> — Mulai pukul <strong id="toastMaintMulai">{{ $maintenance['mulai'] }}</strong>. Harap simpan pekerjaan Anda!
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

{{-- Overlay kunci layar penuh. State awal dibaca maintenance.js dari data-attribute --}}
<div id="maintenanceLockOverlay" class="mnt-overlay mnt-hidden"
     data-status="{{ $maintenance['status'] }}"
     data-sec-start="{{ $maintenance['seconds_until_start'] }}"
     data-sec-end="{{ $maintenance['seconds_until_end'] }}"
     data-bypassed="{{ $maintenance['bypassed'] ? 1 : 0 }}"
     data-api="{{ route('api.maintenance-status') }}">
    <div class="mnt-card">
        <div class="mnt-logo-ring">
            <img src="{{ asset('assets/images/info_desa/logo.png') }}" alt="Logo Desa {{ $desa->nama_singkat }}" class="mnt-logo-img"
                 onerror="this.onerror=null; this.src='https://cdn-icons-png.flaticon.com/512/3067/3067257.png';">
        </div>

        <div class="mnt-badge"><span class="mnt-dot-amber"></span> 🔒 PEMELIHARAAN SISTEM TERJADWAL</div>

        <h1 class="mnt-title" id="lockTitle">{{ $maintenance['judul'] }}</h1>
        <p class="mnt-desc" id="lockDesc">{{ $maintenance['deskripsi'] }}</p>

        <div class="mnt-grid">
            @foreach (['cdDays' => 'Hari', 'cdHours' => 'Jam', 'cdMins' => 'Menit', 'cdSecs' => 'Detik'] as $id => $label)
                <div class="mnt-box">
                    <span class="mnt-num" id="{{ $id }}">00</span>
                    <span class="mnt-label">{{ $label }}</span>
                </div>
            @endforeach
        </div>

        <div class="mnt-info-pill">
            <span>🕒 Perkiraan Selesai: <strong id="lockSelesaiTime">{{ $maintenance['selesai'] }}</strong></span>
        </div>

        <div class="mnt-footer">
            <span class="mnt-footer-text">Pemerintah Desa {{ $desa->nama_singkat }}</span>
            <div style="display: flex !important; align-items: center !important; gap: 8px !important;">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="mnt-btn-logout">Keluar</button>
                    </form>
                @else
                    <a href="{{ url('login') }}" class="mnt-btn-login">Login Administrator &rarr;</a>
                @endauth
            </div>
        </div>
    </div>
</div>
