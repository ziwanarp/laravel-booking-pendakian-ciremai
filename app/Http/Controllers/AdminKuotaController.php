<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Kuota;
use App\Imports\KuotaImport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class AdminKuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // jika terdapat request = jalur maka jalankan if
        if (request('jalur')) {

            // set tanggal hari ini = hari ini+1
            $date = new DateTime();
            $today = Carbon::parse($date)->addDays(1)->format('Y-m-d');

            return view('admin.dashboard.kuota.detail', [
                'title' => 'Detail Penjualan Barang',
                'kuotas' => Kuota::Where('jalur', request('jalur'))->get()->groupBy('tanggal'),
                'today' => $today,
            ]);
        }

        // jika tidak ada request, tampilkan index
        else {
            return view('admin.dashboard.kuota.index', [
                'kuotas' => Kuota::all()->groupBy('jalur')
            ]);
        }
    }

    public function hapusPerJalur($request)
    {
        // set tanggal hari ini
        $date = new DateTime();
        $today = Carbon::parse($date)->addDays(1)->format('Y-m-d');

        // ambil kuota expired
        $count = Kuota::where('jalur', $request)->where('tanggal', '<', $today)->get();

        // cek apakah ada kuota expired
        if ($count->count() <= 0) {
            Alert::error('Hapus Kuota Gagal !!', 'Tidak ada Kuota Expired !');
            return redirect('/dashboard/kuota?jalur=' . $request);
        }

        // hapus kuota expired 
        $result = Kuota::where('jalur', $request)->where('tanggal', '<', $today)->delete();

        // jika hapus gagal / berhasil, maka tampilkan
        if ($result > 0) {
            Alert::success('Hapus Kuota Berhasil !!', 'Kuota Expired Jalur ' . $request . 'berhasil di hapus !');
            return redirect('/dashboard/kuota?jalur=' . $request);
        } else {
            Alert::error('Hapus Kuota Gagal !!', 'Kuota Expired Jalur ' . $request . 'gagal di hapus !');
            return redirect('/dashboard/kuota?jalur=' . $request);
        }
    }

    public function kuotaExpired()
    {
        // set tanggal hari ini
        $date = new DateTime();
        $today = Carbon::parse($date)->addDays(1)->format('Y-m-d');

        // ambil kuota expired yang belum ter-booking
        $count = Kuota::where('tanggal', '<', $today)->where('jumlah_kuota', '>=', '100')->get();

        // cek apakah ada kuota expired
        if ($count->count() <= 0) {
            Alert::error('Hapus Kuota Gagal !!', 'Tidak ada Kuota Expired !');
            return redirect('/dashboard/kuota');
        }

        // hapus kuota expired 
        $result = Kuota::where('tanggal', '<', $today)->delete();

        // jika hapus gagal / berhasil, maka tampilkan
        if ($result > 0) {
            Alert::success('Hapus Kuota Berhasil !!', 'Kuota Expired berhasil di hapus !');
            return redirect('/dashboard/kuota');
        } else {
            Alert::error('Hapus Kuota Gagal !!', 'Kuota Expired gagal di hapus !');
            return redirect('/dashboard/kuota');
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'jalur' => 'required',
            'jumlah_kuota' => 'required|min:1',
            'tanggal' => 'required',
        ];

        // validasi rules
        $validatedData = $request->validate($rules);

        // ambil data bulan & tahun
        $bulan = substr($validatedData['tanggal'], 5, 2);
        $tahun = substr($validatedData['tanggal'], 0, 4);

        $validatedData['bulan'] = $bulan;
        $validatedData['tahun'] = $tahun;

        Kuota::create($validatedData);

        Alert::success('Berhasil !', 'Data kuota berhasil di tambahkan !');
        return redirect('/dashboard/kuota');
    }

    public function importKuota(Request $request)
    {

        $result = Excel::import(new KuotaImport, $request->file('file'));

        Alert::success('Berhasil !!', 'Data kuota berhasil di import !');
        return redirect('/dashboard/kuota');
    }

    public function destroy($kuota)
    {
        $tanggal = substr($kuota, 0, 10);
        $jalur = substr($kuota, 10,);

        $jalur = Kuota::where('jalur', $jalur)->where('tanggal', $tanggal)->delete();

        Alert::success('Berhasil !', 'Data kuota berhasil di hapus !');
        return redirect('/dashboard/kuota');
    }
}
