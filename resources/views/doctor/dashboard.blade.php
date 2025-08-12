@extends('doctor.layouts.app')

@section('title', 'لوحة التحكم')

@section('content')

    {{-- ✅ لوحة الترحيب --}}
    <div id="section-dashboard" class="section text-end" dir="rtl">

        <h3 class="mb-4 d-flex align-items-center gap-2">
            👋 <span>مرحبًا دكتور {{ Auth::user()->Name }}</span>
        </h3>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body" dir="rtl" style="text-align: right;">
                        <h5 class="card-title">👨‍⚕️ إدارة المرضى</h5>
                        <p class="card-text">عرض وإدارة بيانات المرضى المرتبطين بك.</p>
                        <button onclick="showSection('patients')" class="btn btn-outline-primary w-100">الانتقال</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body" dir="rtl" style="text-align: right;">
                        <h5 class="card-title">🧪 التحليل والتنبؤ</h5>
                        <p class="card-text">تشخيص حالة المريض باستخدام الذكاء الاصطناعي.</p>
                        <button onclick="showSection('analysis')" class="btn btn-outline-success w-100">الانتقال</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body" dir="rtl" style="text-align: right;">
                        <h5 class="card-title">🧠 تطور المرض</h5>
                        <p class="card-text">توقع تطور الحالة المرضية باستخدام LSTM.</p>
                        <button onclick="showSection('lstm')" class="btn btn-outline-secondary w-100">الانتقال</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body" dir="rtl" style="text-align: right;">
                        <h5 class="card-title">🧹 المعالجة المسبقة</h5>
                        <p class="card-text">تنظيف وتحضير البيانات قبل التحليل.</p>
                        <button onclick="showSection('preprocessing')"
                            class="btn btn-outline-warning w-100">الانتقال</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body" dir="rtl" style="text-align: right;">
                        <h5 class="card-title">📄 التقارير</h5>
                        <p class="card-text">عرض وتحميل التقارير الخاصة بالمرضى.</p>
                        <button onclick="showSection('reports')" class="btn btn-outline-dark w-100">الانتقال</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ قسم إدارة المرضى --}}
    <div id="section-patients" class="section d-none">
        @include('doctor.sections.patients')
    </div>

    {{-- ✅ قسم تطور المرض --}}
    <div id="section-lstm" class="section d-none">
        @include('doctor.sections.lstm')
    </div>

    {{-- ✅ قسم التحليل --}}
    <div id="section-analysis" class="section d-none">
        @include('doctor.sections.analysis')
    </div>

    {{-- ✅ قسم التشخيص النهائي --}}
    <div id="section-final-diagnosis" class="section d-none">
        @include('doctor.sections.final-diagnosis')
    </div>

    {{-- ✅ قسم جميع التشخيصات التي قام بها الطبيب --}}
    <div id="section-doctor-diagnosis-log" class="section d-none">
        @include('doctor.sections.diagnosis-log')
    </div>

    {{-- ✅ قسم التقارير --}}
    <div id="section-reports" class="section d-none">
        @include('doctor.sections.reports')
    </div>

    {{-- ✅ قسم الإحصاءات --}}
    <div id="section-stats" class="section d-none">
        @include('doctor.sections.stats')
    </div>

@endsection
