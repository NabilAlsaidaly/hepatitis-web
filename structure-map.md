# 🔍 Project Structure Map

## 🔹 Route: `POST api/predict/disease`
- Controller: `MLPredictionController@predictDisease`
- Full Path: `App\Http\Controllers\MLPredictionController`

---

## 🔹 Route: `POST api/predict/treatment`
- Controller: `MLPredictionController@predictTreatment`
- Full Path: `App\Http\Controllers\MLPredictionController`

---

## 🔹 Route: `POST api/predict/lstm`
- Controller: `MLPredictionController@predictLSTM`
- Full Path: `App\Http\Controllers\MLPredictionController`

---

## 🔹 Route: `POST api/records/lstm`
- Controller: `DiagnosisController@storeLSTM`
- Full Path: `App\Http\Controllers\DiagnosisController`
- Models used: MedicalRecord, Diagnosis

---

## 🔹 Route: `POST api/diagnoses/final`
- Controller: `DiagnosisController@storeFinalDiagnosis`
- Full Path: `App\Http\Controllers\DiagnosisController`
- Models used: MedicalRecord, Diagnosis

---

## 🔹 Route: `GET api/stats`
- Controller: `StatsController@summary`
- Full Path: `App\Http\Controllers\StatsController`
- Models used: Patient, MedicalRecord, Report, Prediction, Auth, Log

---

## 🔹 Route: `GET doctor/login`
- Controller: `DoctorLoginController@showLoginForm`
- Full Path: `App\Http\Controllers\DoctorLoginController`
- Models used: User, Hash, Auth
- Views returned:
  - `auth.doctor-login`

---

## 🔹 Route: `POST doctor/login`
- Controller: `DoctorLoginController@login`
- Full Path: `App\Http\Controllers\DoctorLoginController`
- Models used: User, Hash, Auth
- Views returned:
  - `auth.doctor-login`

---

## 🔹 Route: `POST doctor/logout`
- Controller: `DoctorLoginController@logout`
- Full Path: `App\Http\Controllers\DoctorLoginController`
- Models used: User, Hash, Auth
- Views returned:
  - `auth.doctor-login`

---

## 🔹 Route: `POST doctor/patients`
- Controller: `PatientController@store`
- Full Path: `App\Http\Controllers\PatientController`
- Models used: Auth, Log, Patient, User, MedicalRecord

---

## 🔹 Route: `POST records`
- Controller: `MedicalRecordController@store`
- Full Path: `App\Http\Controllers\MedicalRecordController`
- Models used: DB, MedicalRecord, Auth, Patient

---

## 🔹 Route: `GET patients`
- Controller: `PatientController@list`
- Full Path: `App\Http\Controllers\PatientController`
- Models used: Auth, Log, Patient, User, MedicalRecord

---

## 🔹 Route: `GET reports/list/{patientId}`
- Controller: `ReportController@list`
- Full Path: `App\Http\Controllers\ReportController`
- Models used: Report, Storage

---

## 🔹 Route: `DELETE reports/{id}`
- Controller: `ReportController@destroy`
- Full Path: `App\Http\Controllers\ReportController`
- Models used: Report, Storage

---

## 🔹 Route: `PUT patients/{id}`
- Controller: `PatientController@update`
- Full Path: `App\Http\Controllers\PatientController`
- Models used: Auth, Log, Patient, User, MedicalRecord

---

## 🔹 Route: `DELETE patients/{id}`
- Controller: `PatientController@destroy`
- Full Path: `App\Http\Controllers\PatientController`
- Models used: Auth, Log, Patient, User, MedicalRecord

---

## 🔹 Route: `GET patients/{id}/records`
- Controller: `PatientController@records`
- Full Path: `App\Http\Controllers\PatientController`
- Models used: Auth, Log, Patient, User, MedicalRecord

---

## 🔹 Route: `POST reports`
- Controller: `ReportController@store`
- Full Path: `App\Http\Controllers\ReportController`
- Models used: Report, Storage

---

## 🔹 Route: `GET reports/{patient_id}`
- Controller: `ReportController@list`
- Full Path: `App\Http\Controllers\ReportController`
- Models used: Report, Storage

