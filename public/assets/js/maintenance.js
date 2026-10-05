    (function () {
        const cfg = window.APP || {};
        let currentState = "NORMAL";
        let secStart = 0, secEnd = 0;
        let isBypassed = !!cfg.isBypassed;

        function relocateElements() {
            const toast = document.getElementById('maintenanceWarningToast');
            const overlay = document.getElementById('maintenanceLockOverlay');
            const bypassBanner = document.getElementById('maintenanceBypassBanner');

            if (toast && toast.parentNode !== document.body) document.body.appendChild(toast);
            if (overlay && overlay.parentNode !== document.body) document.body.appendChild(overlay);
            if (bypassBanner && bypassBanner.parentNode !== document.body) document.body.appendChild(bypassBanner);
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', relocateElements);
        } else {
            relocateElements();
        }

        function updateUI() {
            relocateElements();
            const toast = document.getElementById('maintenanceWarningToast');
            const overlay = document.getElementById('maintenanceLockOverlay');
            const bypassBanner = document.getElementById('maintenanceBypassBanner');

            if (currentState === 'LOCKED') {
                if (isBypassed) {
                    if (overlay) overlay.classList.add('mnt-hidden');
                    if (bypassBanner) bypassBanner.classList.remove('mnt-hidden');
                    document.body.style.overflow = '';
                } else {
                    if (toast) toast.classList.add('mnt-hidden');
                    if (overlay) overlay.classList.remove('mnt-hidden');
                    document.body.style.overflow = 'hidden';
                }
            } else if (currentState === 'WARNING') {
                if (bypassBanner) bypassBanner.classList.add('mnt-hidden');
                if (overlay) overlay.classList.add('mnt-hidden');
                document.body.style.overflow = '';

                if (toast && !toastDismissed) {
                    toast.classList.remove('mnt-hidden');
                }
            } else {
                if (bypassBanner) bypassBanner.classList.add('mnt-hidden');
                if (toast) toast.classList.add('mnt-hidden');
                if (overlay) overlay.classList.add('mnt-hidden');
                document.body.style.overflow = '';
            }
        }

        function formatTime(totalSecs) {
            if (totalSecs < 0) totalSecs = 0;
            const d = Math.floor(totalSecs / 86400);
            const h = Math.floor((totalSecs % 86400) / 3600);
            const m = Math.floor((totalSecs % 3600) / 60);
            const s = Math.floor(totalSecs % 60);
            return {
                d: String(d).padStart(2, '0'),
                h: String(h).padStart(2, '0'),
                m: String(m).padStart(2, '0'),
                s: String(s).padStart(2, '0')
            };
        }

        function runCountdown() {
            if (timerInterval) clearInterval(timerInterval);

            timerInterval = setInterval(() => {
                if (currentState === 'WARNING') {
                    secStart--;
                    if (secStart <= 0) {
                        currentState = 'LOCKED';
                        updateUI();
                    } else {
                        const t = formatTime(secStart);
                        const cdToast = document.getElementById('toastMaintCountdown');
                        if (cdToast) cdToast.innerText = `${t.h}:${t.m}:${t.s}`;
                    }
                } else if (currentState === 'LOCKED') {
                    secEnd--;
                    if (secEnd <= 0) {
                        currentState = 'NORMAL';
                        updateUI();
                        // Automatically reload page when countdown reaches 0 to restore normal state!
                        setTimeout(() => {
                            window.location.reload();
                        }, 600);
                    } else {
                        const t = formatTime(secEnd);
                        const elD = document.getElementById('cdDays');
                        const elH = document.getElementById('cdHours');
                        const elM = document.getElementById('cdMins');
                        const elS = document.getElementById('cdSecs');

                        if (elD) elD.innerText = t.d;
                        if (elH) elH.innerText = t.h;
                        if (elM) elM.innerText = t.m;
                        if (elS) elS.innerText = t.s;
                    }
                }
            }, 1000);
        }

        function checkStatusAPI() {
            fetch(cfg.maintenanceUrl)
                .then(r => r.json())
                .then(res => {
                    if (!res) return;
                    let prevState = currentState;
                    currentState = res.status;
                    secStart = res.seconds_until_start;
                    secEnd = res.seconds_until_end;

                    const titleEl = document.getElementById('lockTitle');
                    const descEl = document.getElementById('lockDesc');
                    const selesaiEl = document.getElementById('lockSelesaiTime');
                    const toastJudul = document.getElementById('toastMaintJudul');
                    const toastMulai = document.getElementById('toastMaintMulai');

                    if (titleEl) titleEl.innerText = res.judul || 'Pemeliharaan Sistem';
                    if (descEl) descEl.innerText = res.deskripsi || '';
                    if (selesaiEl) selesaiEl.innerText = res.formatted_selesai || '-';
                    if (toastJudul) toastJudul.innerText = res.judul || 'Pemeliharaan Sistem';
                    if (toastMulai) toastMulai.innerText = res.formatted_mulai || '-';

                    updateUI();

                    // If system was locked and now API returns NORMAL, auto reload page!
                    if (prevState === 'LOCKED' && currentState === 'NORMAL') {
                        setTimeout(() => {
                            window.location.reload();
                        }, 600);
                    } else {
                        runCountdown();
                    }
                })
                .catch(err => console.error('Maintenance API check error:', err));
        }

        window.dismissMaintToast = function () {
            toastDismissed = true;
            const toast = document.getElementById('maintenanceWarningToast');
            if (toast) toast.classList.add('mnt-hidden');
        };

        // Periodic refresh check only if maintenance is currently active
        updateUI();
        runCountdown();
        checkStatusAPI();
            })();
