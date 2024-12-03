<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $jumlahevent = DB::table('event')->count();
        return view('admin.dashboard', [
            'jumlahevent' => $jumlahevent,

        ]);
    }

    public function eventdaftar()
    {
        $events = DB::table('event')->join('pengguna','pengguna.id','=','event.ideo')->orderBy('idevent', 'DESC')->get();
        $data['events'] = $events;
        return view('admin.eventdaftar', $data);
    }

    public function eventtambah()
    {
        $data['kategori'] = '';

        return view('admin.eventtambah', $data);
    }


    public function eventtambahsimpan(Request $request)
    {
        // Validasi input form
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'foto' => 'required|image|max:2048',
        ]);

        // Menyimpan file foto
        $namafoto = $request->file('foto')->getClientOriginalName();
        $request->file('foto')->move(public_path('foto'), $namafoto);

        // Menyimpan data ke tabel event
        DB::table('event')->insert([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'tanggalevent' => $request->input('tanggalevent'),
            'jamevent' => $request->input('jamevent'),
            'lokasi' => $request->input('lokasi'),

            'foto' => $namafoto,
        ]);

        // Memberikan feedback sukses
        session()->flash('alert', 'Event berhasil ditambahkan!');

        return redirect('admin/eventdaftar');
    }

    public function eventedit($id)
    {
        $event = DB::table('event')->where('idevent', $id)->first();

        if (!$event) {
            return redirect('eo/eventdaftar')->with('alert', 'Event tidak ditemukan!');
        }

        $data['event'] = $event;

        return view('admin.eventedit', $data);
    }


    public function eventeditsimpan(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Ambil data event lama
        $event = DB::table('event')->where('idevent', $id)->first();

        // Jika event tidak ditemukan, redirect dengan pesan error
        if (!$event) {
            return redirect('admin/eventdaftar')->with('alert', 'Event tidak ditemukan!');
        }

        // Proses update
        $updateData = [
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'tanggalevent' => $request->input('tanggalevent'),
            'jamevent' => $request->input('jamevent'),
            'lokasi' => $request->input('lokasi'),
        ];

        // Jika ada foto baru, upload dan ganti foto lama
        if ($request->hasFile('foto')) {
            $namafoto = $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('foto'), $namafoto);
            $updateData['foto'] = $namafoto;
        }

        DB::table('event')->where('idevent', $id)->update($updateData);

        // Memberikan feedback sukses
        session()->flash('alert', 'Event berhasil diubah!');
        return redirect('admin/eventdaftar');
    }

    public function eventhapus($id)
    {
        DB::table('event')->where('idevent', $id)->delete();
        session()->flash('alert', 'Berhasil menghapus data!');
        return redirect('admin/eventdaftar');
    }

    public function pesertadaftar($id)
    {
        $peserta = DB::table('pesertaevent')
        ->join('pengguna', 'pengguna.id', '=', 'pesertaevent.id')
        ->where('pesertaevent.idevent', $id)
            ->get();

        $event = DB::table('event')->where('idevent', $id)->first();

        return view('admin.pesertadaftar', [
            'peserta' => $peserta,
            'event' => $event,
        ]);
    }

    public function pesertadetail($id)
    {
        // Ambil data peserta berdasarkan ID
        $peserta = DB::table('pesertaevent')
        ->join('pengguna', 'pengguna.id', '=', 'pesertaevent.id')
        ->join('event', 'event.idevent', '=', 'pesertaevent.idevent')

        ->where('pesertaevent.idpesertaevent', $id)
            ->first();

        // Kirim data peserta ke view
        return view('admin.pesertadetail', ['peserta' => $peserta]);
    }
    public function pesertastatusupdate(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'status' => 'required|string'
        ]);
    
        // Ambil data peserta untuk mendapatkan idevent
        $peserta = DB::table('pesertaevent')->where('idpesertaevent', $id)->first();
    
        // Update the status of the participant
        DB::table('pesertaevent')
            ->where('idpesertaevent', $id)
            ->update([
                'status' => $request->input('status')
            ]);
    
        // Cek apakah status yang baru adalah "Pesanan Ditolak"
        if ($request->input('status') === 'Pesanan Ditolak') {
            // Tambahkan 1 kuota ke tabel event berdasarkan idevent
            DB::table('event')
                ->where('idevent', $peserta->idevent)
                ->increment('kuota', 1);
        }
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Status peserta berhasil diperbarui.');
    }

    public function pesertahapus($id)
    {
        DB::table('pesertaevent')->where('idpesertaevent', $id)->delete();
        session()->flash('alert', 'Berhasil menghapus data!');
        return redirect()->back();
    }
    public function logout()
    {
        session()->flush();
        return redirect('home')->with('alert', 'Anda Telah Logout');
    }
    public function eodaftar()
    {
        $eos = DB::table('pengguna')->where('level', 'EO')->get();
        $data['eos'] = $eos;
        return view('admin.eodaftar', $data);
    }

    public function eotambah()
    {
        $data['kategori'] = '';

        return view('admin.eotambah', $data);
    }


    public function eotambahsimpan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'password' => 'required|string',
        ]);

        DB::table('pengguna')->insert([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'telepon' => $request->input('telepon'),
            'alamat' => $request->input('alamat'),
            'password' => ($request->input('password')),
            'level' => 'EO',
            'fotoprofil' => 'Untitled.png',
        ]);

        // Memberikan feedback sukses
        session()->flash('alert', 'EO berhasil ditambahkan!');

        return redirect('admin/eodaftar');
    }

    public function eoedit($id)
    {
        $eo = DB::table('pengguna')->where('id', $id)->first();

        if (!$eo) {
            return redirect('eo/eodaftar')->with('alert', 'eo tidak ditemukan!');
        }

        $data['eo'] = $eo;

        return view('admin.eoedit', $data);
    }


    public function eoeditsimpan(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => "required|email|unique:pengguna,email,{$id}",
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        $updateData = [
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'telepon' => $request->input('telepon'),
            'alamat' => $request->input('alamat'),
        ];

        if ($request->filled('password')) {
            $updateData['password'] = ($request->input('password'));
        }

        DB::table('pengguna')->where('id', $id)->update($updateData);

        // Memberikan feedback sukses
        session()->flash('alert', 'EO berhasil diubah!');
        return redirect('admin/eodaftar');
    }

    public function eohapus($id)
    {
        DB::table('pengguna')->where('id', $id)->delete();
        session()->flash('alert', 'Berhasil menghapus data!');
        return redirect('admin/eodaftar');
    }

   
    // user
    public function userdaftar()
    {
        $users = DB::table('pengguna')->where('level', 'User')->get();
        $data['users'] = $users;
        return view('admin.userdaftar', $data);
    }

    public function usertambah()
    {
        $data['kategori'] = '';

        return view('admin.usertambah', $data);
    }


    public function usertambahsimpan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'password' => 'required|string',
        ]);

        DB::table('pengguna')->insert([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'telepon' => $request->input('telepon'),
            'alamat' => $request->input('alamat'),
            'password' => ($request->input('password')),
            'level' => 'User',
            'fotoprofil' => 'Untitled.png',
        ]);

        // Memberikan feedback sukses
        session()->flash('alert', 'User berhasil ditambahkan!');

        return redirect('admin/userdaftar');
    }

    public function useredit($id)
    {
        $user = DB::table('pengguna')->where('id', $id)->first();

        if (!$user) {
            return redirect('user/userdaftar')->with('alert', 'user tidak ditemukan!');
        }

        $data['user'] = $user;

        return view('admin.useredit', $data);
    }


    public function usereditsimpan(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => "required|email|unique:pengguna,email,{$id}",
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        $updateData = [
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'telepon' => $request->input('telepon'),
            'alamat' => $request->input('alamat'),
        ];

        if ($request->filled('password')) {
            $updateData['password'] = ($request->input('password'));
        }

        DB::table('pengguna')->where('id', $id)->update($updateData);

        // Memberikan feedback sukses
        session()->flash('alert', 'User berhasil diubah!');
        return redirect('admin/userdaftar');
    }

    public function userhapus($id)
    {
        DB::table('pengguna')->where('id', $id)->delete();
        session()->flash('alert', 'Berhasil menghapus data!');
        return redirect('admin/userdaftar');
    }



}
