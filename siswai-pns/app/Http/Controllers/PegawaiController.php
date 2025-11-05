<?php

namespace App\Http\Controllers;
use App\Models\Pegawai;
use App\Models\Golongan;
use App\Models\Eselon;
use App\Models\Jabatan;
use App\Models\Agama;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pegawai::with('jabatan', 'golongan', 'unitKerja');

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('nip', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('unit_kerja_id')) {
            $query->where('unit_kerja_id', $request->unit_kerja_id);
        }

        $pegawais = $query->latest()->paginate(10);
        $unitKerjas = UnitKerja::whereNull('parent_id')->with('children')->get();
        return view('pages.pegawai', compact('pegawais', 'unitKerjas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'jabatans' => Jabatan::all(),
            'golongans' => Golongan::all(),
            'eselons' => Eselon::all(),
            'agamas' => Agama::all(),
            'unitKerjas' => UnitKerja::all(),
        ];

        return view('pages.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nip' => 'required|string|max:20|unique:pegawais',
            'nama' => 'required|string|max:150',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'tempat_tugas' => 'required|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'npwp' => 'nullable|string|max:25|unique:pegawais',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'agama_id' => 'required|exists:agamas,id',
            'golongan_id' => 'required|exists:golongans,id',
            'eselon_id' => 'required|exists:eselons,id',
            'jabatan_id' => 'required|exists:jabatans,id',
            'unit_kerja_id' => 'required|exists:unit_kerjas,id',
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/foto_pegawai');
            $validatedData['foto_path'] = $path;
        }

        unset($validatedData['foto']);
        Pegawai::create($validatedData);
        return redirect('/pegawai')->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        $data = [
            'jabatans' => Jabatan::all(),
            'golongans' => Golongan::all(),
            'eselons' => Eselon::all(),
            'agamas' => Agama::all(),
            'unitKerjas' => UnitKerja::all(),
            'pegawai' => $pegawai, // Kirim data pegawai yang mau diedit
        ];

        return view('pages.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $validatedData = $request->validate([
            'nip' => ['required','string','max:20', Rule::unique('pegawais')->ignore($pegawai->id)],
            'nama' => 'required|string|max:150',
            'tempat_lahir' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'agama_id' => 'required|exists:agamas,id',
        ]);

        if ($request->hasFile('foto')) {
            if ($pegawai->foto_path) {
                Storage::delete($pegawai->foto_path);
            }
            $path = $request->file('foto')->store('public/foto_pegawai');
            $validatedData['foto_path'] = $path;
        }

        unset($validatedData['foto']);
        $pegawai->update($validatedData);
        return redirect('/pegawai')->with('success', 'Data pegawai berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        if ($pegawai->foto_path) {
            Storage::delete($pegawai->foto_path);
        }
        $pegawai->delete();
        return redirect('/pegawai')->with('success', 'Data pegawai berhasil dihapus.');
    }

    public function print(Request $request)
    {
        $query = Pegawai::with('jabatan', 'golongan', 'unitKerja', 'eselon', 'agama');
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('nip', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('unit_kerja_id')) {
            $query->where('unit_kerja_id', $request->unit_kerja_id);
        }
        $pegawais = $query->latest()->get();
        return view('pages.print', compact('pegawais'));
    }
}
