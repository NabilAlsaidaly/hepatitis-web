<div class="card shadow mb-4">
    <div class="card-header bg-info text-white" dir="rtl">
        <h5 class="mb-0">📝 التشخيص النهائي للمريض</h5>
    </div>

    <div class="card-body" dir="rtl" style="text-align: right;">

        {{-- ✅ القائمة المنسدلة لاختيار المريض --}}
        <div class="mb-3">
            <label for="patientSelect" class="form-label">👤 اختر مريضًا</label>
            <select id="patientSelect" class="form-select">
                <option value="">-- اختر المريض --</option>
            </select>
        </div>

        {{-- ✅ جدول التحاليل الأخير --}}
        <div id="recordDetails" class="d-none mt-4">
            <h5>🧾 آخر تحليل للمريض</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-light">
                        <tr>
                            <th>ALT</th>
                            <th>AST</th>
                            <th>ALP</th>
                            <th>BIL</th>
                            <th>CHE</th>
                            <th>ALB</th>
                            <th>CHOL</th>
                            <th>CREA</th>
                            <th>GGT</th>
                            <th>PROT</th>
                            <th>تشخيص AI</th>
                            <th>العلاج المقترح</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="altCell"></td>
                            <td id="astCell"></td>
                            <td id="alpCell"></td>
                            <td id="bilCell"></td>
                            <td id="cheCell"></td>
                            <td id="albCell"></td>
                            <td id="cholCell"></td>
                            <td id="creaCell"></td>
                            <td id="ggtCell"></td>
                            <td id="protCell"></td>
                            <td id="predictionCell"></td>
                            <td id="treatmentCell"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ✅ نموذج إدخال التشخيص النهائي --}}
        <form id="diagnosisForm" class="d-none mt-4">
            <input type="hidden" id="recordId" name="record_id">

            <div class="mb-3">
                <label for="finalDiagnosis" class="form-label">📋 التشخيص النهائي</label>
                <textarea id="finalDiagnosis" class="form-control" rows="2" required></textarea>
            </div>

            <div class="mb-3">
                <label for="prescription" class="form-label">💊 الوصفة الطبية</label>
                <textarea id="prescription" class="form-control" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">💾 حفظ التشخيص</button>
        </form>

        {{-- ✅ رسالة نجاح أو خطأ --}}
        <div id="diagnosisMessage" class="mt-3"></div>

    </div>
</div>
