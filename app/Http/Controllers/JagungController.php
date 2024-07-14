<?php

namespace App\Http\Controllers;

use App\Models\Jagung;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class JagungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produksis = Jagung::with('Kecamatan')->get();
        $kecamatans = Kecamatan::all();
        $title = 'Data Produksi Jagung';
        return view('dashboard.produksi.index')->with(compact('title', 'produksis', 'kecamatans'));
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
                'kecamatan' => 'required',
                'areaLahan' => 'required',
                'areaPanen' => 'required',
                'priode' => 'required',
                'totalProduktivitas' => 'required',
                'totalProduksi' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('produksi.index')->with('failed', $exception->getMessage());
        }

        Jagung::create($validatedData);

        return redirect()->route('produksi.index')->with('success', 'Produksi baru berhasil ditambahkan!');
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
    public function update(Request $request, Jagung $produksi)
    {
        try {
            $rules = [
                'kecamatan' => 'required',
                'areaLahan' => 'required',
                'areaPanen' => 'required',
                'priode' => 'required',
                'totalProduktivitas' => 'required',
                'totalProduksi' => 'required',
            ];

            $validatedData = $this->validate($request, $rules);

            Jagung::where('id', $produksi->id)->update($validatedData);

            return redirect()->route('produksi.index')->with('success', "Data Produksi " . $produksi->Kecamatan->nama . " berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('produksi.index')->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jagung $produksi)
    {
        try {
            Jagung::destroy($produksi->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->route('produksi.index')->with('failed', "Produksi " . $produksi->Kecamatan->nama . " tidak dapat dihapus, karena sedang digunakan!");
            }
        }

        return redirect()->route('produksi.index')->with('success', "Produksi " . $produksi->Kecamatan->nama . " berhasil dihapus!");
    }
}