---

## 🔹 Route: `GET doctor/stats`
- Controller: `StatsController@summaryForDoctor`
- Full Path: `App\Http\Controllers\StatsController`
- Models used: Patient, MedicalRecord, Report, Prediction, Auth, Log

---

## 🔹 Route: `POST reports/generate/{patientId}`
- Controller: `ReportController@generateReport`
- Full Path: `App\Http\Controllers\ReportController`
- Models used: Report, Storage

---

## 🔹 Route: `GET patient/login`
- Controller: `PatientLoginController@showLoginForm`
- Full Path: `App\Http\Controllers\Auth\PatientLoginController`
- Models used: Auth, ValidationException
- Views returned:
  - `patient.auth.login`

---

## 🔹 Route: `POST patient/login`
- Controller: `PatientLoginController@login`
- Full Path: `App\Http\Controllers\Auth\PatientLoginController`
- Models used: Auth, ValidationException
- Views returned:
  - `patient.auth.login`

---

## 🔹 Route: `POST patient/logout`
- Controller: `PatientLoginController@logout`
- Full Path: `App\Http\Controllers\Auth\PatientLoginController`
- Models used: Auth, ValidationException
- Views returned:
  - `patient.auth.login`

---

## 🔹 Route: `GET patient/dashboard`
- Controller: `PatientDashboardController@index`
- Full Path: `App\Http\Controllers\PatientDashboardController`
- Models used: Auth, Patient, MedicalRecord, Report
- Views returned:
  - `patient.sections.patient-info`
  - `patient.dashboard`
  - `patient.sections.records`
  - `patient.sections.reports`
  - `patient.sections.chart`

---

## 🔹 Route: `GET patient/records`
- Controller: `PatientDashboardController@records`
- Full Path: `App\Http\Controllers\PatientDashboardController`
- Models used: Auth, Patient, MedicalRecord, Report
- Views returned:
  - `patient.sections.patient-info`
  - `patient.dashboard`
  - `patient.sections.records`
  - `patient.sections.reports`
  - `patient.sections.chart`

---

## 🔹 Route: `GET patient/reports`
- Controller: `PatientDashboardController@reports`
- Full Path: `App\Http\Controllers\PatientDashboardController`
- Models used: Auth, Patient, MedicalRecord, Report
- Views returned:
  - `patient.sections.patient-info`
  - `patient.dashboard`
  - `patient.sections.records`
  - `patient.sections.reports`
  - `patient.sections.chart`

---

## 🔹 Route: `GET patient/chart`
- Controller: `PatientDashboardController@chart`
- Full Path: `App\Http\Controllers\PatientDashboardController`
- Models used: Auth, Patient, MedicalRecord, Report
- Views returned:
  - `patient.sections.patient-info`
  - `patient.dashboard`
  - `patient.sections.records`
  - `patient.sections.reports`
  - `patient.sections.chart`

---

## 🔹 Route: `GET patient/chart-data`
- Controller: `PatientDashboardController@chartData`
- Full Path: `App\Http\Controllers\PatientDashboardController`
- Models used: Auth, Patient, MedicalRecord, Report
- Views returned:
  - `patient.sections.patient-info`
  - `patient.dashboard`
  - `patient.sections.records`
  - `patient.sections.reports`
  - `patient.sections.chart`

---

## 🔹 Route: `GET patient/info`
- Controller: `PatientDashboardController@info`
- Full Path: `App\Http\Controllers\PatientDashboardController`
- Models used: Auth, Patient, MedicalRecord, Report
- Views returned:
  - `patient.sections.patient-info`
  - `patient.dashboard`
  - `patient.sections.records`
  - `patient.sections.reports`
  - `patient.sections.chart`

---

## 🔹 Route: `GET admin/dashboard`
- Controller: `AdminController@dashboard`
- Full Path: `App\Http\Controllers\AdminController`
- Models used: User, Patient, MedicalRecord, Response
- Views returned:
  - `admin.sections.dashboard`
  - `admin.sections.doctors`
  - `admin.sections.patients`
  - `admin.sections.export`
  - `admin.sections.edit-doctor`

