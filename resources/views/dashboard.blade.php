@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-1 overflow-hidden">
                        <p class="text-truncate font-size-14 mb-2">Divisi</p>
                        <h4 class="mb-0">{{ $jumlah_divisi }}</h4>
                    </div>
                    <div class="text-primary ms-auto">
                        <i class="ri-stack-line font-size-24"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-1 overflow-hidden">
                        <p class="text-truncate font-size-14 mb-2">Anggota</p>
                        <h4 class="mb-0">{{ $jumlah_anggota }}</h4>
                    </div>
                    <div class="text-primary ms-auto">
                        <i class="ri-user-3-line font-size-24"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-1 overflow-hidden">
                        <p class="text-truncate font-size-14 mb-2">Kegiatan</p>
                        <h4 class="mb-0">{{ $jumlah_kegiatan }}</h4>
                    </div>
                    <div class="text-primary ms-auto">
                        <i class="ri-file-list-line font-size-24"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-3">Target & Realisasi Kegiatan 3 Kabinet Terakhir</h2>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-3">5 Kegiatan Terakhir</h2>
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kegiatan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_kegiatan }}</td>
                                <td>
                                    <a href="{{ route('kegiatan.show', $item->id) }}"
                                        class="btn btn-sm btn-info waves-effect waves-light">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    var data = {
    labels: {{ Js::from($nama_kabinet) }},
    datasets: [{
        label: 'Target',
        data: {{ Js::from($target) }},
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1
    }, {
        label: 'Realisasi',
        data: {{ Js::from($realisasi) }},
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
    }]

};

var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
        barValueSpacing: 20,
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                }
            }]
        }
    }
});
    </script>
@endpush
