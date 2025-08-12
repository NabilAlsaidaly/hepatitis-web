<!-- resources/views/admin/components/sidebar.blade.php -->
<div class="p-3">
    <h5 class="text-white mb-4">لوحة التحكم</h5>

    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-house-door-fill me-2"></i> الرئيسية
    </a>

    <a href="{{ route('admin.doctors') }}" class="{{ request()->routeIs('admin.doctors') ? 'active' : '' }}">
        <i class="bi bi-person-fill-gear me-2"></i> إدارة الأطباء
    </a>

    <a href="{{ route('admin.patients-doctors') }}"
        class="{{ request()->routeIs('admin.patients-doctors') ? 'active' : '' }}">
        <i class="bi bi-person-vcard me-2"></i> المرضى والأطباء
    </a>

    <a href="{{ route('admin.patients') }}" class="{{ request()->routeIs('admin.patients') ? 'active' : '' }}">
        <i class="bi bi-person-lines-fill me-2"></i> الإحصائات
    </a>


    <a href="{{ route('admin.export.page') }}" class="nav-link">
        <i class="bi bi-file-earmark-spreadsheet"></i>
        <span>تصدير بيانات المرضى</span>
    </a>
    </li>

</div>
