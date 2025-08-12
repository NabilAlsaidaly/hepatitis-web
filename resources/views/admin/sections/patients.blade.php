@extends('admin.layouts.app')

@section('content')
<h3 class="mb-4">مخطط التشخيصات المرضية</h3>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm p-4">
            <canvas id="diagnosisChart" style="height: 300px !important;"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    loadStatsAndRenderChart();
});

async function loadStatsAndRenderChart() {
    try {
        const res = await fetch("/api/stats");
        const stats = await res.json();
        console.log("📦 بيانات الإحصاءات:", stats);

        const labels = Object.keys(stats.distribution || {});
        const values = Object.values(stats.distribution || {});

        renderChart(labels, values);
    } catch (err) {
        console.error("❌ فشل تحميل الإحصاءات:", err);
    }
}

function renderChart(labels, data) {
    const ctx = document.getElementById("diagnosisChart").getContext("2d");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "عدد المرضى",
                data: data,
                backgroundColor: [
                    "#198754", // 🟢 سليم
                    "#ffc107", // 🟡 مشتبه
                    "#fd7e14", // 🟠 التهاب
                    "#dc3545", // 🔴 تليف
                    "#0d6efd", // 🚨 تشمع
                ],
                borderRadius: 10,
                barThickness: 50,
            }],
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            return `العدد: ${ctx.parsed.y}`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: "الحالة المرضية",
                        font: { size: 14 }
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: "عدد المرضى",
                        font: { size: 14 }
                    },
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    }
                }
            }
        }
    });
}
</script>
@endpush
