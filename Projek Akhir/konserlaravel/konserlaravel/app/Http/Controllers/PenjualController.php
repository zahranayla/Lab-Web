<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualController extends Controller
{
    public function index()
    {
        // Jumlah pesanan
        $jumlahPesanan = DB::table('pembelian')->count();

        // Jumlah user
        $jumlahUser = DB::table('pengguna')->count();

        // Jumlah stok
        $jumlahStok = DB::table('produk')->sum('stok');

        // Data untuk grafik pemesanan
        $orderData = DB::table('pembelian')
            ->select(DB::raw('DATE(tanggalbeli) as date'), DB::raw('count(*) as jumlah'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Data untuk grafik stok
        $stockData = DB::table('produk')
            ->select(DB::raw('DATE(tanggal) as date'), DB::raw('sum(stok) as jumlah'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Menggabungkan data pemesanan dan stok berdasarkan tanggal
        $dates = $orderData->pluck('date')->merge($stockData->pluck('date'))->unique()->sort()->values();

        $orderDataByDate = $orderData->keyBy('date');
        $stockDataByDate = $stockData->keyBy('date');

        $combinedOrderData = $dates->map(function ($date) use ($orderDataByDate) {
            return $orderDataByDate->has($date) ? $orderDataByDate[$date]->jumlah : 0;
        });

        $combinedStockData = $dates->map(function ($date) use ($stockDataByDate) {
            return $stockDataByDate->has($date) ? $stockDataByDate[$date]->jumlah : 0;
        });

        return view('penjual.dashboard', [
            'jumlahPesanan' => $jumlahPesanan,
            'jumlahUser' => $jumlahUser,
            'jumlahStok' => $jumlahStok,
            'combinedLabels' => $dates,
            'combinedOrderData' => $combinedOrderData,
            'combinedStockData' => $combinedStockData,
        ]);
    }

    public function kategori()
    {
        $data['kategori'] = DB::table('kategori')->where('idpenjual', session('pengguna')->id)->get();
        return view('penjual.kategori', $data);
    }

    public function tambahkategori()
    {

        return view('penjual.tambahkategori');
    }

    public function simpankategori(Request $request)
    {
        $data = [
            'namakategori' => $request->kategori,
            'idkategori' => $request->kategori,
            'idpenjual' => session('pengguna')->id
        ];
        KategoriModel::create($data);
        session()->flash('alert', 'Berhasil menambahkan data!');
        return redirect('penjual/kategori');
    }

    public function ubahkategori($id)
    {
        $data['kategori'] = KategoriModel::where('idkategori', $id)->first();
        return view('penjual.ubahkategori', $data);
    }

    public function updatekategori(Request $request, $id)
    {
        $data = [
            'namakategori' => $request->kategori
        ];
        KategoriModel::where('idkategori', $id)->update($data);
        session()->flash('alert', 'Berhasil mengubah data!');
        return redirect('penjual/kategori');
    }

    public function hapuskategori($id)
    {
        KategoriModel::where('idkategori', $id)->delete();
        session()->flash('alert', 'Berhasil menghapus data!');
        return redirect('penjual/kategori');
    }

    public function produk()
    {
        $produk = DB::table('produk')->leftJoin('kategori', 'produk.idkategori', '=', 'kategori.idkategori')->where('produk.idpenjual', session('pengguna')->id)->orderBy('idproduk', 'DESC')->get();
        $data['produk'] = $produk;
        return view('penjual.produk', $data);
    }

    public function tambahproduk()
    {
        $data['kategori'] = DB::table('kategori')->get();

        return view('penjual.tambahproduk', $data);
    }

    public function simpanproduk(Request $request)
    {
        $namafoto = $request->file('foto')->getClientOriginalName();
        $request->file('foto')->move(public_path('foto'), $namafoto);

        DB::table('produk')->insert([
            'nama' => $request->input('nama'),
            'idkategori' => $request->input('idkategori'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'foto' => $namafoto,
            'deskripsi' => $request->input('deskripsi'),
            'idpenjual' => session('pengguna')->id
        ]);
        session()->flash('alert', 'Berhasil menambah data!');

        return redirect('penjual/produk');
    }

    public function ubahproduk($id)
    {
        $data['produk'] = DB::table('produk')->where('idproduk', $id)->first();
        $data['kategori'] = DB::table('kategori')->get();
        return view('penjual.ubahproduk', $data);
    }

    public function updateproduk(Request $request, $id)
    {
        $data = [
            'nama' => $request->input('nama'),
            'idkategori' => $request->input('idkategori'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'deskripsi' => $request->input('deskripsi'),
        ];
        $produk = DB::table('produk')->where('idproduk', $id)->first();
        $fotoPath = public_path('foto/' . $produk->foto);
        if ($request->hasFile('foto')) {
            $namafoto = $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('foto'), $namafoto);
            $data['foto'] = $namafoto;
        }
        DB::table('produk')->where('idproduk', $id)->update($data);
        session()->flash('alert', 'Berhasil mengubah data!');
        return redirect('penjual/produk');
    }

    public function hapusproduk($id)
    {
        DB::table('produk')->where('idproduk', $id)->delete();
        session()->flash('alert', 'Berhasil menghapus data!');
        return redirect('penjual/produk');
    }

    public function pengguna()
    {
        $pengguna = DB::table('pengguna')->where('level', 'Pelanggan')->get();

        $data = [
            'pengguna' => $pengguna,
        ];

        return view('penjual.pengguna', $data);
    }

    public function logout()
    {
        session()->flush();
        return redirect('home')->with('alert', 'Anda Telah Logout');
    }

    public function pembelian()
    {
        $pembelian = DB::table('pembelian')->join('pembelianproduk', 'pembelian.idpembelian', '=', 'pembelianproduk.idpembelian')->join('produk', 'pembelianproduk.idproduk', '=', 'produk.idproduk')->where('produk.idpenjual', session('pengguna')->id)->orderBy('pembelian.tanggalbeli', 'desc')->orderBy('pembelian.idpembelian', 'desc')->get();

        $dataproduk = [];
        foreach ($pembelian as $row) {
            $idpembelian = $row->idpembelian;
            $produk = DB::table('pembelianproduk')
                ->join('produk', 'pembelianproduk.idproduk', '=', 'produk.idproduk')
                ->where('produk.idpenjual', session('pengguna')->id)
                ->where('idpembelian', $idpembelian)
                ->get();
            $dataproduk[$idpembelian] = $produk;
        }

        $data = [
            'pembelian' => $pembelian,
            'dataproduk' => $dataproduk,
        ];
        return view('penjual.pembelian', $data);
    }

    public function pembayaran($id)
    {
        $datapembelian = DB::table('pembelian')->where('pembelian.idpembelian', $id)->join('pembelianproduk', 'pembelian.idpembelian', '=', 'pembelianproduk.idpembelian')->join('produk', 'pembelianproduk.idproduk', '=', 'produk.idproduk')->where('produk.idpenjual', session('pengguna')->id)->first();
        $dataproduk = DB::table('pembelianproduk')
            ->join('produk', 'pembelianproduk.idproduk', '=', 'produk.idproduk')
            ->where('produk.idpenjual', session('pengguna')->id)
            ->where('idpembelian', $id)
            ->get();

        $pembayaran = DB::table('pembayaran')->where('idpembelian', $id)->first();

        $data = [
            'datapembelian' => $datapembelian,
            'dataproduk' => $dataproduk,
            'pembayaran' => $pembayaran,
        ];
        return view('penjual.pembayaran', $data);
    }

    public function exportpdf()
    {
        // Mengambil data pembelian dan produk
        $pembelian = DB::table('pembelian')->join('pengguna', 'pengguna.id', '=', 'pembelian.id')
            ->orderBy('pembelian.tanggalbeli', 'desc')->orderBy('pembelian.idpembelian', 'desc')->get();

        $dataproduk = [];
        foreach ($pembelian as $row) {
            $idpembelian = $row->idpembelian;
            $produk = DB::table('pembelianproduk')
                ->join('produk', 'pembelianproduk.idproduk', '=', 'produk.idproduk')
                ->where('idpembelian', $idpembelian)
                ->get();
            $dataproduk[$idpembelian] = $produk;
        }

        $data = [
            'pembelian' => $pembelian,
            'dataproduk' => $dataproduk,
        ];

        // Load view untuk laporan PDF
        $view = view('penjual.pembelian_pdf', $data)->render();

        // Inisialisasi DomPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        // Muat konten HTML
        $dompdf->loadHtml($view);

        // Set ukuran kertas dan orientasi (potrait atau landscape)
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Output PDF
        $dompdf->stream('laporan_pembelian.pdf', ['Attachment' => 1]);
    }

    public function simpanpembayaran($id, Request $request)
    {
        if ($request->has('proses')) {
            $statusbeli = $request->input('statusbeli');
            $pembelianproduk = DB::table('pembelianproduk')->where('idpembelian', $id)->get();

            // Update status pembelian
            DB::table('pembelian')->where('idpembelian', $id)->update([
                'statusbeli' => $statusbeli,
                'noresi' => $request->noresi
            ]);

            if ($request->statusbeli == 'Pesanan Di Terima') {
                foreach ($pembelianproduk as $key => $value) {
                    $idproduk = $value->idproduk;
                    $jumlahbeli = $value->jumlah;

                    // Mengurangi stok produk dengan metode update
                    $produk = DB::table('produk')->where('idproduk', $idproduk)->first();
                    $stokbaru = $produk->stok - $jumlahbeli;

                    DB::table('produk')->where('idproduk', $idproduk)->update(['stok' => $stokbaru]);
                }
            }


            return redirect('penjual/pembelian');
        }
    }

    public function apriori()
    {
        // Fetch items (produk) from the database
        $items = DB::table('produk')->where('idpenjual', session('pengguna')->id)->pluck('nama')->toArray();

        // Fetch transactions (Pembelian and PembelianProduk)
        $transactions = DB::table('pembelianproduk')
            ->join('produk', 'pembelianproduk.idproduk', '=', 'produk.idproduk')
            ->where('idpenjual', session('pengguna')->id)
            ->select(DB::raw('GROUP_CONCAT(produk.nama SEPARATOR ",") as item_set'))
            ->groupBy('pembelianproduk.idpembelian')
            ->pluck('item_set')
            ->toArray();

        $totalTransactions = count($transactions);

        // Periksa apakah totalTransactions sama dengan 0
        if ($totalTransactions === 0) {
            return view('penjual.apriori', [
                'itemSupport' => [],
                'pairSupport' => [],
                'tripleSupport' => [],
                'associationRules' => [],
                'transactions' => $transactions,
                'items' => $items,
            ]);
        }

        // Step 1: Count item frequencies
        $itemSupport = [];
        foreach ($items as $item) {
            $count = 0;
            foreach ($transactions as $transaction) {
                if (strpos($transaction, $item) !== false) {
                    $count++;
                }
            }
            $support = round(($count / $totalTransactions) * 100, 2);
            $itemSupport[$item] = ['count' => $count, 'support' => $support];
        }

        // Step 2: Count pair item sets (2-item combinations)
        $pairSupport = [];
        for ($i = 0; $i < count($items); $i++) {
            for ($j = $i + 1; $j < count($items); $j++) {
                $pair = $items[$i] . '|' . $items[$j];
                $count = 0;
                foreach ($transactions as $transaction) {
                    if (strpos($transaction, $items[$i]) !== false && strpos($transaction, $items[$j]) !== false) {
                        $count++;
                    }
                }
                $support = round(($count / $totalTransactions) * 100, 2);
                if ($count > 0) {
                    $pairSupport[$pair] = ['count' => $count, 'support' => $support];
                }
            }
        }

        // Step 3: Count 3-item combinations
        $tripleSupport = [];
        for ($i = 0; $i < count($items); $i++) {
            for ($j = $i + 1; $j < count($items); $j++) {
                for ($k = $j + 1; $k < count($items); $k++) {
                    $triple = $items[$i] . ' | ' . $items[$j] . ' | ' . $items[$k];
                    $count = 0;
                    foreach ($transactions as $transaction) {
                        if (strpos($transaction, $items[$i]) !== false && strpos($transaction, $items[$j]) !== false && strpos($transaction, $items[$k]) !== false) {
                            $count++;
                        }
                    }
                    $support = round(($count / $totalTransactions) * 100, 2);
                    if ($count > 0) {
                        $tripleSupport[$triple] = ['count' => $count, 'support' => $support];
                    }
                }
            }
        }

        // Step 4: Association Rules (Confidence > 40%)
        $associationRules = [];
        foreach ($pairSupport as $pair => $data) {
            $items = explode('|', $pair);
            foreach ($items as $item) {
                $total = $itemSupport[$item]['count'];
                if ($total > 0) {
                    $confidence = round(($data['count'] / $total) * 100, 2);
                    if ($confidence > 40 && $confidence < 100) {
                        $associationRules[] = [
                            'rule' => "$pair --> $item",
                            'confidence' => $confidence
                        ];
                    }
                }
            }
        }

        return view('penjual.apriori', compact('itemSupport', 'pairSupport', 'tripleSupport', 'associationRules', 'transactions', 'items'));
    }


    public function setting()
    {
        $data['setting'] = DB::table('setting')->where('idpenjual', session('pengguna')->id)->get();

        return view('penjual.setting', $data);
    }

    public function tambahsetting()
    {
        return view('penjual.tambahsetting');
    }

    public function simpansetting(Request $request)
    {
        DB::table('setting')->insert([
            'rekening' => $request->rekening,
            'idpenjual' => session('pengguna')->id,
            'norek' => $request->norek,
            'atasnama' => $request->atasnama,
        ]);

        return redirect('penjual/setting')->with('alert', 'Berhasil menambahkan data!');
    }

    public function ubahsetting($id)
    {
        $data['setting'] = DB::table('setting')->where('idsetting', $id)->first();

        return view('penjual.ubahsetting', $data);
    }

    public function updatesetting(Request $request, $id)
    {
        DB::table('setting')->where('idsetting', $id)->update([
            'rekening' => $request->rekening,
            'norek' => $request->norek,
            'atasnama' => $request->atasnama,
        ]);

        return redirect('penjual/setting')->with('alert', 'Berhasil mengubah data!');
    }
}
