@extends('admin.layouts.app')

@section('title', 'المرضى وأطباؤهم')

@section('content')
    <div class="container mt-4">
        <h4 class="mb-4">👥 قائمة المرضى مع الأطباء المعالجين</h4>

        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>👤 اسم المريض</th>
                    <th>🩺 الطبيب المعالج</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($patients as $patient)
                    <tr>
                        <td>{{ $patient->Name }}</td>
                        <td>{{ $patient->doctor?->Name ?? '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">لا يوجد مرضى حاليًا.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
