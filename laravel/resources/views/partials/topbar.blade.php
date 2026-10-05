<div class="topbar">
    <div class="container-fluid px-lg-4 px-3 d-flex align-items-center justify-content-between gap-3">
        <div class="d-flex align-items-center gap-2 overflow-hidden" style="flex:1">
            <span class="topbar-badge text-nowrap"><i class="fas fa-bullhorn me-1"></i> INFO TERKINI</span>
            <div class="news-flash-wrapper">
                <div class="news-flash-scroll">
                    @foreach ($infoTerkini as $info)
                        <span class="me-5 text-white-50">
                            <i class="far fa-circle text-warning me-1" style="font-size:0.5rem"></i> {{ $info->isi }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="d-none d-md-flex align-items-center gap-3 text-nowrap text-white-50" style="font-size:0.75rem">
            <span><i class="far fa-clock text-warning me-1"></i> {{ now()->locale('id')->translatedFormat('l, j F Y') }}</span>
        </div>
    </div>
</div>
