<?php

    namespace App\Http\Controllers;

    use App\Models\Ville;
    use Illuminate\Http\Request;
    use Illuminate\Validation\Rule;

    class VilleController extends Controller
    {
        public function index()
        {
            return response()->json(Ville::all());
        }

        public function store(Request $request)
        {
            $data = $request->validate([
                'nom' => ['required', 'string', 'max:255', Rule::unique('tb_villes', 'nom')],
                'code_postal' => ['nullable', 'string', 'max:10'],
                'pays_id' => ['required', 'integer', 'exists:tb_pays,pays_id'],
            ]);

            $ville = Ville::create($data);
            return response()->json($ville, 201);
        }

        public function show(string $id)
        {
            $ville = Ville::findOrFail($id);
            return response()->json($ville);
        }

        public function update(Request $request, string $id)
        {
            $ville = Ville::findOrFail($id);

            $data = $request->validate([
                'nom' => ['sometimes', 'string', 'max:255', Rule::unique('tb_villes', 'nom')->ignore($ville->getKey(), $ville->getKeyName())],
                'code_postal' => ['sometimes', 'nullable', 'string', 'max:10'],
                'pays_id' => ['sometimes', 'integer', 'exists:tb_pays,pays_id'],
            ]);

            $ville->update($data);
            return response()->json($ville);
        }

        public function destroy(string $id)
        {
            $ville = Ville::findOrFail($id);
            $ville->delete();
            return response()->json(null, 204);
        }
    }