---

## 🔹 Route: `GET admin/doctors`
- Controller: `AdminController@indexDoctors`
- Full Path: `App\Http\Controllers\AdminController`
- Models used: User, Patient, MedicalRecord, Response
- Views returned:
  - `admin.sections.dashboard`
  - `admin.sections.doctors`
  - `admin.sections.patients`
  - `admin.sections.export`
  - `admin.sections.edit-doctor`

---

## 🔹 Route: `GET admin/patients`
- Controller: `AdminController@indexPatients`
- Full Path: `App\Http\Controllers\AdminController`
- Models used: User, Patient, MedicalRecord, Response
- Views returned:
  - `admin.sections.dashboard`
  - `admin.sections.doctors`
  - `admin.sections.patients`
  - `admin.sections.export`
  - `admin.sections.edit-doctor`

---

## 🔹 Route: `GET admin/export`
- Controller: `AdminController@showExportPage`
- Full Path: `App\Http\Controllers\AdminController`
- Models used: User, Patient, MedicalRecord, Response
- Views returned:
  - `admin.sections.dashboard`
  - `admin.sections.doctors`
  - `admin.sections.patients`
  - `admin.sections.export`
  - `admin.sections.edit-doctor`

---

## 🔹 Route: `POST admin/export`
- Controller: `AdminController@exportCSV`
- Full Path: `App\Http\Controllers\AdminController`
- Models used: User, Patient, MedicalRecord, Response
- Views returned:
  - `admin.sections.dashboard`
  - `admin.sections.doctors`
  - `admin.sections.patients`
  - `admin.sections.export`
  - `admin.sections.edit-doctor`

---

## 🔹 Route: `POST admin/doctors/store`
- Controller: `AdminController@storeDoctor`
- Full Path: `App\Http\Controllers\AdminController`
- Models used: User, Patient, MedicalRecord, Response
- Views returned:
  - `admin.sections.dashboard`
  - `admin.sections.doctors`
  - `admin.sections.patients`
  - `admin.sections.export`
  - `admin.sections.edit-doctor`

---

## 🔹 Route: `GET admin/doctors/{id}/edit`
- Controller: `AdminController@editDoctor`
- Full Path: `App\Http\Controllers\AdminController`
- Models used: User, Patient, MedicalRecord, Response
- Views returned:
  - `admin.sections.dashboard`
  - `admin.sections.doctors`
  - `admin.sections.patients`
  - `admin.sections.export`
  - `admin.sections.edit-doctor`

---

## 🔹 Route: `PUT admin/doctors/{id}`
- Controller: `AdminController@updateDoctor`
- Full Path: `App\Http\Controllers\AdminController`
- Models used: User, Patient, MedicalRecord, Response
- Views returned:
  - `admin.sections.dashboard`
  - `admin.sections.doctors`
  - `admin.sections.patients`
  - `admin.sections.export`
  - `admin.sections.edit-doctor`

---

## 🔹 Route: `DELETE admin/doctors/{id}`
- Controller: `AdminController@deleteDoctor`
- Full Path: `App\Http\Controllers\AdminController`
- Models used: User, Patient, MedicalRecord, Response
- Views returned:
  - `admin.sections.dashboard`
  - `admin.sections.doctors`
  - `admin.sections.patients`
  - `admin.sections.export`
  - `admin.sections.edit-doctor`

---

## 🔹 Route: `GET admin/login`
- Controller: `AdminLoginController@showLoginForm`
- Full Path: `App\Http\Controllers\Admin\AdminLoginController`
- Models used: Auth
- Views returned:
  - `admin.auth.admin-login`

---

## 🔹 Route: `POST admin/login`
- Controller: `AdminLoginController@login`
- Full Path: `App\Http\Controllers\Admin\AdminLoginController`
- Models used: Auth
- Views returned:
  - `admin.auth.admin-login`

---


## 📁 Public JS Files (`public/js/`)
- `\js\dashboard.js`
  - Size: 47.96 KB
