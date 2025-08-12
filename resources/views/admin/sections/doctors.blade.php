<!-- resources/views/admin/sections/doctors.blade.php -->
@extends('admin.layouts.app')

@section('content')
    <h3 class="mb-4">👨‍⚕️ إدارة الأطباء</h3>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- ✅ Form لإضافة طبيب جديد -->
    <div class="card mb-4">
        <div class="card-header">➕ إضافة طبيب جديد</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.doctors.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">الاسم الكامل</label>
                        <input type="text" name="Name" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="Email" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">كلمة المرور</label>
                        <input type="password" name="Password" class="form-control" required>
                    </div>
                </div>

                <div class="mt-3 text-end">
                    <button type="submit" class="btn btn-success">✔️ حفظ الطبيب</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>تاريخ الإضافة</th>
                <th>الخيارات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($doctors as $doctor)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $doctor->Name }}</td>
                    <td>{{ $doctor->Email }}</td>
                    <td>{{ optional($doctor->created_at)->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('admin.doctors.edit', $doctor->User_ID) }}"
                            class="btn btn-sm btn-primary">تعديل</a>
                        <form method="POST" action="{{ route('admin.doctors.delete', $doctor->User_ID) }}"
                            style="display:inline-block;" onsubmit="return confirm('هل أنت متأكد من حذف هذا الطبيب؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">لا يوجد أطباء حالياً.</td>
                </tr>
            @endforelse

        </tbody>
    </table>
@endsection
