<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm px-4">
    <div class="container-fluid">
        <span class="navbar-brand fw-bold text-primary">
            نظام التنبؤ الكبدي
        </span>

        <div class="ms-auto">
            <form method="POST" action="{{ route('doctor.logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">🚪 تسجيل الخروج</button>
            </form>

        </div>
    </div>
</nav>
