@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @if(isset($pegawai))
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" 
                       value="{{ old('nip', $pegawai->nip ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" 
                       value="{{ old('nama', $pegawai->nama ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" 
                       value="{{ old('tempat_lahir', $pegawai->tempat_lahir ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" 
                       value="{{ old('tgl_lahir', $pegawai->tgl_lahir ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin (Radio Button)</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="L" value="L" 
                           {{ (old('jenis_kelamin', $pegawai->jenis_kelamin ?? '') == 'L') ? 'checked' : '' }} required>
                    <label class="form-check-label" for="L">Laki-laki</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="P" value="P"
                           {{ (old('jenis_kelamin', $pegawai->jenis_kelamin ?? '') == 'P') ? 'checked' : '' }}>
                    <label class="form-check-label" for="P">Perempuan</label>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $pegawai->alamat ?? '') }}</textarea>
            </div>
            
            <div class="form-group">
                <label for="foto">Upload Foto</label>
                <input type="file" class="form-control-file" id="foto" name="foto">
                @if(isset($pegawai) && $pegawai->foto_path)
                    <small class="form-text text-muted">Foto saat ini:</small>
                    <img src="{{ Storage::url($pegawai->foto_path) }}" alt="Foto" width="100" class="img-thumbnail mt-2">
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tempat_tugas">Tempat Tugas</label>
                <input type="text" class="form-control" id="tempat_tugas" name="tempat_tugas" 
                       value="{{ old('tempat_tugas', $pegawai->tempat_tugas ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="no_hp">No. HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" 
                       value="{{ old('no_hp', $pegawai->no_hp ?? '') }}">
            </div>
            <div class="form-group">
                <label for="npwp">NPWP</label>
                <input type="text" class="form-control" id="npwp" name="npwp" 
                       value="{{ old('npwp', $pegawai->npwp ?? '') }}">
            </div>

            <div class="form-group">
                <label for="agama_id">Agama</label>
                <select class="form-control" id="agama_id" name="agama_id" required>
                    <option value="">-- Pilih Agama --</option>
                    @foreach($agamas as $agama)
                    <option value="{{ $agama->id }}" 
                            {{ (old('agama_id', $pegawai->agama_id ?? '') == $agama->id) ? 'selected' : '' }}>
                        {{ $agama->nama }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="golongan_id">Golongan</label>
                <select class="form-control" id="golongan_id" name="golongan_id" required>
                    <option value="">-- Pilih Golongan --</option>
                    @foreach($golongans as $golongan)
                    <option value="{{ $golongan->id }}" 
                            {{ (old('golongan_id', $pegawai->golongan_id ?? '') == $golongan->id) ? 'selected' : '' }}>
                        {{ $golongan->nama }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="eselon_id">Eselon</label>
                <select class="form-control" id="eselon_id" name="eselon_id" required>
                    <option value="">-- Pilih Eselon --</option>
                    @foreach($eselons as $eselon)
                    <option value="{{ $eselon->id }}" 
                            {{ (old('eselon_id', $pegawai->eselon_id ?? '') == $eselon->id) ? 'selected' : '' }}>
                        {{ $eselon->nama }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="jabatan_id">Jabatan</label>
                <select class="form-control" id="jabatan_id" name="jabatan_id" required>
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach($jabatans as $jabatan)
                    <option value="{{ $jabatan->id }}" 
                            {{ (old('jabatan_id', $pegawai->jabatan_id ?? '') == $jabatan->id) ? 'selected' : '' }}>
                        {{ $jabatan->nama }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="unit_kerja_id">Unit Kerja</label>
                <select class="form-control" id="unit_kerja_id" name="unit_kerja_id" required>
                    <option value="">-- Pilih Unit Kerja --</option>
                    @foreach($unitKerjas as $unit)
                    <option value="{{ $unit->id }}" 
                            {{ (old('unit_kerja_id', $pegawai->unit_kerja_id ?? '') == $unit->id) ? 'selected' : '' }}>
                        {{ $unit->nama }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Simpan Data</button>
        <a href="{{ route('pegawai.index') }}" class="btn btn-default">Batal</a>
    </div>
</form>