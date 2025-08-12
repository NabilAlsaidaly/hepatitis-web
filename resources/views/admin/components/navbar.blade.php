<!-- resources/views/admin/components/navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4">
    <div class="container-fluid justify-content-between">
        <span class="navbar-brand fw-bold">
            👨‍💼 مرحبًا، {{ Auth::user()->Name }}
        </span>


        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-box-arrow-right"></i> تسجيل الخروج
            </button>
        </form>
    </div>
</nav>
