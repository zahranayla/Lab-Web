<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $event = DB::table('event')->orderBy('idevent', 'desc')->limit(6)->get();
        $data = [
            'event' => $event,
        ];

        return view('home/index', $data);
    }

    public function deletenotification($id)
    {
        DB::table('notifikasi')->where('idnotifikasi', $id)->delete();
        return back();
    }

    public function bersihkannotifikasi()
    {
        $iduser = session('pengguna')->id;
        DB::table('notifikasi')->where('id', $iduser)->delete();
        return back();
    }

    public function event()
    {
        $event = DB::table('event')->orderBy('idevent', 'desc')->paginate(6);
        $data = [
            'events' => $event,
        ];
        return view('home/event', $data);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $events = DB::table('event')
            ->where('judul', 'LIKE', "%{$query}%")
            ->orWhere('lokasi', 'LIKE', "%{$query}%")
            ->orWhereDate('tanggalevent', '=', $query) // Jika Anda ingin mencari berdasarkan tanggal
            ->get();

        return view('home.event', compact('events'));
    }
    public function filter(Request $request)
    {
        $eventDate = $request->input('event_date');

        $events = DB::table('event')
            ->whereDate('tanggalevent', '=', $eventDate)
            ->get();

        return view('home.event', compact('events'));
    }





    public function detail($id)
    {
        $event = DB::table('event')
            ->where('idevent', $id)
            ->first();



        $data = [
            'event' => $event,
        ];

        return view('home.detail', $data);
    }

    public function favorit(Request $request)
    {
        // Periksa apakah pengguna sudah login
        if (!session('pengguna')) {
            session()->flash('alert', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect('home/login');
        }

        $iduser = session('pengguna')->id; // Ambil ID pengguna dari session
        $idevent = $request->input('idevent');

        // Cek apakah event sudah ada di favorit
        $cekFavorit = DB::table('favorit')
            ->where('iduser', $iduser)
            ->where('idevent', $idevent)
            ->first();

        if ($cekFavorit) {
            return redirect()->back()->with('alert', 'Event ini sudah ada di daftar favorit Anda.');
        }

        // Simpan ke tabel favorit
        DB::table('favorit')->insert([
            'iduser' => $iduser,
            'idevent' => $idevent,
            'waktu' => now(),
        ]);

        return redirect()->back()->with('success', 'Event berhasil ditambahkan ke favorit.');
    }

    public function hapusFavorit(Request $request)
    {
        if (!session('pengguna')) {
            session()->flash('alert', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect('home/login');
        }

        $iduser = session('pengguna')->id;
        $idevent = $request->input('idevent');

        DB::table('favorit')
            ->where('iduser', $iduser)
            ->where('idevent', $idevent)
            ->delete();

        return redirect()->back()->with('success', 'Event berhasil dihapus dari favorit.');
    }

    public function favoritdaftar()
    {
        if (!session('pengguna')) {
            return redirect('home/login')->with('alert', 'Anda harus login terlebih dahulu.');
        }

        // Ambil data favorit berdasarkan pengguna yang sedang login
        $iduser = session('pengguna')->id;
        $favorit = DB::table('favorit')
            ->join('event', 'favorit.idevent', '=', 'event.idevent')
            ->where('favorit.iduser', $iduser)
            ->select('event.*')
            ->get();

        $data = [
            'favorit' => $favorit
        ];
        return view('home.favorit', $data);
    }


    public function daftar()
    {
        return view('home.daftar');
    }

    public function dodaftar(Request $request)
    {
        $nama = $request->input('nama');
        $email = $request->input('email');
        $password = $request->input('password');
        $alamat = $request->input('alamat');
        $telepon = $request->input('telepon');
        $jekel = $request->input('jekel');
        $tgl_lahir = $request->input('tgl_lahir');
        $tempat_lahir = $request->input('tempat_lahir');
        $existingUser = DB::table('pengguna')->where('email', $email)->count();

        if ($existingUser == 1) {
            return redirect()->back()->with('alert', 'Pendaftaran Gagal, email sudah ada');
        } else {
            DB::table('pengguna')->insert([
                'nama' => $nama,
                'email' => $email,
                'password' => $password,
                'alamat' => $alamat,
                'telepon' => $telepon,
                'jekel' => $jekel,
                'tgl_lahir' => $tgl_lahir,
                'tempat_lahir' => $tempat_lahir,
                'fotoprofil' => 'Untitled.png',
                'level' => 'User'
            ]);

            return redirect('home/login')->with('alert', 'Pendaftaran Berhasil');
        }
    }

    public function login()
    {
        return view('home.login');
    }

    public function dologin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $akun = DB::table('pengguna')
            ->where('email', $email)
            ->where('password', $password)
            ->first();

        if ($akun) {
            if ($akun->level == "User") {
                session(['pengguna' => $akun]);
                return redirect('home')->with('alert', 'Anda sukses login');
            } elseif ($akun->level == "EO") {
                session(['eo' => $akun]);
                return redirect('eo')->with('alert', 'Anda sukses login');
            } elseif ($akun->level == "Admin") {
                session(['admin' => $akun]);
                return redirect('admin')->with('alert', 'Anda sukses login');
            }
        } else {
            return redirect()->back()->with('alert', 'Email atau Password anda salah');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('home')->with('alert', 'Anda Telah Logout');
    }

    public function akun()
    {
        if (!session('pengguna')) {

            session()->flash('alert', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect('home/login');
        }

        $idpengguna = session('pengguna')->id;
        $pengguna = DB::table('pengguna')->where('id', $idpengguna)->first();

        $data = [
            'pengguna' => $pengguna,
        ];
        return view('home.akun', $data);
    }

    public function ubahakun(Request $request, $id)
    {
        $password = $request->input('password');
        if (empty($password)) {
            $password = $request->input('passwordlama');
        }
        DB::table('pengguna')
            ->where('id', $id)
            ->update([
                'password' => $password,
                'nama' => $request->input('nama'),
                'email' => $request->input('email'),
                'telepon' => $request->input('telepon'),
                'alamat' => $request->input('alamat'),
                'jekel' => $request->input('jekel'),
                'tgl_lahir' => $request->input('tgl_lahir'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'provinsi' => $request->input('provinsi'),
                'kota' => $request->input('kota'),
                'kec' => $request->input('kec'),
                'kode_pos' => $request->input('kode_pos'),
            ]);

        return redirect('home/akun');
    }


    public function pesan(Request $request)
    {
        // Cek apakah pengguna sudah login
        if (!session('pengguna')) {
            session()->flash('alert', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect('home/login');
        }

        $id = session('pengguna')->id;
        $idevent = $request->input('idevent');

        $event = DB::table('event')->where('idevent', $idevent)->first();

        // Cek apakah event ditemukan dan kuota masih tersedia
        if (!$event) {
            session()->flash('alert', 'Event tidak ditemukan.');
            return redirect()->back();
        }

        if ($event->kuota <= 0) {
            session()->flash('alert', 'Kuota untuk event ini sudah habis.');
            return redirect()->back();
        }

        DB::table('pesertaevent')->insert([
            'idevent' => $request->input('idevent'),
            'id' =>  $id,
            'tanggalpemesanan' => now(),
            'status' => 'Menunggu Pembayaran',
        ]);

        DB::table('event')->where('idevent', $idevent)->decrement('kuota', 1);


        session()->flash('alert', 'Tiket berhasil dipesan. Silakan selesaikan pembayaran!');
        return redirect('home/riwayat');
    }

    public function riwayat()
    {
        if (!session('pengguna')) {
            session()->flash('alert', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect('home/login');
        }
        $idpengguna = session('pengguna')->id;
        $databeli = DB::table('pesertaevent')
            ->leftJoin('event', 'pesertaevent.idevent', '=', 'event.idevent')
            ->where('pesertaevent.id', $idpengguna)
            ->paginate(10);


        $data = [
            'databeli' => $databeli,
        ];

        return view('home.riwayat', $data);
    }

    public function invoice($id)
    {
        if (!session('pengguna')) {

            session()->flash('alert', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect('home/login');
        }
        $datapembelian = DB::table('pembelian')->where('pembelian.idpembelian', $id)->first();
        $dataproduk = DB::table('pembelianproduk')
            ->join('produk', 'pembelianproduk.idproduk', '=', 'produk.idproduk')
            ->where('idpembelian', $id)
            ->get();

        $data = [
            'datapembelian' => $datapembelian,
            'dataproduk' => $dataproduk,
        ];

        return view('home.invoice', $data);
    }

    public function detailtransaksi($id)
    {
        if (!session('pengguna')) {

            session()->flash('alert', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect('home/login');
        }
        $datapembelian = DB::table('pesertaevent')->join('pengguna', 'pengguna.id', '=', 'pesertaevent.id')
            ->where('pesertaevent.idpesertaevent', $id)->first();
        $dataevent = DB::table('pesertaevent')
            ->join('event', 'pesertaevent.idevent', '=', 'event.idevent')
            ->where('idpesertaevent', $id)
            ->get();

        $data = [
            'datapembelian' => $datapembelian,
            'dataevent' => $dataevent,
        ];

        return view('home.detailtransaksi', $data);
    }

    public function pembayaran($id)
    {
        if (!session('pengguna')) {

            session()->flash('alert', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect('home/login');
        }
        $datapembelian = DB::table('pembelian')->join('pengguna', 'pengguna.id', '=', 'pembelian.id')
            ->where('pembelian.idpembelian', $id)->first();
        $dataproduk = DB::table('pembelianproduk')
            ->join('produk', 'pembelianproduk.idproduk', '=', 'produk.idproduk')
            ->where('idpembelian', $id)
            ->get();

        $data = [
            'datapembelian' => $datapembelian,
            'dataproduk' => $dataproduk,
        ];

        return view('home.pembayaran', $data);
    }

    public function pembayaransimpan(Request $request)
    {
        $this->validate($request, [
            'bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tanggaltransfer' => 'required|date',
        ]);

        $namabukti = $request->file('bukti')->getClientOriginalName();
        $namafix = date("YmdHis") . $namabukti;
        $request->file('bukti')->move('foto', $namafix);

        $idpesertaevent = $request->input('idpesertaevent');
        $tanggaltransfer = $request->input('tanggaltransfer');
        $tanggal = date("Y-m-d");

        DB::table('pesertaevent')->where('idpesertaevent', $idpesertaevent)->update([
            'bukti' => $namafix,
            'tanggaltransfer' => $tanggaltransfer,
            'status' => 'Menunggu Konfirmasi',
        ]);

        return redirect('home/riwayat')->with('alert', 'Terima kasih, bukti pembayaran Anda telah diupload dan sedang menunggu konfirmasi.');
    }

    public function batalkanPesanan(Request $request)
    {
        if (!session('pengguna')) {
            session()->flash('alert', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect('home/login');
        }
    
        $idpesertaevent = $request->input('idpesertaevent');
        $idevent = $request->input('idevent');
    
        // Hapus pesanan berdasarkan idpesertaevent
        DB::table('pesertaevent')->where('idpesertaevent', $idpesertaevent)->delete();
        DB::table('event')->where('idevent', $idevent)->increment('kuota', 1);
    
        return redirect()->back()->with('success', 'Pesanan telah dibatalkan.');
    }

    public function selesai(Request $request)
    {
        $idpembelian = $request->input('idpembelian');
        DB::table('pembelian')->where('idpembelian', $idpembelian)->update([
            'statusbeli' => 'Selesai'
        ]);
        return redirect('home/riwayat');
    }
}
