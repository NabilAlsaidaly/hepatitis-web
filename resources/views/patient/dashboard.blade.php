@extends('patient.layouts.app')

@section('content')
    <div class="container text-end" dir="rtl">

        <h3 class="mb-4 d-flex align-items-center gap-2">
            👋 <span>مرحبًا {{ Auth::user()->Name }}</span>
        </h3>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body" dir="rtl" style="text-align: right;">
                        <h5 class="card-title">📋 تحاليلك</h5>
                        <p class="card-text">استعرض نتائج تحاليلك بالتفصيل.</p>
                        <a href="{{ route('patient.records') }}" class="btn btn-outline-primary w-100">عرض التحاليل</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
    <div class="card shadow-sm h-100">
        <div class="card-body" dir="rtl" style="text-align: right;">
            <h5 class="card-title">💊 الوصفة الطبية</h5>
            <p class="card-text">قم بمراجعة تشخيص الطبيب النهائي</p>
            <a href="{{ route('patient.diagnoses') }}" class="btn btn-outline-warning w-100">عرض التقارير</a>
        </div>
    </div>
</div>


            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body" dir="rtl" style="text-align: right;">
                        <h5 class="card-title">📄 تقاريرك</h5>
                        <p class="card-text">شاهد أو قم بتحميل تقاريرك الطبية.</p>
                        <a href="{{ route('patient.reports') }}" class="btn btn-outline-success w-100">عرض التقارير</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body" dir="rtl" style="text-align: right;">
                        <h5 class="card-title">📈 تحاليل بيانية</h5>
                        <p class="card-text">رؤية تطور تحاليلك على مخطط زمني.</p>
                        <a href="{{ route('patient.chart') }}" class="btn btn-outline-secondary w-100">عرض المخطط</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
