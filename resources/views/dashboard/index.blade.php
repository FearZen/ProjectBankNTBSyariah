@extends('layouts.app')

@section('title', 'Dashboard')

@section('header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@endsection

@section('content')
<style>
    .btn-custom {
        background-color: #BEDC74; /* Warna latar belakang tombol */
        color: #000; /* Warna teks tombol */
        border: none; /* Menghilangkan border default */
        border-radius: 0.25rem; /* Radius border tombol */
        padding: 0.5rem 1rem; /* Padding tombol */
        font-size: 16px; /* Ukuran font tombol */
        text-decoration: none; /* Menghilangkan underline */
    }

    .btn-custom:hover {
        background-color: #387F39; /* Warna latar belakang tombol saat hover */
        color: #fff; /* Warna teks tombol saat hover */
    }

    .btn-custom:active {
        background-color: #A2CA71; /* Warna latar belakang tombol saat diklik */
        color: #000; /* Warna teks tombol saat diklik */
    }

    .btn-custom:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.2); /* Fokus border shadow */
    }
</style>

<div class="row">
    <!-- Total Forms Card -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalForms }}</h3>
                <p>Total Formulir</p>
            </div>
            <div class="icon">
                <i class="fas fa-folder"></i>
            </div>
            <a href="{{ route('access_forms.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Total Visitors Card -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalVisitors }}</h3>
                <p>Total Pengunjung</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('visitors.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Recent Forms Card -->
    <div class="col-lg-6 col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulir Terbaru</h3>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($recentForms as $form)
                        <li class="list-group-item">
                            <strong>{{ $form->requestor_name }}</strong> - {{ $form->created_at->format('d M Y H:i') }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-footer">
                <a href="{{ route('access_forms.index') }}" class="btn btn-custom">Lihat Semua Formulir</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Visitors Chart -->
    <div class="col-lg-6 col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Statistik Pengunjung</h3>
            </div>
            <div class="card-body">
                <canvas id="visitors-chart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Monthly Forms Chart -->
    <div class="col-lg-6 col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulir Per Bulan</h3>
            </div>
            <div class="card-body">
                <canvas id="forms-chart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            // Data for Visitors Chart
            var ctx1 = document.getElementById('visitors-chart').getContext('2d');
            var visitorsChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: @json($visitorLabels),
                    datasets: [{
                        label: 'Pengunjung',
                        data: @json($visitorData),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Data for Forms Chart
            var ctx2 = document.getElementById('forms-chart').getContext('2d');
            var formsChart = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: @json($monthLabels),
                    datasets: [{
                        label: 'Formulir',
                        data: @json($monthlyFormsData),
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
