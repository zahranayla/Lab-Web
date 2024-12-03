<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EoController extends Controller
{
    public function index()
    {
        $jumlahevent = DB::table('event')->count();
        return view('eo.dashboard', [
            'jumlahevent' => $jumlahevent,

        ]);
    }

    public function eventdaftar()
    {
        $events = DB::table('event')->where('event.ideo', session('eo')->id)->orderBy('idevent', 'DESC')->get();
        $data['events'] = $events;
        return view('eo.eventdaftar', $data);
    }

    public function eventtambah()
    {
        $data['kategori'] = '';

        return view('eo.eventtambah', $data);
    }

    public function eventtambahsimpan(Request $request)
    {
        // Validasi input form
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'kuota' => 'required|numeric|min:1',
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
            'kuota' => $request->input('kuota'),
            'foto' => $namafoto,
            'ideo' => session('eo')->id,
        ]);

        // Memberikan feedback sukses
        session()->flash('alert', 'Event berhasil ditambahkan!');

        return redirect('eo/eventdaftar');
    }

    public function eventedit($id)
    {
        $event = DB::table('event')->where('idevent', $id)->first();

        if (!$event) {
            return redirect('eo/eventdaftar')->with('alert', 'Event tidak ditemukan!');
        }

        $data['event'] = $event;

        return view('eo.eventedit', $data);
    }

    public function eventeditsimpan(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'kuota' => 'required|numeric|min:1',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Ambil data event lama
        $event = DB::table('event')->where('idevent', $id)->first();

        // Jika event tidak ditemukan, redirect dengan pesan error
        if (!$event) {
            return redirect('eo/eventdaftar')->with('alert', 'Event tidak ditemukan!');
        }

        // Proses update
        $updateData = [
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'tanggalevent' => $request->input('tanggalevent'),
            'jamevent' => $request->input('jamevent'),
            'lokasi' => $request->input('lokasi'),
            'kuota' => $request->input('kuota'),
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
        return redirect('eo/eventdaftar');
    }

    public function eventhapus($id)
    {
        DB::table('event')->where('idevent', $id)->delete();
        session()->flash('alert', 'Berhasil menghapus data!');
        return redirect('eo/eventdaftar');
    }

    public function pesertadaftar($id)
    {
        $peserta = DB::table('pesertaevent')
            ->join('pengguna', 'pengguna.id', '=', 'pesertaevent.id')
            ->where('pesertaevent.idevent', $id)
            ->get();

        $event = DB::table('event')->where('idevent', $id)->first();

        return view('eo.pesertadaftar', [
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
        return view('eo.pesertadetail', ['peserta' => $peserta]);
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
        return redirect('eo/pesertadaftar');
    }
    public function logout()
    {
        session()->flush();
        return redirect('home')->with('alert', 'Anda Telah Logout');
    }

}
