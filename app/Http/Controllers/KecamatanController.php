<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kecamatans = Kecamatan::all();
        $title = 'Data Kecamatan';
        return view('dashboard.kecamatan.index')->with(compact('title', 'kecamatans')); //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required',
                'luas' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('kecamatan.index')->with('failed', $exception->getMessage());
        }

        Kecamatan::create($validatedData);

        return redirect()->route('kecamatan.index')->with('success', 'Kecamatan baru berhasil ditambahkan!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        try {
            $rules = [
                'nama' => 'required',
                'luas' => 'required',
            ];

            $validatedData = $this->validate($request, $rules);

            Kecamatan::where('id', $kecamatan->id)->update($validatedData);

            return redirect()->route('kecamatan.index')->with('success', "Data Kecamatan $kecamatan->nama berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('kecamatan.index')->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kecamatan $kecamatan)
    {
        try {
            Kecamatan::destroy($kecamatan->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->route('kecamatan.index')->with('failed', "Kecamatan $kecamatan->nama tidak dapat dihapus, karena sedang digunakan!");
            }
        }

        return redirect()->route('kecamatan.index')->with('success', "kecamatan $kecamatan->nama berhasil dihapus!");
    }
}
