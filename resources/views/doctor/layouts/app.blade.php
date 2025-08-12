<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'لوحة الطبيب')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    {{-- ستايل مخصص --}}
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>

<body class="bg-light">

    {{-- ✅ شريط علوي --}}
    @include('doctor.components.navbar')

    <div class="container-fluid">
        <div class="row">
            {{-- ✅ الشريط الجانبي --}}
            <div class="col-md-3 col-lg-2 bg-white shadow-sm vh-100 p-0">
                @include('doctor.components.sidebar')
            </div>

            {{-- ✅ المحتوى الرئيسي --}}
            <div class="col-md-9 col-lg-10 p-4">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- ✅ سكربت التفاعل - مؤجل التنفيذ بعد DOM --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}" defer></script>
</body>

</html>
