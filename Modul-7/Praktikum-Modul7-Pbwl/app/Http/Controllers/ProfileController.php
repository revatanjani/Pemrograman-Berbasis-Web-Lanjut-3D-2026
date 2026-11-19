<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $anggota = $user->anggota;
        return view('profile.edit', compact('user', 'anggota'));
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'no_telepon' => ['nullable', 'string', 'max:30'],
        ]);

        $user->update(['name' => $data['name'], 'email' => $data['email']]);
        if ($user->anggota) {
            $user->anggota->update([
                'nama' => $data['name'],
                'email' => $data['email'],
                'no_telepon' => $data['no_telepon'] ?? '-',
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
