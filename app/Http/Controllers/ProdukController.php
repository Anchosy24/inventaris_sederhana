<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class ProdukController extends Controller
{
    public function index() {
        $produk = Produk::all();
    
        return view('view', [
            'produk' => $produk
        ]);
    }

    public function addProduk (Request $request) {
        $globalValidatorData = [
            'id' => ['required', Rule::unique('produks', 'id')],
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ];

        $globalValidator = Validator::make($request->all(), $globalValidatorData);

        if ($globalValidator->fails()) {
            return redirect()->back()->with('error', 'Terdapat ID produk yang Sama dalam data atau belum ada data yang dimasukkan pada form!!!')->withInput();
        }

        $data = $request->all();

        try{
            $produk = produk::create($data);
        }
        catch(Exception $e){
            return redirect()->back()->withError($e)->withInput()->with('error', 'Cek pada form produk apakah ada kesalahan yang terjadi');
        }

        return redirect()->route('index')->with('success', 'Data produk berhasil ditambahkan');
    }

    public function editProduk($id){
        $produk = Produk::findOrFail($id);
        return view('form', [
            'produk' => $produk,
        ]);
    }

    public function updateProduk(Request $request, $id){
        $globalValidatorData = [
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ];

        $globalValidator = Validator::make($request->all(), $globalValidatorData);

        if ($globalValidator->fails()) {
            return redirect()->back()->withErrors($globalValidator)->withInput();
        }

        $produk = Produk::findOrFail($id);

        $produk->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect()->route('index')->with('success', 'Data produk berhasil diperbarui');
    }

    public function deleteProduk($id){
        $produk = Produk::findOrFail($id);

        $produk->delete();
        return redirect()->route('index')->with('success', 'Data produk berhasil dihapus');
    }

    public function cetakLaporan() {
        $today = now()->format('Y-m-d');            
        $produkTerbaru = Produk::whereDate('created_at', $today)->orderByDesc('created_at')->get();
        $stokTipis = Produk::where('stok', '<', 15)->orderByDesc('stok')->get();
    
        $pdf = PDF::loadView('laporan', [
            'produkTerbaru' => $produkTerbaru,
            'stokTipis' => $stokTipis,
        ]);

        return $pdf->stream('Laporan Pengadaan Produk '.$today.'.pdf');
    }
}
