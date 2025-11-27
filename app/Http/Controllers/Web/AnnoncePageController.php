<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AnnoncePageController extends Controller
{
    public function create()
    {
        return view('annonces.create');
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if (! $user) {
            return redirect()->route('auth.google.redirect');
        }

        $data = $request->validate([
            'titre' => ['nullable', 'string', 'max:255', Rule::unique('tb_annonces', 'titre')],
            'description' => ['required', 'string', 'max:500'],
            'prix' => ['required', 'numeric', 'min:0'],
            'date_publication' => ['nullable', 'date'],
            'statut' => ['nullable', Rule::in(['active', 'vendue'])],
        ]);

        $payload = array_merge($data, [
            'date_publication' => $data['date_publication'] ?? now(),
            'statut' => $data['statut'] ?? 'active',
            'user_id' => $user->getKey(),
        ]);

        $annonce = Annonce::create($payload);

        return redirect()
            ->route('annonces.browse')
            ->with('status', "Annonce #{$annonce->annonce_id} publiée.");
    }
}
