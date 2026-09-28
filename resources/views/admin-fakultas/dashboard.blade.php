@extends('layouts.dashboard')

@section('title', 'Dashboard Admin Fakultas')

@section('content')

<style>

    /* =====================================================
       DASHBOARD
    ===================================================== */

    .dashboard-container {
        width: 100%;
        padding: 0;
        margin: 0;
        background: transparent;
        font-family: Arial, Helvetica, sans-serif;
    }


    /* =====================================================
       STATISTIC CARDS
    ===================================================== */

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        width: 100%;
        margin-bottom: 34px;
    }


    .stat-card {
        height: 126px;
        background: #ffffff;
        border: 1px solid #d8dee8;
        border-radius: 20px;
        padding: 16px 14px;

        display: flex;
        align-items: center;

        box-shadow: 0 3px 4px rgba(0, 0, 0, 0.17);
    }


    /* =====================================================
       STAT ICON
    ===================================================== */

    .stat-icon {
        width: 58px;
        height: 58px;
        min-width: 58px;

        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;
    }


    .stat-icon svg {
        width: 30px;
        height: 30px;
        stroke-width: 2;
    }


    .icon-blue {
        background: #dceaff;
        color: #0968e8;
    }


    .icon-orange {
        background: #fff0d7;
        color: #ff7900;
    }


    .icon-green {
        background: #d9f2e4;
        color: #009b4d;
    }


    .icon-red {
        background: #ffd9dd;
        color: #ff252d;
    }


    /* =====================================================
       STAT CONTENT
    ===================================================== */

    .stat-content {
        flex: 1;
        text-align: center;
        padding-right: 8px;
    }


    .stat-title {
        font-size: 13px;
        font-weight: 700;
        color: #202235;
        margin-bottom: 10px;
    }


    .stat-number {
        font-size: 25px;
        line-height: 1;
        font-weight: 700;
        color: #202235;
        margin-bottom: 10px;
    }


    .stat-description {
        font-size: 11px;
        font-weight: 600;
        color: #202235;
    }


    /* =====================================================
       MAIN GRID
    ===================================================== */

    .dashboard-grid {
        width: 100%;

        display: grid;

        grid-template-columns:
            minmax(0, 1.95fr)
            minmax(320px, 1fr);

        gap: 30px;

        align-items: start;
    }


    /* =====================================================
       GENERAL CARD
    ===================================================== */

    .dashboard-card {
        background: #ffffff;
        border: 1px solid #d8dee8;
        border-radius: 20px;
        box-shadow: 0 3px 4px rgba(0, 0, 0, 0.17);
    }


    /* =====================================================
       TREND LAPORAN
    ===================================================== */

    .trend-card {
        height: 500px;
        padding: 20px 20px 18px;
    }


    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }


    .card-title {
        margin: 0 0 12px;
        font-size: 15px;
        font-weight: 700;
        color: #202235;
    }


    .card-subtitle {
        margin: 0;
        font-size: 10px;
        color: #9299aa;
    }


    .period-select {
        width: 160px;
        height: 40px;

        border: 1px solid #aeb7c8;
        border-radius: 8px;

        background: #ffffff;

        padding: 0 12px;

        font-size: 11px;
        color: #25283a;

        outline: none;
        cursor: pointer;
    }


    .trend-chart-wrapper {
        width: 100%;
        height: 300px;
        position: relative;
        margin-top: 35px;
    }


    .chart-footer {
        margin-top: 8px;
        font-size: 10px;
        color: #969eaf;
    }


    /* =====================================================
       RIGHT COLUMN
    ===================================================== */

    .right-column {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }


    /* =====================================================
       KATEGORI LAPORAN
    ===================================================== */

    .category-card {
        height: 254px;
        padding: 18px 16px;
    }


    .category-card .card-title {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: #202235;
    }


    .category-chart-wrapper {
        width: 100%;
        height: 175px;
        position: relative;
        margin-top: 0;
    }


    .category-footer {
        margin-top: 2px;
        font-size: 9px;
        color: #969eaf;
    }


    /* =====================================================
       PRIORITAS LAPORAN
    ===================================================== */

    .priority-card {
        height: 254px;
        padding: 18px 16px;
    }


    .priority-card .card-title {
        margin: 0 0 4px;
        font-size: 15px;
        font-weight: 700;
        color: #202235;
    }


    .priority-chart-wrapper {
        width: 100%;
        height: 170px;
        position: relative;
        margin-top: 6px;
    }


    .priority-footer {
        margin-top: 2px;
        font-size: 10px;
        color: #969eaf;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 1200px) {

        .dashboard-grid {
            grid-template-columns:
                minmax(0, 1.7fr)
                minmax(280px, 1fr);

            gap: 20px;
        }

        .stats-grid {
            gap: 14px;
        }
    }


    @media (max-width: 950px) {

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .right-column {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }
    }


    @media (max-width: 650px) {

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .right-column {
            grid-template-columns: 1fr;
        }

        .trend-card {
            height: 420px;
        }

        .trend-chart-wrapper {
            height: 260px;
        }

        .period-select {
            width: 130px;
        }
    }

</style>


<div class="dashboard-container">


    {{-- =====================================================
         STATISTIK
    ====================================================== --}}

    <div class="stats-grid">


        {{-- LAPORAN MASUK --}}

        <div class="stat-card">

            <div class="stat-icon icon-blue">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor">

                    <rect
                        x="5"
                        y="3"
                        width="14"
                        height="18"
                        rx="1">
                    </rect>

                    <path d="M9 7h6"></path>
                    <path d="M9 11h6"></path>
                    <path d="M9 15h2"></path>
                    <path d="M14 15h1"></path>

                </svg>

            </div>


            <div class="stat-content">

                <div class="stat-title">
                    Laporan Masuk
                </div>

                <div class="stat-number">
                    {{ $totalLaporan }}
                </div>

                <div class="stat-description">
                    Total Laporan
                </div>

            </div>

        </div>


        {{-- MENUNGGU --}}

        <div class="stat-card">

            <div class="stat-icon icon-orange">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor">

                    <circle
                        cx="12"
                        cy="12"
                        r="9">
                    </circle>

                    <path d="M12 7v5l3 2"></path>

                </svg>

            </div>


            <div class="stat-content">

                <div class="stat-title">
                    Menunggu
                </div>

                <div class="stat-number">
                    {{ $laporanMenunggu }}
                </div>

                <div class="stat-description">
                    Perlu Diperiksa
                </div>

            </div>

        </div>


        {{-- DIVERIFIKASI --}}

        <div class="stat-card">

            <div class="stat-icon icon-green">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor">

                    <circle
                        cx="12"
                        cy="12"
                        r="9">
                    </circle>

                    <path d="M8 12l3 3 5-6"></path>

                </svg>

            </div>


            <div class="stat-content">

                <div class="stat-title">
                    Diverifikasi
                </div>

                <div class="stat-number">
                    {{ $laporanDiverifikasi }}
                </div>

                <div class="stat-description">
                    Telah Diverifikasi
                </div>

            </div>

        </div>


        {{-- DITOLAK --}}

        <div class="stat-card">

            <div class="stat-icon icon-red">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor">

                    <circle
                        cx="12"
                        cy="12"
                        r="9">
                    </circle>

                    <path d="M9 9l6 6"></path>
                    <path d="M15 9l-6 6"></path>

                </svg>

            </div>


            <div class="stat-content">

                <div class="stat-title">
                    Ditolak
                </div>

                <div class="stat-number">
                    {{ $laporanDitolak }}
                </div>

                <div class="stat-description">
                    Berkas Ditolak
                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         MAIN CONTENT
    ====================================================== --}}

    <div class="dashboard-grid">


        {{-- =================================================
             TREND LAPORAN
        ================================================== --}}

        <div class="dashboard-card trend-card">

            <div class="card-header">

                <div>

                    <h3 class="card-title">
                        Tren Laporan
                    </h3>

                    <p class="card-subtitle">
                        Jumlah laporan yang masuk setiap bulan
                    </p>

                </div>


                <select
                    class="period-select"
                    onchange="ubahPeriode(this.value)">

                    <option
                        value="6"
                        {{ $periode == 6 ? 'selected' : '' }}>
                        6 Bulan Terakhir
                    </option>

                    <option
                        value="12"
                        {{ $periode == 12 ? 'selected' : '' }}>
                        12 Bulan Terakhir
                    </option>

                </select>

            </div>


            <div class="trend-chart-wrapper">

                <canvas id="trendChart"></canvas>

            </div>


            <div class="chart-footer">
                Jumlah laporan yang masuk setiap bulan
            </div>

        </div>


        {{-- =================================================
             RIGHT COLUMN
        ================================================== --}}

        <div class="right-column">


            {{-- =================================================
                 KATEGORI LAPORAN
            ================================================== --}}

            <div class="dashboard-card category-card">

                <h3 class="card-title">
                    Kategori Laporan
                </h3>


                <div class="category-chart-wrapper">

                    <canvas id="categoryChart"></canvas>

                </div>


                <div class="category-footer">
                    Persentase kategori berdasarkan laporan yang masuk
                </div>

            </div>


            {{-- =================================================
                 PRIORITAS LAPORAN
            ================================================== --}}

            <div class="dashboard-card priority-card">

                <h3 class="card-title">
                    Prioritas Laporan
                </h3>


                <div class="priority-chart-wrapper">

                    <canvas id="priorityChart"></canvas>

                </div>


                <div class="priority-footer">
                    Jumlah laporan berdasarkan tingkat prioritas
                </div>

            </div>

        </div>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>

    /*
    |--------------------------------------------------------------------------
    | DATA DARI DATABASE
    |--------------------------------------------------------------------------
    */

    const bulan = @json($bulan);

    const jumlahLaporan = @json($jumlahLaporan);

    const kategoriLabels = @json($kategoriLabels);

    const kategoriJumlah = @json($kategoriJumlah);

    const prioritasLabels = @json($prioritasLabels);

    const prioritasJumlah = @json($prioritasJumlah);


    /*
    |--------------------------------------------------------------------------
    | GANTI PERIODE
    |--------------------------------------------------------------------------
    */

    function ubahPeriode(value) {

        const url = new URL(
            window.location.href
        );

        url.searchParams.set(
            'periode',
            value
        );

        window.location.href = url.toString();
    }


    /*
    |--------------------------------------------------------------------------
    | TREND LAPORAN
    |--------------------------------------------------------------------------
    */

    new Chart(
        document.getElementById('trendChart'),
        {

            type: 'line',

            data: {

                labels: bulan,

                datasets: [

                    {

                        data: jumlahLaporan,

                        borderColor: '#0878ff',

                        backgroundColor:
                            'rgba(8,120,255,0.10)',

                        borderWidth: 2,

                        pointBackgroundColor:
                            '#0878ff',

                        pointBorderColor:
                            '#ffffff',

                        pointBorderWidth: 2,

                        pointRadius: 4,

                        pointHoverRadius: 6,

                        fill: true,

                        tension: 0.25

                    }

                ]

            },


            options: {

                responsive: true,

                maintainAspectRatio: false,


                plugins: {

                    legend: {
                        display: false
                    },


                    tooltip: {

                        displayColors: false,

                        callbacks: {

                            label: function(context) {

                                return context.parsed.y +
                                    ' laporan';

                            }

                        }

                    }

                },


                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {

                            precision: 0,

                            font: {
                                size: 10
                            },

                            color: '#65708a'

                        },


                        grid: {

                            color: '#e5ebf3',

                            borderDash: [
                                4,
                                4
                            ]

                        }

                    },


                    x: {

                        ticks: {

                            font: {
                                size: 10
                            },

                            color: '#65708a'

                        },


                        grid: {

                            color: '#e5ebf3',

                            borderDash: [
                                4,
                                4
                            ]

                        }

                    }

                }

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | PLUGIN TEKS TENGAH DONUT
    |--------------------------------------------------------------------------
    */

    const centerTextPlugin = {

        id: 'centerText',

        afterDraw(chart) {

            const ctx = chart.ctx;

            const meta =
                chart.getDatasetMeta(0);

            if (!meta.data.length) {
                return;
            }

            const x =
                meta.data[0].x;

            const y =
                meta.data[0].y;


            const total =
                chart.data.datasets[0]
                    .data
                    .reduce(
                        (a, b) => a + Number(b),
                        0
                    );


            ctx.save();

            ctx.textAlign = 'center';

            ctx.textBaseline = 'middle';


            ctx.font =
                '700 30px Arial';

            ctx.fillStyle =
                '#202235';

            ctx.fillText(
                total,
                x,
                y - 5
            );


            ctx.font =
                '600 11px Arial';

            ctx.fillStyle =
                '#303346';

            ctx.fillText(
                'Total',
                x,
                y + 17
            );


            ctx.restore();

        }

    };


    /*
    |--------------------------------------------------------------------------
    | PLUGIN PERSENTASE DONUT
    |--------------------------------------------------------------------------
    */

    const categoryPercentagePlugin = {

        id: 'categoryPercentage',

        afterDatasetsDraw(chart) {

            const ctx = chart.ctx;

            const dataset =
                chart.data.datasets[0];

            const meta =
                chart.getDatasetMeta(0);


            const total =
                dataset.data.reduce(
                    (a, b) => a + Number(b),
                    0
                );


            if (total === 0) {
                return;
            }


            ctx.save();


            meta.data.forEach(
                (arc, index) => {

                    const value =
                        Number(
                            dataset.data[index]
                        );


                    if (value <= 0) {
                        return;
                    }


                    const percentage =
                        (
                            value / total
                        ) * 100;


                    const angle =
                        (
                            arc.startAngle +
                            arc.endAngle
                        ) / 2;


                    const radius =
                        arc.innerRadius +
                        (
                            arc.outerRadius -
                            arc.innerRadius
                        ) * 0.52;


                    const x =
                        arc.x +
                        Math.cos(angle) *
                        radius;


                    const y =
                        arc.y +
                        Math.sin(angle) *
                        radius;


                    ctx.font =
                        '700 9px Arial';

                    ctx.fillStyle =
                        '#ffffff';

                    ctx.textAlign =
                        'center';

                    ctx.textBaseline =
                        'middle';


                    ctx.fillText(
                        percentage.toFixed(2) + '%',
                        x,
                        y
                    );

                }
            );


            ctx.restore();

        }

    };


    /*
    |--------------------------------------------------------------------------
    | KATEGORI LAPORAN
    |--------------------------------------------------------------------------
    */

    new Chart(
        document.getElementById('categoryChart'),
        {

            type: 'doughnut',


            data: {

                labels: kategoriLabels,


                datasets: [

                    {

                        data: kategoriJumlah,


                        backgroundColor: [

                            '#72A9F8',

                            '#73D2A4',

                            '#FFAD73',

                            '#B795EF',

                            '#F58AA0',

                            '#8DD3C7',

                            '#FDB462',

                            '#80B1D3'

                        ],


                        borderColor:
                            '#ffffff',

                        borderWidth: 4,

                        borderRadius: 8,

                        spacing: 2

                    }

                ]

            },


            plugins: [

                centerTextPlugin,

                categoryPercentagePlugin

            ],


            options: {

                responsive: true,

                maintainAspectRatio: false,

                cutout: '43%',

                radius: '92%',

                rotation: -90,


                plugins: {

                    legend: {

                        display: true,

                        position: 'right',

                        align: 'center',


                        labels: {

                            usePointStyle: true,

                            pointStyle: 'circle',

                            boxWidth: 11,

                            boxHeight: 11,

                            padding: 12,


                            font: {

                                size: 10,

                                weight: '400'

                            },

                            color: '#6f7482'

                        }

                    },


                    tooltip: {

                        callbacks: {

                            label: function(context) {

                                const data =
                                    context.dataset.data;

                                const total =
                                    data.reduce(
                                        (a, b) =>
                                            a + Number(b),
                                        0
                                    );

                                const value =
                                    Number(
                                        context.parsed
                                    );

                                const percentage =
                                    total > 0
                                        ? (
                                            value /
                                            total *
                                            100
                                        ).toFixed(2)
                                        : 0;

                                return context.label +
                                    ': ' +
                                    value +
                                    ' laporan (' +
                                    percentage +
                                    '%)';

                            }

                        }

                    }

                }

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | PRIORITAS LAPORAN
    |--------------------------------------------------------------------------
    */

    new Chart(
        document.getElementById('priorityChart'),
        {

            type: 'bar',


            data: {

                labels: prioritasLabels,


                datasets: [

                    {

                        data: prioritasJumlah,


                        backgroundColor: [

                            '#72A9F8',

                            '#73D2A4',

                            '#F2768D'

                        ],


                        barThickness: 28,

                        borderRadius: 4,

                        borderSkipped: false

                    }

                ]

            },


            options: {

                indexAxis: 'y',

                responsive: true,

                maintainAspectRatio: false,


                plugins: {

                    legend: {

                        display: false

                    },


                    tooltip: {

                        callbacks: {

                            label: function(context) {

                                return context.parsed.x +
                                    ' laporan';

                            }

                        }

                    }

                },


                scales: {

                    x: {

                        beginAtZero: true,

                        ticks: {

                            precision: 0,

                            font: {

                                size: 10

                            },

                            color: '#65708a'

                        },


                        grid: {

                            color: '#e5ebf3',

                            borderDash: [
                                3,
                                3
                            ]

                        },


                        border: {

                            color: '#cfd6e2'

                        }

                    },


                    y: {

                        ticks: {

                            font: {

                                size: 10

                            },

                            color: '#202235'

                        },


                        grid: {

                            display: false

                        },


                        border: {

                            color: '#cfd6e2'

                        }

                    }

                }

            }

        }

    );

</script>

@endsection