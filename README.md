# Hepatitis Decision Support Web Application

A full-featured Laravel-based web application designed to support hepatitis diagnosis, patient management, and medical decision-making.  
The system provides dedicated dashboards for administrators, doctors, and patients, along with integration to a separate Machine Learning API for disease prediction and treatment recommendations.

> Note: This repository contains the **web application only**.  
> The Machine Learning API (Python models, `.pkl`, `.keras`) is stored in a separate project.

---

## 🚀 Features

### 🔹 Multi-role Authentication System
The application includes distinct login portals and dashboards for:

- **Admin**
- **Doctor**
- **Patient**

Each role has access to different functionalities and views.

---

### 🔹 Doctor Dashboard
Doctors can:

- Manage patient profiles
- Add and update medical records
- Submit biomedical indicators to the ML API for:
  - Disease prediction
  - Treatment recommendations
- Review previous diagnoses and prediction history
- Generate and download PDF reports

---

### 🔹 Patient Dashboard
Patients can:

- View personal profile and medical records
- Monitor diagnosis history
- Access generated medical reports
- Visualize health statistics and charts

---

### 🔹 Admin Dashboard
Admins can:

- Manage doctors and patients
- View system statistics
- Export medical data
- Monitor overall system usage

---

### 🔹 Machine Learning Integration
Located in `app/ML/MLService.php`, the system communicates with an external ML API built in Python.

The ML service provides:

- Disease prediction (classification)
- Treatment recommendation
- LSTM-based temporal progression analysis

The API URL can be configured in `.env`:

```env
ML_API_BASE_URL=http://127.0.0.1:5000
🔹 Reporting System
The application generates PDF reports stored under:

swift

storage/app/public/reports/
Each report contains:

Patient data

Lab results

Model predictions

Doctor notes

🔹 Technologies Used
Laravel 10+

Blade templates

Livewire / Volt

Chart.js

MySQL / SQLite

PDF generation

GitHub Actions (linting & testing pipelines)

📁 Project Structure (Overview)
Some key directories:

pgsql

app/
 ├── Http/Controllers     → Admin, Doctor & Patient controllers
 ├── Models               → Patient, Diagnosis, Treatment, Report, etc.
 ├── ML/MLService.php     → Machine Learning API integration
 ├── Services/            → Business logic (e.g., ReportService)
resources/
 ├── views/admin          → Admin dashboard
 ├── views/doctor         → Doctor dashboard
 ├── views/patient        → Patient dashboard
database/
 ├── migrations           → Database schema
 ├── seeders              → Initial data population
storage/
 └── app/public/reports   → Generated medical reports (PDF)
🛠 Installation & Setup
1. Clone the repository
bash

git clone https://github.com/<your-username>/hepatitis-web.git
cd hepatitis-web
2. Install dependencies
bash

composer install
npm install
3. Prepare environment file
bash

cp .env.example .env
Configure your database inside .env:

For MySQL:

env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hepatitis_db
DB_USERNAME=root
DB_PASSWORD=
For SQLite:

env

DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
4. Generate app key
bash

php artisan key:generate
5. Run migrations and seeders
bash

php artisan migrate --seed
6. Build frontend assets
Development mode:

bash

npm run dev
Production:

bash

npm run build
7. Start the server
bash

php artisan serve
Open:

cpp

http://127.0.0.1:8000
🤝 Example Login Credentials (if seeded)
Admin:

pgsql

admin@example.com
password
Doctor:

css

doctor@example.com
password
Patient:

css

patient@example.com
password
🧪 Running Tests
bash

php artisan test
Tests are located under:

tests/Feature

tests/Unit

🧱 Architecture Notes
Clean MVC structure

Clear separation of responsibilities:

Controllers → request handling

Services → business logic

MLService → external ML integration

Views grouped by user type for maintainability

Strong emphasis on medical workflow support

⚠️ Disclaimer
This software is for research and educational purposes only.
It is not intended for real medical diagnosis or replacing professional clinical judgment.

📄 License
You may add a license of your choice (MIT recommended).
