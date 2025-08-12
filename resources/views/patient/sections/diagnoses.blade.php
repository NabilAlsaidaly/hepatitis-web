@extends('patient.layouts.app')

@section('title', 'تشخيصات الطبيب')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">🩺 جميع التشخيصات والوصفات الموصى بها</h4>

    @if($records->isEmpty())
        <div class="alert alert-warning text-center">لا توجد تشخيصات متوفرة حتى الآن.</div>
    @else
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>📅 التاريخ</th>
                    <th>👨‍⚕️ اسم الطبيب</th>
                    <th>📝 التشخيص النهائي</th>
                    <th>💊 الوصفة الطبية</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                    @if($record->diagnosis)
                        <tr>
                            <td>{{ $record->created_at->format('Y-m-d') }}</td>
                            <td>{{ $record->doctor->Name ?? 'غير معروف' }}</td>
                            <td>{{ $record->diagnosis->Final_Diagnosis }}</td>
                            <td>{{ $record->diagnosis->Prescription }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
