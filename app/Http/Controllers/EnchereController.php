<?php

    namespace App\Http\Controllers;

    use App\Models\Enchere;
    use Illuminate\Http\Request;
    use Illuminate\Validation\Rule;
    use Carbon\Carbon;

    class EnchereController extends Controller
    {
        public function index()
        {
            return response()->json(Enchere::all());
        }

        public function store(Request $request)
        {
            $data = $request->validate([
                'titre' => ['required', 'string', 'max:255', Rule::unique('tb_encheres', 'titre')],
                'description' => ['nullable', 'string'],
                'prix_depart' => ['required', 'numeric', 'min:0'],
                'date_debut' => ['required', 'date'],
                'date_fin' => ['required', 'date', 'after_or_equal:date_debut'],
                'user_id' => ['required', 'integer', 'exists:users,id'],
                'ville_id' => ['sometimes', 'integer', 'exists:tb_villes,ville_id'],
            ]);

            $enchere = Enchere::create($data);
            return response()->json($enchere, 201);
        }

        public function show(string $id)
        {
            $enchere = Enchere::findOrFail($id);
            return response()->json($enchere);
        }

        public function update(Request $request, string $id)
        {
            $enchere = Enchere::findOrFail($id);

            $data = $request->validate([
                'titre' => ['sometimes', 'string', 'max:255', Rule::unique('tb_encheres', 'titre')->ignore($enchere->getKey(), $enchere->getKeyName())],
                'description' => ['sometimes', 'nullable', 'string'],
                'prix_depart' => ['sometimes', 'numeric', 'min:0'],
                'date_debut' => ['sometimes', 'date'],
                'date_fin' => ['sometimes', 'date'],
                'user_id' => ['sometimes', 'integer', 'exists:users,id'],
                'ville_id' => ['sometimes', 'integer', 'exists:tb_villes,ville_id'],
            ]);

            // Si seulement date_fin est fournie, comparer avec la date_debut actuelle
            if (isset($data['date_fin'])) {
                $start = $data['date_debut'] ?? $enchere->date_debut;
                if (Carbon::parse($data['date_fin'])->lt(Carbon::parse($start))) {
                    return response()->json(['message' => 'La `date_fin` doit être postérieure ou égale à la `date_debut`.'], 422);
                }
            }

            $enchere->update($data);
            return response()->json($enchere);
        }

        public function destroy(string $id)
        {
            $enchere = Enchere::findOrFail($id);
            $enchere->delete();
            return response()->json(null, 204);
        }
    }
