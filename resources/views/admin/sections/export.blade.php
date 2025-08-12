@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h3>📤 تصدير بيانات المرضى</h3>

    <p class="text-muted">
        يتم تصدير البيانات لأغراض البحث العلمي بدون كشف أسماء المرضى أو أي بيانات حساسة.
    </p>

    <form method="POST" action="{{ route('admin.export.csv') }}">
        @csrf
        <button type="submit" class="btn btn-success">
            📥 تحميل ملف CSV
        </button>
    </form>
</div>
@endsection
