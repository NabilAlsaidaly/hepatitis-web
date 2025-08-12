<div class="card shadow mb-4">
    <div class="card-header bg-warning text-dark" dir="rtl">
        <h5 class="mb-0">📋 قائمة التشخيصات التي قمت بها</h5>
    </div>

    <div class="card-body" dir="rtl" style="text-align: right;">

        {{-- ✅ القائمة المنسدلة لاختيار المريض --}}
        <div class="mb-3">
            <label for="patientSelect" class="form-label">👤 اختر مريضًا</label>
            <select id="patientSelectDiagnosis1" class="form-select">
                <option value="">-- اختر المريض --</option>
            </select>

        </div>



        {{-- ✅ جدول التشخيصات --}}
        <div id="diagnosisLogContainer" class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>اسم المريض</th>
                        <th>تاريخ التشخيص</th>
                        <th>التشخيص النهائي</th>
                        <th>الوصفة الطبية</th>
                    </tr>
                </thead>
                <tbody></tbody> {{-- ✅ سيتم ملؤه من JS --}}
            </table>
        </div>

    </div>
</div>
