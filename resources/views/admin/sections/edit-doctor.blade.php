@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h3>✏️ تعديل بيانات الطبيب</h3>

        <form method="POST" action="{{ route('admin.doctors.update', $doctor->User_ID) }}">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">الاسم</label>
                    <input type="text" name="Name" class="form-control" value="{{ $doctor->Name }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" name="Email" class="form-control" value="{{ $doctor->Email }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">كلمة المرور الجديدة (اختياري)</label>
                    <input type="password" name="Password" class="form-control">
                </div>
            </div>

            <div class="mt-3 text-end">
                <button type="submit" class="btn btn-primary">✔️ حفظ التعديلات</button>
                <a href="{{ route('admin.doctors') }}" class="btn btn-secondary">إلغاء</a>
            </div>
        </form>
    </div>
@endsection
