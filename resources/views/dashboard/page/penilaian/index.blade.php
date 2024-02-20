@extends('dashboard.component.main')
@section('title', 'Data Penilaian')
@section('page-heading', 'Data Penilaian')

@section('content')

@dd($paket_details)
    {{--  ALERT  --}}
    <div class="row mt-3">
        <div class="col">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    {{--  ALERT  --}}

    {{--  CONTENT  --}}
    <div class="row mt-3 mb-5">
        <div class="col">
            <div class="card mt-3 col-sm-6 col-md-12">
                <div class="card-body">

                    {{-- tables --}}
                    <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mahasiswa</th>
                                <th>Paket Detail</th>
                                <th>Total Soal</th>
                                <th>Total Benar</th>
                                <th>Nilai</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scores as $score)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $score->mahasiswa_name }}</td>
                                    <td>{{ $score->paket_detail_name }}</td>
                                    <td>{{ $score->total_jawaban }}</td>
                                    <td>{{ $score->score_benar }}</td>
                                    <td>{{ number_format((100 / $score->total_jawaban) * $score->score_benar, 2) }}</td>
                                    <td>
                                        @php
                                            $lulus = number_format((100 / $score->total_jawaban) * $score->score_benar, 2) > 70;
                                        @endphp

                                        <p class="badge bg-{{ $lulus ? 'success' : 'danger' }} mt-2">
                                            {{ $lulus ? 'Lulus' : 'Tidak Lulus' }}
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3 mb-5">
        <h2>Grafis Statistik Score</h2>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    {{--  CONTENT  --}}

@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('myChart');

    // Data dummy
    const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May']; // Ganti dengan label bulan yang sesuai
    const data = [30, 22, 18, 25, 30]; // Data dummy untuk sumbu y

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Traffic',
                borderColor: "#8f44fd",
                backgroundColor: "#8f44fd",
                data: data,
                fill: true,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    suggestedMin: 0,
                    suggestedMax: 100,
                    ticks: {
                        callback: function(value, index, values) {
                            return [30, 50, 70, 100].includes(value) ? value : '';
                        },
                    },
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
