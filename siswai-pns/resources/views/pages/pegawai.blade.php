@extends('layout.master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Pegawai</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Daftar Pegawai</li>
                    </ol>
                </div>
            </div>
        </div></section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Filter Unit Kerja</h3>
                        </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('pegawai.index') }}" class="nav-link {{ request()->missing('unit_kerja_id') ? 'active' : '' }}">
                                        <i class="fas fa-sitemap"></i> Tampilkan Semua
                                    </a>
                                </li>
                                @foreach($unitKerjas as $unit)
                                    <li class="nav-item">
                                        <a href="{{ route('pegawai.index', ['unit_kerja_id' => $unit->id]) }}" 
                                           class="nav-link {{ request('unit_kerja_id') == $unit->id ? 'active' : '' }}">
                                            <i class="far fa-circle"></i> {{ $unit->nama }}
                                        </a>
                                        @if($unit->children->count() > 0)
                                        <ul class="nav nav-pills flex-column ml-3">
                                            @foreach($unit->children as $child)
                                            <li class="nav-item">
                                                <a href="{{ route('pegawai.index', ['unit_kerja_id' => $child->id]) }}"
                                                   class="nav-link {{ request('unit_kerja_id') == $child->id ? 'active' : '' }}">
                                                    <i class="far fa-dot-circle"></i> {{ $child->nama }}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        </div>
                    </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('pegawai.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Tambah Pegawai
                                    </a>
                                    <a href="{{ route('pegawai.print', request()->query()) }}" class="btn btn-info" target="_blank">
                                        <i class="fas fa-print"></i> Cetak
                                    </a>
                                </div>
                                <form method="GET" action="{{ route('pegawai.index') }}" class="form-inline">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="search" class="form-control" placeholder="Cari Nama/NIP..." value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Unit Kerja</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pegawais as $pegawai)
                                    <tr>
                                        <td>
                                            @if($pegawai->foto_path)
                                                <img src="{{ Storage::url($pegawai->foto_path) }}" alt="Foto" width="50">
                                            @else
                                                <img src="/img/default-avatar.png" alt="Foto" width="50">
                                            @endif
                                        </td>
                                        <td>{{ $pegawai->nip }}</td>
                                        <td>{{ $pegawai->nama }}</td>
                                        <td>{{ $pegawai->jabatan->nama ?? '-' }}</td>
                                        <td>{{ $pegawai->unitKerja->nama ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            {{ $pegawais->withQueryString()->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection