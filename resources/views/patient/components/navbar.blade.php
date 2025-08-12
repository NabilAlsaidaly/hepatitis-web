<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow-sm">
    <div class="container-fluid">

        {{-- ✅ العنوان – في اليمين --}}
        <span class="navbar-brand d-flex align-items-center">
            <i class="bi bi-heart-pulse-fill me-2"></i>
            الملف الطبي الشخصي
        </span>

        {{-- ✅ مسافة تفصل بين العنوان والزر --}}
        <div class="flex-grow-1"></div>

        {{-- ✅ زر تسجيل الخروج – في اليسار --}}
        <form method="POST" action="{{ route('patient.logout') }}">
            @csrf
            <button class="btn btn-outline-light btn-sm d-flex align-items-center" type="submit">
                <i class="bi bi-box-arrow-right ms-1"></i> تسجيل الخروج
            </button>
        </form>

    </div>
</nav>
