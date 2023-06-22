<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.user.index', [
            'users' => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'username' => 'required|unique:users|min:5',
            'email' => 'required|unique:users',
            'alamat' => 'required|min:5',
            'role' => 'required',
            'jenis_kelamin' => 'required',
            'jenis_identitas' => 'required',
            'no_identitas' => 'required|min:10',
            'no_hp' => 'required|min:10',
            'foto_identitas' => 'required|file|image|max:1024',
            'password' => 'required|min:5',
        ];

        $validatedData = $request->validate($rules);

        //simpan foto di storage
        $validatedData['foto_identitas'] = $request->file('foto_identitas')->store('user-fotoidentitas', 'public');

        //encrypt password
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/dashboard/user')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.dashboard.user.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.dashboard.user.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|min:5',
            'alamat' => 'required|min:5',
            'jenis_identitas' => 'required',
            'no_identitas' => 'required|min:10',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('foto_identitas')) {
            if ($request->oldImage) {
                Storage::disk('public')->delete($request->oldImage);
            }
            $validatedData['foto_identitas'] = $request->file('foto_identitas')->store('user-fotoidentitas', 'public');
        }

        User::where('id', $user->id)->update($validatedData);

        return redirect('/dashboard/user')->with('success', 'User berhasil Diubah !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // hapus foto di storage
        Storage::disk('public')->delete($user->foto_identitas);

        User::destroy($user->id);
        return redirect('/dashboard/user')->with('success', 'User berhasil dihapus !!');;
    }
}
