@extends('layout.master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah Data: {{ $pegawai->nama }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pegawai.index') }}">Daftar Pegawai</a></li>
                        <li class="breadcrumb-item active">Ubah Data</li>
                    </ol>
                </div>
            </div>
        </div></section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Form Ubah Data</h3>
                        </div>
                        <div class="card-body">
                            @include('pages.form', [
                                'action' => route('pegawai.update', $pegawai->id),
                                'pegawai' => $pegawai
                            ])
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection