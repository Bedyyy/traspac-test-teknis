<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Daftar Pegawai</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <style>
        /* Sembunyikan tombol saat print */
        @media print {
            .no-print {
                display: none;
            }
            /* Pastikan tabel menggunakan lebar penuh */
            table {
                width: 100% !important;
            }
            body {
                -webkit-print-color-adjust: exact; /* Memaksa print warna background */
            }
        }
        body {
            margin: 20px;
        }
        table th, table td {
            border: 1px solid #dee2e6 !important; /* Pastikan border terlihat */
            padding: .75rem;
        }
        table thead th {
            background-color: #f8f9fa; /* Warna header tabel */
        }
    </style>
</head>
<body onload="window.print()">

    <div class="container-fluid">
        <div class="row mb-3 no-print">
            <div class="col-12">
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="fas fa-print"></i> Cetak Ulang
                </button>
                <button onclick="window.close()" class="btn btn-danger">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h2 class="page-header">
                    <i class="fas fa-users"></i> DAFTAR PEGAWAI
                    <small class="float-right">Tanggal Cetak: {{ date('d-m-Y') }}</small>
                </h2>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Tempat, Tgl Lahir</th>
                            <th>L/P</th>
                            <th>Gol</th>
                            <th>Eselon</th>
                            <th>Jabatan</th>
                            <th>Unit Kerja</th>
                            <th>Agama</th>
                            <th>No. HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pegawais as $index => $pegawai)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pegawai->nip }}</td>
                            <td>{{ $pegawai->nama }}</td>
                            <td>{{ $pegawai->tempat_lahir }}, {{ \Carbon\Carbon::parse($pegawai->tgl_lahir)->format('d-m-Y') }}</td>
                            <td>{{ $pegawai->jenis_kelamin }}</td>
                            <td>{{ $pegawai->golongan->nama ?? '-' }}</td>
                            <td>{{ $pegawai->eselon->nama ?? '-' }}</td>
                            <td>{{ $pegawai->jabatan->nama ?? '-' }}</td>
                            <td>{{ $pegawai->unitKerja->nama ?? '-' }}</td>
                            <td>{{ $pegawai->agama->nama ?? '-' }}</td>
                            <td>{{ $pegawai->no_hp ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>