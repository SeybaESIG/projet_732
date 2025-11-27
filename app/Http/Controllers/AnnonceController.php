<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnnonceController extends Controller
{
    public function index(Request $request)
    {
        $annonces = Annonce::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->query('q');
                $query->where(function ($sub) use ($search) {
                    $sub->where('titre', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('prix_min'), function ($query) use ($request) {
                $query->where('prix', '>=', (float) $request->query('prix_min'));
            })
            ->when($request->filled('prix_max'), function ($query) use ($request) {
                $query->where('prix', '<=', (float) $request->query('prix_max'));
            })
            ->when($request->filled('statut'), function ($query) use ($request) {
                $query->where('statut', $request->query('statut'));
            })
            ->orderByDesc('date_publication')
            ->get();

        return response()->json($annonces);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre' => ['nullable', 'string', 'max:255', Rule::unique('tb_annonces', 'titre')],
            'description' => ['required', 'string', 'max:500'],
            'prix' => ['required', 'numeric', 'min:0'],
            'date_publication' => ['nullable', 'date'],
            'statut' => ['nullable', Rule::in(['active', 'vendue'])],
            'user_id' => ['required', 'integer', 'exists:tb_users,users_id'],
        ]);

        $data['date_publication'] = $data['date_publication'] ?? now();
        $data['statut'] = $data['statut'] ?? 'active';

        $annonce = Annonce::create($data);

        return response()->json($annonce, 201);
    }

    public function show(string $id)
    {
        $annonce = Annonce::findOrFail($id);

        return response()->json($annonce);
    }

    public function update(Request $request, string $id)
    {
        $annonce = Annonce::findOrFail($id);

        $data = $request->validate([
            'titre' => ['sometimes', 'nullable', 'string', 'max:255', Rule::unique('tb_annonces', 'titre')->ignore($annonce->getKey(), $annonce->getKeyName())],
            'description' => ['sometimes', 'string', 'max:500'],
            'prix' => ['sometimes', 'numeric', 'min:0'],
            'date_publication' => ['sometimes', 'date'],
            'statut' => ['sometimes', Rule::in(['active', 'vendue'])],
            'user_id' => ['sometimes', 'integer', 'exists:tb_users,users_id'],
        ]);

        $annonce->update($data);

        return response()->json($annonce);
    }

    public function destroy(string $id)
    {
        $annonce = Annonce::findOrFail($id);
        $annonce->delete();

        return response()->json(null, 204);
    }
}
