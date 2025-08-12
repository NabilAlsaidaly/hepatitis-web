<!-- resources/views/admin/sections/dashboard.blade.php -->
@extends('admin.layouts.app')

@section('content')
<h3 class="mb-4">📊 نظرة عامة</h3>

<div class="row">
    <!-- الأطباء -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-person-fill-gear fs-1 text-primary"></i>
                <h5 class="mt-3">عدد الأطباء</h5>
                <h2>{{ $doctorCount }}</h2>
            </div>
        </div>
    </div>

    <!-- المرضى -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-people-fill fs-1 text-success"></i>
                <h5 class="mt-3">عدد المرضى</h5>
                <h2>{{ $patientCount }}</h2>
            </div>
        </div>
    </div>

    <!-- السجلات -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-file-earmark-text-fill fs-1 text-warning"></i>
                <h5 class="mt-3">عدد السجلات الطبية</h5>
                <h2>{{ $recordsCount }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection
