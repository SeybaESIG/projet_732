<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => ['nullable', 'string', 'max:30', Rule::unique('tb_users', 'username')],
            'nom' => ['required', 'string', 'max:50'],
            'prenom' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('tb_users', 'email')],
            'num_tel' => ['nullable', 'string', 'max:20', Rule::unique('tb_users', 'num_tel')],
            'adresse' => ['nullable', 'string', 'max:255'],
            'ville_id' => ['nullable', 'exists:tb_villes,ville_id'],
            'mot_de_passe' => ['nullable', 'string', 'min:8', 'confirmed'],
            'google_id' => ['nullable', 'string', Rule::unique('tb_users', 'google_id')],
            'google_avatar_url' => ['nullable', 'string', 'max:2048'],
        ]);

        $user = User::create($data);
        return response()->json($user, 201);
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'username' => ['sometimes', 'nullable', 'string', 'max:30', Rule::unique('tb_users', 'username')->ignore($user->getKey(), $user->getKeyName())],
            'nom' => ['sometimes', 'string', 'max:50'],
            'prenom' => ['sometimes', 'string', 'max:50'],
            'email' => ['sometimes', 'nullable', 'email', 'max:255', Rule::unique('tb_users', 'email')->ignore($user->getKey(), $user->getKeyName())],
            'num_tel' => ['sometimes', 'nullable', 'string', 'max:20', Rule::unique('tb_users', 'num_tel')->ignore($user->getKey(), $user->getKeyName())],
            'adresse' => ['sometimes', 'nullable', 'string', 'max:255'],
            'ville_id' => ['sometimes', 'nullable', 'exists:tb_villes,ville_id'],
            'mot_de_passe' => ['sometimes', 'nullable', 'string', 'min:8', 'confirmed'],
            'google_id' => ['sometimes', 'nullable', 'string', Rule::unique('tb_users', 'google_id')->ignore($user->getKey(), $user->getKeyName())],
            'google_avatar_url' => ['sometimes', 'nullable', 'string', 'max:2048'],
        ]);

        $user->update($data);
        return response()->json($user);
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }
}
