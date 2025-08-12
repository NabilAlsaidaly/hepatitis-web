<div class="sidebar">
    <ul class="nav flex-column text-end" dir="rtl">
        <li class="nav-item mb-3">
            <a class="nav-link d-flex align-items-center gap-2" href="{{ route('patient.dashboard') }}">
                <i class="bi bi-house-door"></i>
                <span>لوحة التحكم</span>
            </a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link d-flex align-items-center gap-2" href="{{ route('patient.info') }}">
                <i class="bi bi-person-circle"></i>
                <span>معلوماتي</span>
            </a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link d-flex align-items-center gap-2" href="{{ route('patient.records') }}">
                <i class="bi bi-clipboard2-pulse"></i>
                <span>التحاليل</span>
            </a>
        <li class="nav-item mb-3">
            <a class="nav-link d-flex align-items-center gap-2" href="{{ route('patient.diagnoses') }}">
                <i class="bi bi-clipboard-heart"></i>
                <span>تشخيص الطبيب</span>
            </a>
        </li>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link d-flex align-items-center gap-2" href="{{ route('patient.reports') }}">
                <i class="bi bi-file-earmark-text"></i>
                <span>التقارير</span>
            </a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link d-flex align-items-center gap-2" href="{{ route('patient.chart') }}">
                <i class="bi bi-graph-up-arrow"></i>
                <span>المخطط البياني</span>
            </a>
        </li>
    </ul>
</div>
