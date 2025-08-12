<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medical Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            direction: ltr;
            text-align: left;
            line-height: 1.6;
            margin: 30px;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            color: #1a73e8;
            border-bottom: 2px solid #1a73e8;
            padding-bottom: 10px;
        }

        .info-box {
            background-color: #f2f2f2;
            padding: 15px 20px;
            margin-bottom: 30px;
            border-radius: 6px;
            font-size: 14px;
        }

        .info-box p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #999;
        }

        th {
            background-color: #e0e0e0;
            color: #333;
            font-weight: bold;
        }

        td, th {
            padding: 8px 6px;
            text-align: center;
        }

        .note {
            color: red;
            font-weight: bold;
            font-size: 14px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
    </style>
</head>
<body>

    <h1>Patient Medical Report</h1>

    <div class="info-box">
        <p><strong>Name:</strong> {{ $patient->Name }}</p>
        <p><strong>Date of Birth:</strong> {{ $patient->Date_Of_Birth }}</p>
    </div>

    <h3 style="color: #444;">Analysis Results:</h3>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>ALB</th>
                <th>ALP</th>
                <th>ALT</th>
                <th>AST</th>
                <th>BIL</th>
                <th>CHE</th>
                <th>CHOL</th>
                <th>CREA</th>
                <th>GGT</th>
                <th>PROT</th>
                <th>Diagnosis</th>
            </tr>
        </thead>
        <tbody>
            @php
                $labels = [
                    0 => ' Healthy',
                    1 => ' Suspected follow-up recommended',
                    2 => ' Hepatitis consult your doctor',
                    3 => ' Fibrosis please consult your doctor for treatment plan',
                    4 => ' Cirrhosis urgent consultation with a specialist is advised'
                ];

                $needsDoctorAttention = false;
            @endphp

            @forelse($records as $record)
                @php
                    $predictionValue = $record->prediction->result ?? null;
                    if (in_array($predictionValue, [3, 4])) {
                        $needsDoctorAttention = true;
                    }
                @endphp
                <tr>
                    <td>{{ $record->created_at->format('Y-m-d') }}</td>
                    <td>{{ $record->ALB }}</td>
                    <td>{{ $record->ALP }}</td>
                    <td>{{ $record->ALT }}</td>
                    <td>{{ $record->AST }}</td>
                    <td>{{ $record->BIL }}</td>
                    <td>{{ $record->CHE }}</td>
                    <td>{{ $record->CHOL }}</td>
                    <td>{{ $record->CREA }}</td>
                    <td>{{ $record->GGT }}</td>
                    <td>{{ $record->PROT }}</td>
                    <td>
                        {{ $predictionValue !== null ? ($labels[$predictionValue] ?? '—') : '—' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12">No analysis data available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if ($needsDoctorAttention)
        <p class="note">Note: One or more results indicate a critical liver condition. Please consult your doctor immediately.</p>
    @endif

</body>
</html>
