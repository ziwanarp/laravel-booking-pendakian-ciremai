<?php

namespace App\Http\Controllers;

use App\Models\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminInterfaceController extends Controller
{
    public function slide()
    {
        // jika ada data interface
        $data = Interfaces::all();

        if ($data->count() > 0) {
            $data = $data[0];
            return view('admin.dashboard.interface.slide', [
                'data' => $data,
            ]);
        }
        //jika tidak ada data
        return view('admin.dashboard.interface.slide', []);
    }

    public function update_slide()
    {
        $data = Interfaces::all();
        if ($data->count() > 0) {

            if (request()->file('slide_palutungan')) {
                if (request()->old_palutungan) {
                    Storage::disk('public')->delete(request()->old_palutungan);
                }
                $validatedData['slide_palutungan'] = request()->file('slide_palutungan')->store('interface-slide', 'public');
            }

            if (request()->file('slide_linggarjati')) {
                if (request()->old_linggarjati) {
                    Storage::disk('public')->delete(request()->old_linggarjati);
                }
                $validatedData['slide_linggarjati'] = request()->file('slide_linggarjati')->store('interface-slide', 'public');
            }

            if (request()->file('slide_linggasana')) {
                if (request()->old_linggasana) {
                    Storage::disk('public')->delete(request()->old_linggasana);
                }
                $validatedData['slide_linggasana'] = request()->file('slide_linggasana')->store('interface-slide', 'public');
            }

            if (request()->file('slide_apuy')) {
                if (request()->old_apuy) {
                    Storage::disk('public')->delete(request()->old_apuy);
                }
                $validatedData['slide_apuy'] = request()->file('slide_apuy')->store('interface-slide', 'public');
            }

            $result = Interfaces::where('id', request()->id)->update($validatedData);

            if ($result == 1) {
                Alert::success('Berhasil !!', 'Foto Slide Berhasil Di update !!');
                return redirect('/dashboard/interface/slide');
            } else {
                Alert::error('Gagal !!', 'Foto Slide Gagal Di update !!');
                return redirect('/dashboard/interface/slide');
            }
        } else {

            if (request()->file('slide_palutungan')) {
                $validatedData['slide_palutungan'] = request()->file('slide_palutungan')->store('interface-slide', 'public');
            }

            if (request()->file('slide_linggarjati')) {
                $validatedData['slide_linggarjati'] = request()->file('slide_linggarjati')->store('interface-slide', 'public');
            }

            if (request()->file('slide_linggasana')) {
                $validatedData['slide_linggasana'] = request()->file('slide_linggasana')->store('interface-slide', 'public');
            }

            if (request()->file('slide_apuy')) {
                $validatedData['slide_apuy'] = request()->file('slide_apuy')->store('interface-slide', 'public');
            }

            $result = Interfaces::create($validatedData);
            if ($result != false) {
                Alert::success('Berhasil !!', 'Foto Slide Berhasil Di update !!');
                return redirect('/dashboard/interface/slide');
            } else {
                Alert::error('Gagal !!', 'Foto Slide Gagal Di update !!');
                return redirect('/dashboard/interface/slide');
            }
        }
    }

    public function about()
    {
        // jidak ada data interface tampilkan
        $data = Interfaces::where('id', 1)->get();
        if ($data->count() > 0) {
            $data = $data[0];
            return view('admin.dashboard.interface.about', [
                'data' => $data,
            ]);
        }
        // jika data interface tidak ada
        return view('admin.dashboard.interface.about', []);
    }

    public function update_about()
    {
        $validatedData['tentang_title'] = request()->tentang_title;
        $validatedData['tentang_body'] = request()->tentang_body;

        $data = Interfaces::all();
        if ($data->count() > 0) {
            $id = $data[0]->id;
            $result = Interfaces::where('id', $id)->update($validatedData);
            if ($result == 1) {
                Alert::success('Berhasil !!', 'About Berhasil Di update !!');
                return redirect('/dashboard/interface/about');
            } else {
                Alert::error('Gagal !!', 'About Gagal Di update !!');
                return redirect('/dashboard/interface/about');
            }
        } else {
            $result = Interfaces::create($validatedData);
            if ($result != false) {
                Alert::success('Berhasil !!', 'About Berhasil Di update !!');
                return redirect('/dashboard/interface/about');
            } else {
                Alert::error('Gagal !!', 'About Gagal Di update !!');
                return redirect('/dashboard/interface/about');
            }
        }
    }
}
