<?php

public function edit(Profile $profile)
{
    return view('profile.edit', compact('profile'));
}

public function update(Request $request, Profile $profile)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'nullable|string',
        'tgl_lahir' => 'nullable|date',
        'nomor_telepon' => 'nullable|string|max:20',
        'email' => 'required|email|unique:profiles,email,' . $profile->id,
        'gender' => 'nullable|in:L,P',
        'foto_profile' => 'nullable|image|max:2048'
    ]);

    if ($request->hasFile('foto_profile')) {
        $path = $request->file('foto_profile')->store('profile', 'public');
        $validated['foto_profile'] = $path;
    }

    $profile->update($validated);

    return redirect()->route('profile.edit', $profile)->with('success', 'Profil berhasil diperbarui.');
}
