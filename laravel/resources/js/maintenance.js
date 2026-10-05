// resources/js/maintenance.js
// State awal dikirim server lewat data-attribute pada #maintenanceLockOverlay
// (lihat resources/views/partials/maintenance.blade.php).

const overlay = document.getElementById('maintenanceLockOverlay');

if (overlay) {
    let currentState = overlay.dataset.status || 'NORMAL';
    let secStart = parseInt(overlay.dataset.secStart, 10) || 0;
    let secEnd = parseInt(overlay.dataset.secEnd, 10) || 0;
    const isBypassed = overlay.dataset.bypassed === '1';
    const apiUrl = overlay.dataset.api;
    let toastDismissed = false;
    let timerInterval = null;
    let pollInterval = null;

    const $id = (id) => document.getElementById(id);

    function updateUI() {
        const toast = $id('maintenanceWarningToast');
        const bypassBanner = $id('maintenanceBypassBanner');

        if (currentState === 'LOCKED') {
            if (isBypassed) {
                overlay.classList.add('mnt-hidden');
                bypassBanner?.classList.remove('mnt-hidden');
                document.body.style.overflow = '';
            } else {
                toast?.classList.add('mnt-hidden');
                overlay.classList.remove('mnt-hidden');
                document.body.style.overflow = 'hidden';
            }
        } else if (currentState === 'WARNING') {
            bypassBanner?.classList.add('mnt-hidden');
            overlay.classList.add('mnt-hidden');
            document.body.style.overflow = '';
            if (toast && !toastDismissed) toast.classList.remove('mnt-hidden');
        } else {
            bypassBanner?.classList.add('mnt-hidden');
            toast?.classList.add('mnt-hidden');
            overlay.classList.add('mnt-hidden');
            document.body.style.overflow = '';
        }
    }

    function formatTime(totalSecs) {
        totalSecs = Math.max(0, totalSecs);
        const pad = (n) => String(n).padStart(2, '0');
        return {
            d: pad(Math.floor(totalSecs / 86400)),
            h: pad(Math.floor((totalSecs % 86400) / 3600)),
            m: pad(Math.floor((totalSecs % 3600) / 60)),
            s: pad(Math.floor(totalSecs % 60)),
        };
    }

    function runCountdown() {
        clearInterval(timerInterval);
        timerInterval = setInterval(() => {
            if (currentState === 'WARNING') {
                secStart--;
                if (secStart <= 0) {
                    currentState = 'LOCKED';
                    updateUI();
                } else {
                    const t = formatTime(secStart);
                    const el = $id('toastMaintCountdown');
                    if (el) el.innerText = `${t.h}:${t.m}:${t.s}`;
                }
            } else if (currentState === 'LOCKED') {
                secEnd--;
                if (secEnd <= 0) {
                    currentState = 'NORMAL';
                    updateUI();
                    setTimeout(() => window.location.reload(), 600);
                } else {
                    const t = formatTime(secEnd);
                    $id('cdDays').innerText = t.d;
                    $id('cdHours').innerText = t.h;
                    $id('cdMins').innerText = t.m;
                    $id('cdSecs').innerText = t.s;
                }
            }
        }, 1000);
    }

    function checkStatusAPI() {
        if (!apiUrl) return;
        fetch(apiUrl, { headers: { Accept: 'application/json' } })
            .then((r) => r.json())
            .then((res) => {
                if (!res) return;
                const prevState = currentState;
                currentState = res.status;
                secStart = res.seconds_until_start;
                secEnd = res.seconds_until_end;

                const set = (id, val) => { const el = $id(id); if (el) el.innerText = val; };
                set('lockTitle', res.judul || 'Pemeliharaan Sistem');
                set('lockDesc', res.deskripsi || '');
                set('lockSelesaiTime', res.formatted_selesai || '-');
                set('toastMaintJudul', res.judul || 'Pemeliharaan Sistem');
                set('toastMaintMulai', res.formatted_mulai || '-');

                updateUI();

                if (prevState === 'LOCKED' && currentState === 'NORMAL') {
                    setTimeout(() => window.location.reload(), 600);
                } else {
                    runCountdown();
                }
            })
            .catch((err) => console.error('Maintenance API check error:', err));
    }

    window.dismissMaintToast = function () {
        toastDismissed = true;
        $id('maintenanceWarningToast')?.classList.add('mnt-hidden');
    };

    updateUI();
    runCountdown();

    // Sinkronisasi berkala ke server hanya saat pemeliharaan sedang/akan berlangsung
    if (currentState !== 'NORMAL') {
        pollInterval = setInterval(checkStatusAPI, 60000);
    }
}
