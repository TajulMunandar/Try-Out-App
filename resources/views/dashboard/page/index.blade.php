@extends('dashboard.component.main')
@section('page-heading', 'Dashboard')

@section('content')
    <div class="container mb-4">
        <div class="row mb-3">
            <h2>Data Global</h2>
            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-body p-5">
                        <div class="row d-flex align-items-center">
                            <div class="col">
                                <h3 class="fw-light">Mahasiswa</h3>
                                <h3 class="fw-bold">{{ $mahasiswa }}</h3>
                            </div>
                            <div class="col">
                                <span class="float-end pe-3">
                                    <i class="fa-solid fa-user fs-2 text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-body p-5">
                        <div class="row d-flex align-items-center">
                            <div class="col">
                                <h3 class="fw-light">Mata Kuliah</h3>
                                <h3 class="fw-bold">{{ $prodi }}</h3>
                            </div>
                            <div class="col">
                                <span class="float-end pe-3">
                                    <i class="fa-solid fa-chalkboard-user fs-2 text-warning"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-body p-5">
                        <div class="row d-flex align-items-center">
                            <div class="col">
                                <h3 class="fw-light">Paket</h3>
                                <h3 class="fw-bold">{{ $paket }}</h3>
                            </div>
                            <div class="col">
                                <span class="float-end pe-3">
                                    <i class="fa-solid fa-book fs-2 text-danger"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contoh elemen div untuk menampilkan grafik -->
        <div class="row mb-2">
            <div class="col-lg-8">
                <h3>Traffic Pengunjung</h3>
                <div class="card">
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col">
                <h3>Highlight Try Out Terupdate</h3>
                <div class="row">
                    @foreach ($highlights as $materi)
                        <div class="col-lg-12">
                            <div class="card mb-5">
                                <div class="card-body">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-lg-2 text-center " style="width: 80px">
                                            <img src="{{ asset('images/avatar.png') }}" class="rounded-pill"
                                                style="max-width: 100%">
                                        </div>
                                        <div class="col-lg-9 ">
                                            <p class="fw-bold mb-0 fs-4">{{ $materi->mahasiswa_name }}</p>
                                            <table>
                                                <tr>
                                                    <td >Paket </td>
                                                    <td> : {{ $materi->paket_detail_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total Nilai </td>
                                                    <td> : {{ number_format((100 / $materi->total_jawaban) * $materi->score_benar, 2) }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


    </div>
@endsection

@section('scripts')
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Traffic',
                    borderColor: "#8f44fd",
                    backgroundColor: "#8f44fd",
                    data: {!! json_encode($chartData) !!},
                    fill: true,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        suggestedMin: 0,
                        suggestedMax: 50,
                        grid: {
                            display: true,
                            drawBorder: true,
                            drawOnChartArea: true,
                            drawTicks: true,
                            color: "rgba(255, 255, 255, 0.08)",
                            borderColor: "transparent",
                            borderDash: [5, 5],
                            borderDashOffset: 2,
                            tickColor: "transparent"
                        },
                        beginAtZero: true
                    }
                },
                tension: 0.3,
                elements: {
                    point: {
                        radius: 8,
                        hoverRadius: 12,
                        backgroundColor: "#9BD0F5",
                        borderWidth: 0,
                    },
                },
            }
        });
    </script>
@endsection
