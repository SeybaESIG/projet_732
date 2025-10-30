<?php

    namespace App\Http\Controllers;

    use App\Models\Annonce;
    use Illuminate\Http\Request;
    use Illuminate\Validation\Rule;
    use Carbon\Carbon;

    class AnnonceController extends Controller
    {
        public function index()
        {
            return response()->json(Annonce::all());
        }

        public function store(Request $request)
        {
            $data = $request->validate([
                'titre' => ['required', 'string', 'max:255', Rule::unique('tb_annonces', 'titre')],
                'description' => ['nullable', 'string'],
                'prix' => ['nullable', 'numeric', 'min:0'],
                'date_debut' => ['nullable', 'date'],
                'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
                'user_id' => ['required', 'integer', 'exists:users,id'],
                'ville_id' => ['sometimes', 'integer', 'exists:tb_villes,ville_id'],
            ]);

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
                'titre' => ['sometimes', 'string', 'max:255', Rule::unique('tb_annonces', 'titre')->ignore($annonce->getKey(), $annonce->getKeyName())],
                'description' => ['sometimes', 'nullable', 'string'],
                'prix' => ['sometimes', 'numeric', 'min:0'],
                'date_debut' => ['sometimes', 'date'],
                'date_fin' => ['sometimes', 'date'],
                'user_id' => ['sometimes', 'integer', 'exists:users,id'],
                'ville_id' => ['sometimes', 'integer', 'exists:tb_villes,ville_id'],
            ]);

            if (isset($data['date_fin'])) {
                $start = $data['date_debut'] ?? $annonce->date_debut;
                if (Carbon::parse($data['date_fin'])->lt(Carbon::parse($start))) {
                    return response()->json(['message' => 'La `date_fin` doit être postérieure ou égale à la `date_debut`.'], 422);
                }
            }

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
